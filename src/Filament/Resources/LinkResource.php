<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\LinkResource\Pages;
use Filament\Forms\Components\Select;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Nurdaulet\FluxBase\Facades\StringFormatter;

class LinkResource extends Resource
{
    use Translatable;

    public static function getModel(): string
    {
        return config('flux-base.models.link');
    }
    public static function getModelLabel(): string
    {
        return trans('flux-base.link.plural');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('flux-base.link.plural');
    }

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    public static function getTranslatableLocales(): array
    {
        return config('flux-base.languages');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('s3')
                    ->visibility('public')
                    ->directory('links')
                    ->label(trans('admin.image')),
                Forms\Components\TextInput::make('text')
                    ->label(trans('admin.text')),
                Forms\Components\TextInput::make('link')
                    ->label(trans('admin.link'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->width(150)
                    ->height(150)
                    ->disk('s3')
                    ->label(trans('admin.image')),
                Tables\Columns\TextColumn::make('link')
                    ->label(trans('admin.link')),
                Tables\Columns\TextColumn::make('text')
                    ->label(trans('admin.text')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->label(trans('admin.created_at')),
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
            'index' => Pages\ListLinks::route('/'),
            'create' => Pages\CreateLink::route('/create'),
            'edit' => Pages\EditLink::route('/{record}/edit'),
        ];
    }
}
