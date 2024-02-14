<?php

namespace Nurdaulet\FluxBase\Services\Search\Engines\Algolia;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Nurdaulet\FluxBase\Models\SearchSynonym;
use Nurdaulet\FluxBase\Services\Search\Contracts\SearchEngineContract;
use Algolia\AlgoliaSearch\SearchClient;

class AlgoliaService implements SearchEngineContract
{

    protected $index;
    protected $client;
    private $algoliaAnalyticsUrl = 'https://analytics.de.algolia.com/2/';

    public function __construct()
    {
        $this->client = SearchClient::create(
            config('scout.algolia.id'),
            config('scout.algolia.secret')
        );
    }

    public function search($index, $q = null)
    {
        $this->index = $this->client->initIndex($index);
        return [];
    }

    public function getTopSearches($index)
    {
        try {
            $bannedWords = Cache::remember("banned-words", 3600, function () {
                return config('flux-base.models.banned_top_search_word')::get()->pluck('word')->toArray();
            });
            $words = Cache::remember("top-searches", 86400, function () use ($index) {
                $data = Http::withHeaders([
                    'X-Algolia-API-Key' => config('scout.algolia.analytics_secret'),
                    'X-Algolia-Application-Id' => config('scout.algolia.id'),
                ])->get($this->algoliaAnalyticsUrl . '/searches?index=' . $index . '&limit=15')->json();
                $data = $data['searches'];
                $data = array_column($data, 'search');
                $data = array_filter($data, fn($item) => !empty($item));
                return array_values($data);
            });
            return array_values(array_diff($words, $bannedWords));
        } catch (\Exception $exception) {
            Log::channel('dev')->alert('algolia top search not working');
            return [];
        }
    }

    public function updateSynonym()
    {
        $synonyms = config('flux-base.models.search_synonym')::get();
        $synonyms = $this->prepareSynonyms($synonyms);
        $indices = $this->client->listIndices()['items'];
        foreach ($indices as $index) {
            $this->index = $this->client->initIndex($index['name']);
            $this->index->clearSynonyms([
                'forwardToReplicas' => false
            ]);
            $this->index->saveSynonyms($synonyms);
        }
    }

    public function delete($index, $id)
    {
        $this->index = $this->client->initIndex($index);
        $this->index->deleteObject($id);
    }

    public function saveObjects($index, $data)
    {
        $this->index = $this->client->initIndex($index);
        $this->index->saveObjects(
            $data
        );
    }

    public function saveObject($index, $data)
    {
        $this->index = $this->client->initIndex($index);
        $this->index->saveObject(
            $data
        );
    }

    private function prepareSynonyms($synonyms)
    {
        return $synonyms->map(function ($item) {
            $itemSynonyms = explode(',', $item->synonyms);
            array_unshift($itemSynonyms, $item->word);
            return [
                $item->word  => $itemSynonyms
            ];
        });
    }
}
