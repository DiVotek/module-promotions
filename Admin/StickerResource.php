<?php

namespace Modules\Promotions\Admin;

use App\Filament\Resources\TranslateResource\RelationManagers\TranslatableRelationManager;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Tables\Actions\Action;
use Modules\Promotions\Admin\StickerResource\Pages;
use App\Services\Schema;
use App\Services\TableSchema;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Promotions\Models\Sticker;

class StickerResource extends Resource
{
    protected static ?string $model = Sticker::class;

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
        return __('Sticker');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Stickers');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Schema::getName(),
                        Schema::getSorting(),
                        Schema::getSelect('type', Sticker::getTypes())
                            ->label(__('Sticker type'))
                            ->required()
                            ->helperText(__('Sticker type'))
                            ->default(0)
                            ->live(),
                        ColorPicker::make('color')
                            ->label(__('Color'))
                            ->helperText(__('Sticker color'))
                            ->required()
                            ->string()->hidden(function (Get $get): bool {
                                return $get('type') != Sticker::TYPE_TEXT;
                            }),
                        Schema::getImage()->hidden(function (Get $get): bool {
                            return $get('type') != Sticker::TYPE_IMAGE;
                        })->helperText(__('Sticker image')),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSchema::getName(),
                TableSchema::getStickerType(),
                TableSchema::getSorting(),
                TableSchema::getUpdatedAt()
            ])
            ->headerActions([
                Schema::helpAction('Sticker help'),
            ])
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
            ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStickers::route('/'),
            'create' => Pages\CreateSticker::route('/create'),
            'edit' => Pages\EditSticker::route('/{record}/edit'),
        ];
    }
}
