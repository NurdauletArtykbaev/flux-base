<?php

namespace Nurdaulet\FluxBase\Filament\Resources;


use Nurdaulet\FluxBase\Filament\Resources\WebSiteConfigResource\Pages;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class WebSiteConfigResource extends Resource
{

//    protected static ?string $model = WebSiteConfig::class;
    public static function getModel(): string
    {

        return config('flux-base.models.web_site_config');
//        return parent::getModel(); // TODO: Change the autogenerated stub
    }

    protected static ?string $modelLabel = 'Конфиг сайта';
    protected static ?string $pluralModelLabel = 'Конфиг сайта';

    protected static ?string $navigationIcon = 'heroicon-o-menu';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('config')
                    ->label('Конфиг'),
//                Forms\Components\KeyValue::make('config')
//                    ->keyPlaceholder('Ключ')
//                    ->label('Конфиг')
//                    ->valuePlaceholder('Значения'),
                Forms\Components\FileUpload::make('logo_primary')
                    ->image()
                    ->disk('s3')
                    ->visibility('public')
                    ->directory('logo')
                    ->label(trans('admin.logo_primary')),
                Forms\Components\FileUpload::make('logo_secondary')
                    ->image()
                    ->disk('s3')
                    ->visibility('public')
                    ->directory('logo')
                    ->label(trans('admin.logo_secondary')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('config')
                    ->label(trans('admin.value'))
                    ->limit(150)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo_primary')
                    ->width(150)
                    ->height(150)
                    ->disk('s3')
                    ->label(trans('admin.logo_primary')),
                Tables\Columns\ImageColumn::make('logo_secondary')
                    ->width(150)
                    ->height(150)
                    ->disk('s3')
                    ->label(trans('admin.logo_secondary')),
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

    public static function getRelations(): array
    {
        return [
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebSiteConfig::route('/'),
            'create' => Pages\CreateWebSiteConfig::route('/create'),
            'edit' => Pages\EditWebSiteConfig::route('/{record}/edit'),
        ];
    }
}
