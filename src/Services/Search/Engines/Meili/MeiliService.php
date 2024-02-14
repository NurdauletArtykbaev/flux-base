<?php

namespace Nurdaulet\FluxBase\Services\Search\Engines\Meili;

use Meilisearch\Client;
use Nurdaulet\FluxBase\Services\Search\Contracts\SearchEngineContract;
use Meilisearch\Contracts\IndexesQuery;

class MeiliService implements SearchEngineContract
{
    private $client;
    public function __construct()
    {
        $this->client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
    }

    public function search($index, $q = null)
    {
        return [];
    }

    public function updateSynonym()
    {
        $synonyms = config('flux-base.models.search_synonym')::get();
        $synonyms = $this->prepareSynonyms($synonyms);
        $indices = $this->client->getIndexes((new IndexesQuery())->setLimit(3));
        foreach ($indices as $index) {
            $this->client->index($index->getUid())->updateSynonyms($synonyms);
        }
    }

    public function getTopSearches($index)
    {
        return [];
//        $this->client->index($index)->updateSynonyms([
//            $word => $synonyms,
//        ]);
    }

    public function delete($index, $id)
    {
        $this->client->index($index)->deleteDocument($id);
    }

    private function prepareSynonyms($synonyms)
    {
        return $synonyms->map(function ($item) {
            $itemSynonyms = explode(',', $item->synonyms);
            array_unshift($itemSynonyms, $item->word);
            return [
                "objectID" => 'syn-' . time() . $item->id . '-' . rand(10, 100),
                "type" => "synonym",
                "synonyms" => $itemSynonyms
            ];
        });
    }
}
