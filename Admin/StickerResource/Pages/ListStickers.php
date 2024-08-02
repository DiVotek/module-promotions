<?php

namespace Modules\Promotions\Admin\StickerResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Promotions\Admin\StickerResource;

class ListStickers extends ListRecords
{
    protected static string $resource = StickerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
