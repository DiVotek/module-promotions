<?php

namespace Modules\Promotions\Models;

use App\Traits\HasStatus;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    use HasFactory;
    use HasTable;
    use HasStatus;
    use HasTimestamps;
    use HasTranslate;

    public const TABLE = 'stickers';

    public const LATEST = 1;

    protected $table = self::TABLE;

    public const TYPE_IMAGE = 0;

    public const TYPE_TEXT = 1;

    public const types = [
        self::TYPE_IMAGE => 'image',
        self::TYPE_TEXT => 'text',
    ];

    protected $fillable = ['type', 'name', 'color', 'image'];

    public static function getDb(): string
    {
        return 'stickers';
    }

    public static function getTypes(): array
    {
        return array_map(fn ($type) => __($type), self::types);
    }
}
