<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\MobileVersionResource\Pages;
use Nurdaulet\FluxBase\Models\MobileVersion;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use function Composer\Autoload\includeFile;


class MobileAppResource extends Resource
{
    protected static ?string $model = MobileVersion::class;
    protected static ?string $modelLabel = 'Версия моб.прил';
    protected static ?string $pluralModelLabel = 'Версия моб.прил';
    protected static ?string $navigationIcon = 'heroicon-o-phone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('version')
                    ->label(trans('admin.version'))
                    ->required(),
                Forms\Components\TextInput::make('ios_version')
                    ->label(trans('admin.ios_version'))
                    ->required(),
                Forms\Components\TextInput::make('android_version')
                    ->label(trans('admin.android_version'))
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('version')
                    ->label(trans('admin.version')),
                Tables\Columns\TextColumn::make('ios_version')
                    ->label(trans('admin.ios_version')),
                Tables\Columns\TextColumn::make('android_version')
                    ->label(trans('admin.android_version')),
            ])
            ->filters([
                //
            ])
            ->headerActions([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make(),

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMobileVersions ::route('/'),
        ];
    }
}
