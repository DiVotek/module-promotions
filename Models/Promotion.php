<?php

namespace Modules\Promotions\Models;

use App\Traits\HasStatus;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;
use Modules\Products\Models\Product;
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

    public const TABLE = 'promotions';

    public const TYPE_PRICE = 1;

    public const TYPE_PERCENTAGE = 2;

    public const TYPES = [
        self::TYPE_PRICE => 'Price',
        self::TYPE_PERCENTAGE => 'Percentage',
    ];

    protected $table = self::TABLE;

    protected $fillable = [
        'type',
        'name',
        'value',
        'sticker_id',
        'start_date',
        'end_date',
        'status'
    ];

    protected $casts = ['value' => 'array'];

    public static function getDb(): string
    {
        return 'promotions';
    }

    public static function getTypes(): array
    {
        return array_map(function ($type) {
            return __($type);
        }, self::TYPES);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_promotion')->withPivot('price');
    }
}
