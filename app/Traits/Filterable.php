<?php

namespace App\Traits;

trait Filterable
{
    public function scopeSearch($query)
    {
        $request = request();
        if (empty($request->get('search'))) return $query;

        foreach ($this->searchIn as $search) {
            $query->orWhere($search, 'like', '%' . $request->get('search') . '%');
        }

        return $query;
    }

    public function scopeSort($query)
    {
        $request = request();
        $sort_by = $request->get('sort_by') ?? null;
        $sort_order = $request->get('sort_order') ?? 'desc';

        if (empty($sort_by)) {
            return $this->timestamps !== false ? $query->orderByDesc('created_at') : $query->orderByDesc('id');
        }

        return $sort_order == 'desc' ? $query->orderByDesc($sort_by) : $query->orderBy($sort_by);
    }

    public function scopeFilter($query)
    {
        return $query->search()->sort();
    }
}
