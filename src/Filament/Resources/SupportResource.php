<?php

namespace Nurdaulet\FluxBase\Filament\Resources;

use Nurdaulet\FluxBase\Facades\StringFormatter;
use Nurdaulet\FluxBase\Filament\Resources\SupportResource\Pages;
use Nurdaulet\FluxBase\Filament\Resources\SupportResource\RelationManagers;
use Nurdaulet\FluxBase\Models\Support;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class SupportResource extends Resource
{
    protected static ?string $model = Support::class;
    protected static ?string $modelLabel = 'поддержку';
    protected static ?string $pluralModelLabel = 'Служба поддержки';

    protected static ?string $navigationIcon = 'heroicon-o-phone-incoming';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 1)->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label(trans('admin.user'))
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
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)->label(trans('admin.description')),
                Forms\Components\TextInput::make('phone')
                    ->label(trans('admin.phone')),
                Forms\Components\FileUpload::make('file')
                    ->disk('s3')
                    ->directory('supports')
                    ->visibility('public')
                    ->label(trans('admin.file')),
                Forms\Components\Toggle::make('status')
                    ->required()->label(trans('admin.status')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->url(fn(Support $record): string => $record->user ? url("/users/{$record->user->id}/edit"  ) : '')
//                    ->when()
                    ->label(trans('admin.user')),
                Tables\Columns\TextColumn::make('user.phone')
//                    ->searchable()
                    ->label(trans('admin.phone'))
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(trans('admin.phone')),

                Tables\Columns\TextColumn::make('description')->wrap()
                    ->label(trans('admin.description')),
                Tables\Columns\TextColumn::make('file')
                    ->label(trans('admin.file'))->wrap()
                    ->url(fn(Support $record): string => $record->file ? url(env('AWS_URL') . '/' . $record->file) : 'Не заполнено')
                    ->openUrlInNewTab(),
                Tables\Columns\BooleanColumn::make('status')
                    ->label(trans('admin.status')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(trans('admin.created_at')),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Отработан')
                    ->action(function (Support $record): void {
                        $record->status = false;
                        $record->save();
                    })
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FilesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupports::route('/'),
            'create' => Pages\CreateSupport::route('/create'),
            'edit' => Pages\EditSupport::route('/{record}/edit'),
        ];
    }
}
