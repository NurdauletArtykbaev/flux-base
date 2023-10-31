<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\CityResource\Pages;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Nurdaulet\FluxBase\Models\City;

class CityResource extends Resource
{

    protected static ?string $model = City::class;
    protected static ?string $modelLabel = 'город';
    protected static ?string $pluralModelLabel = 'Города';

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(trans('admin.name')),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique()
                    ->maxLength(255)
                    ->label(trans('admin.slug')),
                Forms\Components\TextInput::make('lat')
                    ->maxLength(255)
                    ->label(trans('admin.lat')),
                Forms\Components\TextInput::make('lng')
                    ->maxLength(255)
                    ->label(trans('admin.lng')),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->label(trans('admin.is_active')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(trans('admin.nsame')),
                Tables\Columns\TextColumn::make('slug')->label(trans('admin.slug')),
                Tables\Columns\TextColumn::make('lat')->label(trans('admin.lat')),
                Tables\Columns\TextColumn::make('lng')->label(trans('admin.lng')),
                Tables\Columns\BooleanColumn::make('is_active')->label(trans('admin.is_active')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->label(trans('admin.created_at')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()->label(trans('admin.updated_at')),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
