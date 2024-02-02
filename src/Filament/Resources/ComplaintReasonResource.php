<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\ComplaintReasonResource\Pages;
use Nurdaulet\FluxBase\Models\ComplaintReason;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ComplaintReasonResource extends Resource
{
    use Translatable;
    protected static ?string $model = ComplaintReason::class;
    protected static ?string $modelLabel = 'жалобу';
    protected static ?string $pluralModelLabel = 'Причины жалоб';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getTranslatableLocales(): array
    {
        return config('flux-base.languages');
    }

    protected function getTableReorderColumn(): ?string
    {
        return 'sort';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('name')
                    ->maxLength(65535)
                    ->label(trans('admin.name')),
                Forms\Components\Textarea::make('type')
                    ->maxLength(65535)
                    ->label(trans('admin.type')),
                Forms\Components\Toggle::make('status')
                    ->required()
                    ->label(trans('admin.status')),
                Forms\Components\Toggle::make('is_for_user')
                    ->required()
                    ->label(trans('admin.is_for_user')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('admin.name')),
                Tables\Columns\TextColumn::make('type')
                    ->label(trans('admin.type')),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()->label(trans('admin.status')),
                Tables\Columns\IconColumn::make('is_for_user')
                    ->boolean()->label(trans('admin.is_for_user')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->label(trans('admin.created_at')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()->label(trans('admin.updated_at')),

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplaintReasons::route('/'),
            'create' => Pages\CreateComplaintReason::route('/create'),
            'edit' => Pages\EditComplaintReason::route('/{record}/edit'),
        ];
    }
}
