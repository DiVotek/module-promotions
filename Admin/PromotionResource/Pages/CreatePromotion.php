<?php

namespace Modules\Promotions\Admin\PromotionResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Promotions\Admin\PromotionResource;

class CreatePromotion extends CreateRecord
{
    protected static string $resource = PromotionResource::class;
}
