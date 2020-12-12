<?php

namespace App\Traits;

trait Listable
{

    public function getClassName()
    {
        return strtolower((new \ReflectionClass($this))->getShortName());
    }

    public function scopeExcept($query, $id)
    {
        return $query->where('id', '!=', $id);
    }

    private function exceptCurrent($query)
    {
        $name = $this->getClassName();
        $request = request()->route();

        if (empty($request->parameters[$name])) return $query;
        return $this->scopeExcept($query, $request->parameters[$name]);
    }

    public function scopeList($query, $withZero = true, $except = false)
    {
        if ($except) $items = $this->exceptCurrent($query);
        $items = $query->pluck('name', 'id')->toArray();
        if (!$withZero) return $query->pluck('name', 'id')->toArray();

        return array(0 => __('admin/post_categories.no_category')) + $items;
    }
}
