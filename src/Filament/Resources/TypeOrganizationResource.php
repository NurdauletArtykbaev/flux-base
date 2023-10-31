<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\TypeOrganizationResource\Pages;
use Nurdaulet\FluxBase\Models\TypeOrganization;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeOrganizationResource extends Resource
{
    use Translatable;

    protected static ?string $model = TypeOrganization::class;

    protected static ?string $modelLabel = 'тип';
    protected static ?string $pluralModelLabel = 'Тип организации';

    protected static ?string $navigationIcon = 'heroicon-o-badge-check';

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
                    ->maxLength(255)
                    ->label(trans('admin.name')),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->label(trans('admin.is_active')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(trans('admin.name')),
                Tables\Columns\BooleanColumn::make('is_active')->label(trans('admin.is_active')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(trans('admin.created_at')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(trans('admin.updated_at')),
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
            'index' => Pages\ListTypeOrganizations::route('/'),
            'create' => Pages\CreateTypeOrganization::route('/create'),
            'edit' => Pages\EditTypeOrganization::route('/{record}/edit'),
        ];
    }
}
