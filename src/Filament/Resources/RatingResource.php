<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\RatingResource\Pages;
use Nurdaulet\FluxBase\Filament\Resources\RatingResource\RelationManagers;
use Nurdaulet\FluxBase\Models\Rating;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class RatingResource extends Resource
{
    use Translatable;



    protected static ?string $model = Rating::class;

    /**
     * @param string|null $model
     */
    protected static ?string $modelLabel = 'Рейтинг';
    protected static ?string $pluralModelLabel = 'Рейтинг';


    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getTranslatableLocales(): array
    {

        return config('flux-base.languages');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label(trans('admin.user_name')),
                Forms\Components\TextInput::make('rating')
                    ->required()
                    ->label(trans('admin.rating')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Имя'),
                Tables\Columns\TextColumn::make('rating')
                    ->sortable()
                    ->searchable()
                    ->label(trans('admin.rating')),

            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('rating', 'DESC');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MessagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRatings::route('/'),
            'create' => Pages\CreateRating::route('/create'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
        ];
    }
}
