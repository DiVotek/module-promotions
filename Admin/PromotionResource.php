<?php

namespace Modules\Promotions\Admin;

use App\Filament\Resources\TranslateResource\RelationManagers\TranslatableRelationManager;
use Filament\Forms\Components\Section;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Tables\Actions\Action;
use Modules\Promotions\Admin\PromotionResource\Pages;
use App\Services\Schema;
use App\Services\TableSchema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Promotions\Admin\PromotionResource\RelationManagers\ProductsRelationManager;
use Modules\Promotions\Models\Promotion;
use Modules\Promotions\Models\Sticker;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Promotions');
    }

    public static function getModelLabel(): string
    {
        return __('Promotion');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Promotions');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Schema::getName(),
                        Schema::getStatus(),
                        Schema::getDateTime('start_date')->helperText(__('Promotion start date')),
                        Schema::getDateTime('end_date')->helperText(__('Promotion end date')),
                        TextInput::make('value')
                            ->numeric()
                            ->helperText(__('Promotion discount value in percents'))
                            ->suffix('%')
                            ->required(),
                        Schema::getSelect('sticker_id', Sticker::query()->pluck('name', 'id')->toArray())
                            ->helperText(__('Promotion sticker'))
                    ])
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSchema::getName(),
                TableSchema::getStatus(),
                TableSchema::getUpdatedAt(),
            ])
            ->headerActions([
                Schema::helpAction('Promotion help'),
            ])
            ->reorderable('sorting')
            ->filters([
                TableSchema::getFilterStatus(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationGroup::make('Seo and translates', [
                TranslatableRelationManager::class,
                ProductsRelationManager::class
            ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }
}
