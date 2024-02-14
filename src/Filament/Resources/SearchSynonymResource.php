<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\SearchSynonymResource\Pages;
use Nurdaulet\FluxBase\Models\SearchSynonym;
use Nurdaulet\FluxBase\Services\AlgoliaService;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Nurdaulet\FluxBase\Services\Search\Facades\Search;


class SearchSynonymResource extends Resource
{
    protected static ?string $model = SearchSynonym::class;
    protected static ?string $modelLabel = 'Поиск синонимы';
    protected static ?string $pluralModelLabel = 'Поиск синонимы';
    protected static ?string $navigationIcon = 'heroicon-o-search';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('word')
                    ->label(trans('admin.word'))
                    ->required(),
                TagsInput::make('synonyms')
                    ->label(trans('admin.synonyms'))
                    ->separator(',')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('word')
                    ->label(trans('admin.word')),
                Tables\Columns\TextColumn::make('synonyms')
                    ->label(trans('admin.synonyms')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('settings')
                    ->label('Экпорт')
                    ->action(function () {
                        if (app()->isProduction()) {


                            $synonyms = SearchSynonym::get();
                            $synonyms = $synonyms->map(function ($item) {
                                $itemSynonyms = explode(',', $item->synonyms);
                                array_unshift($itemSynonyms, $item->word);
                                return [
                                    "objectID" => 'syn-' . time() . $item->id . '-' . rand(10, 100),
                                    "type" => "synonym",
                                    "synonyms" => $itemSynonyms
                                ];
                            });
                        Search::saveSynonym($synonyms->toArray());


//                        $chunks->all();
                        }

                        Notification::make()
                            ->title('Успешно обнавлено')
                            ->success()
                            ->send();
                        return true;
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Обновить синонимы')
                    ->modalSubheading('Вы действительно хотите обновить синонимы.')
                    ->modalButton('Да, обновить')
                ,
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSearchSynonyms::route('/'),
        ];
    }
}
