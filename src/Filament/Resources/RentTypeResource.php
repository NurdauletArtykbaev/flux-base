<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\RentTypeResource\Pages;
use Nurdaulet\FluxBase\Models\RentType;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class RentTypeResource extends Resource
{
    use Translatable;

    protected static ?string $model = RentType::class;

    protected static ?string $modelLabel = 'Период аренды';
    protected static ?string $pluralModelLabel = 'Период аренды';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function getTranslatableLocales(): array
    {
        return config('flux-base.languages');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->label(trans('admin.key')),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(trans('admin.name')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')->label(trans('admin.key')),
                Tables\Columns\TextColumn::make('name')->label(trans('admin.name')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRentTypes::route('/'),
            'create' => Pages\CreateRentType::route('/create'),
            'edit' => Pages\EditRentType::route('/{record}/edit'),
        ];
    }
}
