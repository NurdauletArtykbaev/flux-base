<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Filament\Resources\BannerResource\Pages;
use Filament\Forms\Components\Select;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Nurdaulet\FluxBase\Facades\Helpers\StringFormatter;
use Nurdaulet\FluxBase\Models\Banner;

class BannerResource extends Resource
{
    use Translatable;

    protected static ?string $model = Banner::class;
    protected static ?string $modelLabel = 'баннер';
    protected static ?string $pluralModelLabel = 'Баннеры';

    protected static ?string $navigationIcon = 'heroicon-o-camera';

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
                Forms\Components\Select::make('catalog_id')
                    ->relationship('catalog', 'name')
                    ->preload()
                    ->label(trans('admin.catalog')),
                Select::make('user_id')
                    ->label(trans('admin.user'))
                    ->searchable()
                    ->getSearchResultsUsing(fn(string $search) => config('flux-base.models.user')::whereRaw("concat(name, ' ', 'surname', ' ', 'company_name') like '%" . $search . "%'")
                        ->when(StringFormatter::onlyDigits($search), function ($query) use ($search) {
                            $query->orWhere('phone', 'like', "%" . StringFormatter::onlyDigits($search) . "%");
                        })
                        ->limit(50)->selectRaw("id,   concat(name, ' ',surname, ' | ' , phone) as info")
                        ->pluck('info', 'id'))
                    ->getOptionLabelUsing(function ($value) {
                        $user = config('flux-base.models.user')::find($value);
                        return $user?->name . ' ' . $user?->surname . ' | ' . $user->phone;
                    }),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('s3')
                    ->visibility('public')
                    ->directory('banners')
                    ->label(trans('admin.image')),
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)
                    ->label(trans('admin.name')),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->label(trans('admin.description')),
                Forms\Components\Select::make('rent_type_id')
                    ->relationship('rentType', 'name')
                    ->preload()
                    ->translateLabel()
                    ->label(trans('admin.rent_type')),
                Forms\Components\TextInput::make('price')
                    ->label(trans('admin.price')),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->label(trans('admin.is_active')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('catalog.name')
                    ->label(trans('admin.catalog')),
                Tables\Columns\TextColumn::make('user.phone')
                    ->label(trans('admin.user')),
                Tables\Columns\ImageColumn::make('image')
                    ->width(150)
                    ->height(150)
                    ->disk('s3')
                    ->label(trans('admin.image')),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('admin.name')),
                Tables\Columns\TextColumn::make('description')
                    ->label(trans('admin.description')),
                Tables\Columns\TextColumn::make('price')
                    ->label(trans('admin.price')),
                Tables\Columns\BooleanColumn::make('is_active')->label(trans('admin.is_active')),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
