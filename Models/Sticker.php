<?php

namespace Modules\Promotions\Models;

use App\Traits\HasSorting;
use App\Traits\HasStatus;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\Product;
use Nwidart\Modules\Facades\Module;

class Sticker extends Model
{
    use HasFactory;
    use HasTable;
    use HasSorting;
    use HasStatus;
    use HasTimestamps;
    use HasTranslate;

    public const TYPE_IMAGE = 0;

    public const TYPE_TEXT = 1;

    public const types = [
        self::TYPE_IMAGE => 'image',
        self::TYPE_TEXT => 'text',
    ];

    protected $fillable = ['name', 'type', 'color', 'image'];

    public static function getDb(): string
    {
        return 'stickers';
    }

    public static function getTypes(): array
    {
        return array_map(fn ($type) => __($type), self::types);
    }

    public function products()
    {
        if (Module::find('Product') && Module::find('Product')->isEnabled()) {
            return $this->belongsToMany(Product::class, 'product_stickers', 'product_id', 'sticker_id');
        }
    }
}
