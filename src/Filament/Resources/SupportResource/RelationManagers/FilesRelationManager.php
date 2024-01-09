<?php

namespace Nurdaulet\FluxBase\Filament\Resources\SupportResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;

class FilesRelationManager extends RelationManager
{

    protected static string $relationship = 'files';
    protected static ?string $modelLabel = 'Файлы';
    protected static ?string $pluralModelLabel = 'Файлы';

    protected static ?string $recordTitleAttribute = 'path';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('path')
                    ->disk('s3')
                    ->directory('supports')
                    ->label(trans('admin.file')),
                Forms\Components\Hidden::make('disk')->default('s3')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('path')
                    ->url(fn($record) => env('AWS_URL').'/'. $record->path)
                    ->openUrlInNewTab()
                    ->label(trans('admin.file')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
