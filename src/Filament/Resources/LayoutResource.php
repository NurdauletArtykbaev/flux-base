<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\LayoutResource\Pages;
use Nurdaulet\FluxBase\Helpers\LayoutHelper;
use Nurdaulet\FluxBase\Models\ComplaintReason;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Nurdaulet\FluxBase\Models\Layout;

class LayoutResource extends Resource
{
    protected static ?string $model = Layout::class;
    protected static ?string $modelLabel = 'Главная страница';
    protected static ?string $pluralModelLabel = 'Главная страница';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options(LayoutHelper::getTypes())
                    ->label(trans('admin.type')),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->label(trans('admin.slug')),
                Forms\Components\Textarea::make('name')
                    ->required()
                    ->label(trans('admin.text'))
                    ->rows(8)->cols(10),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->label(trans('admin.status')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SelectColumn::make('type')
                    ->options(LayoutHelper::getTypes())
                    ->label(trans('admin.type')),
                Tables\Columns\TextColumn::make('slug')
                    ->label(trans('admin.slug')),
                Tables\Columns\TextColumn::make('text')
                    ->label(trans('admin.text')),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()->label(trans('admin.status'))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->reorderable('sort')
            ->defaultSort('sort');
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
            'index' => Pages\ListLayouts::route('/'),
            'create' => Pages\CreateLayout::route('/create'),
            'edit' => Pages\EditLayout::route('/{record}/edit'),
        ];
    }
}
