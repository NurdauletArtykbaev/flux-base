<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Facades\StringFormatter;
use Nurdaulet\FluxBase\Filament\Resources\PartnerResource\Pages;
use Nurdaulet\FluxBase\Helpers\PartnerHelper;
use Nurdaulet\FluxBase\Models\Partner;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Facades\Image;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static ?string $modelLabel = 'Партнер';
    protected static ?string $pluralModelLabel = 'Партнеры';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label(trans('admin.partners'))
                    ->required()
                    ->searchable()
                    ->getSearchResultsUsing(fn(string $search) => config('flux-base.models.user')::whereRaw("concat(name, ' ', 'surname', ' ', 'company_name') like '%" . $search . "%'")
                        ->when(StringFormatter::onlyDigits($search), function ($query) use($search) {
                            $query->orWhere('phone', 'like', "%". StringFormatter::onlyDigits($search)."%");

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
                    ->directory('partners')
                    ->label(trans('admin.image')),
                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->disk('s3')
                    ->visibility('public')
                    ->directory('partners')
                    ->label(trans('admin.logo')),
                Forms\Components\Select::make('cities')
                    ->multiple()
                    ->preload()
                    ->relationship('cities', 'name', fn (Builder $query) => $query->active()),
                Forms\Components\Select::make('variant')
                    ->label('Вариант')
                    ->options(PartnerHelper::getVariants()),
                Forms\Components\Toggle::make('is_active')
                    ->label(trans('admin.is_active'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('partner.full_name')
                    ->label(trans('admin.partner')),
                Tables\Columns\ImageColumn::make('image')
                    ->width(150)
                    ->height(150)
                    ->disk('s3')
                    ->label(trans('admin.image')),
                Tables\Columns\ImageColumn::make('logo')
                    ->width(150)
                    ->height(150)
                    ->disk('s3')
                    ->label(trans('admin.logo')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->reorderable('lft')
            ->defaultSort('lft');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePartners::route('/'),
        ];
    }
}
