<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\PaymentMethodResource\Pages;
use Nurdaulet\FluxBase\Helpers\PaymentHelper;
use Nurdaulet\FluxBase\Models\PaymentMethod;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PaymentMethodResource extends Resource
{
    use Translatable;

    protected static ?string $model = PaymentMethod::class;

    protected static ?string $modelLabel = 'способ';
    protected static ?string $pluralModelLabel = 'Способы оплаты';

    protected static ?string $navigationIcon = 'heroicon-o-cash';

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
                    ->label(trans('admin.name')),
                Forms\Components\Select::make('slug')
                    ->options(PaymentHelper::getSlugs())
                    ->label(trans('admin.slug')),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('s3')
                    ->visibility('public')
                    ->directory('payments')
                    ->label(trans('admin.image')),
                Forms\Components\Toggle::make('is_active')
                    ->label(trans('admin.status')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(trans('admin.name')),
                Tables\Columns\ImageColumn::make('image')
                    ->width(150)
                    ->height(150)
                    ->disk('s3')
                    ->label(trans('admin.image')),
                Tables\Columns\BooleanColumn::make('is_active')->label(trans('admin.status')),
                Tables\Columns\TextColumn::make('slug')->label(trans('admin.slug')),
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
            'index' => Pages\ListPaymentMethods::route('/'),
            'create' => Pages\CreatePaymentMethod::route('/create'),
            'edit' => Pages\EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}
