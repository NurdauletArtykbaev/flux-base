<?php

namespace Nurdaulet\FluxBase\Filament\Resources\PartnerResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;

class CitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'cities';
    protected static ?string $modelLabel = 'город';
    protected static ?string $pluralModelLabel = 'Города';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)->label(trans('admin.name')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('admin.name')),

            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn(AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->preload()
                            ->label(trans('admin.receive_method')),
                        Forms\Components\TextInput::make('delivery_price')
                            ->label(trans('admin.delivery_price'))
                            ->required(),
                    ])
            ])
            ->actions([
                // ...
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                // ...
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
