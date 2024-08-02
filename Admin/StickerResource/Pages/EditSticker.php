<?php

namespace Modules\Promotions\Admin\StickerResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Promotions\Admin\StickerResource;

class EditSticker extends EditRecord
{
    protected static string $resource = StickerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
