<?php

namespace App\Entities;

use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use App\Entities\Block;
use App\Traits\Filterable;

class Layout extends Model
{
    use Filterable, QueryCacheable;

    protected static $flushCacheOnUpdate = true;
    public $cacheFor = 3600, $timestamps = false;
    private $searchIn = ['name'];
    protected $guarded = [];


    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }


    public function scopelist()
    {
        return Layout::select('id', 'name')->pluck('name', 'id');
    }


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($layout) {
            $layout->blocks()->delete();
        });
    }

    public function getLayout()
    {
        $widgets = $this->blocks()->orderBy('y')->orderBy('x')->get();

        $blocks = [];
        $merge = [];

        foreach ($widgets as $block) {
            if ($block->height > 1) {
                $merge[$block->y] = $block->y + $block->height;
            }
            $blocks[$block->y][] = $block;
        }


        foreach ($merge as $start => $end) {
            for ($i = $start + 1; $i < $end; $i++) {
                if (!empty($blocks[$i])) {
                    $blocks[$start] = array_merge($blocks[$start], $blocks[$i]);
                    unset($blocks[$i]);
                }
                if (!empty($merge[$i]) && $merge[$i] > $end) {
                    $end = $merge[$i];
                }
            }
        }

        $res = [];
        foreach ($blocks as $key => $row) {
            $res[$key]['container'] = 0;
            foreach ($row as $block) {
                if ($block->container === 1) $res[$key]['container'] = $block->container;
                $res[$key][$block->x]['BLOCKS'][] = $block;
                if (empty($res[$key][$block->x]['COLUMN_WIDTH']) || $res[$key][$block->x]['COLUMN_WIDTH'] < $block->width) {
                    $res[$key][$block->x]['COLUMN_WIDTH'] = $block->width;
                }
            }
        }


        return $res;
    }
}
