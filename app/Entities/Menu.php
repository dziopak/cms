<?php

namespace App\Entities;

use App\Http\Utilities\Admin\Blocks\Menus\MenuActions;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
use App\Traits\EntityTrait;
use App\Http\Utilities\Admin\Blocks\Menus\MenuEntity;
use App\Traits\MassEditable;

class Menu extends Model
{
    use EntityTrait;
    use QueryCacheable, MassEditable;


    protected $guarded = ['items'];
    public $timestamps = false, $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $webEntity = MenuEntity::class;
    protected $massActions = MenuActions::class;


    public function items()
    {
        return $this->hasMany('App\Entities\MenuItem', 'menu')->orderBy('sort');
    }


    static function find($id)
    {
        return self::where(['name' => $id])->orWhere(['id' => $id])->first();
    }
}
