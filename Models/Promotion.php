<?php

namespace Modules\Promotions\Models;

use App\Traits\HasStatus;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;
use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    use HasFactory;
    use HasTable;
    use HasStatus;
    use HasTimestamps;
    use HasTranslate;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'discount',
        'sticker_id',
        'value',
        'status'
    ];

    public static function getDb(): string
    {
        return 'promotions';
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_promotions', 'product_id', 'promotion_id');
    }
}
