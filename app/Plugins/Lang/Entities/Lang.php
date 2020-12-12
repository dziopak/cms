<?php

namespace App\Plugins\Lang\Entities;

use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Plugins\Lang\Entities\Lang
 *
 * @property int $id
 * @property string $name
 * @property string $origin_name
 * @property string $lang_tag
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Lang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lang query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lang whereLangTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lang whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lang whereOriginName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lang whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Lang extends Model
{
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $fillable = ['name', 'origin_name', 'lang_tag'];
}
