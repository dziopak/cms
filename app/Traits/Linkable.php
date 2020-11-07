<?php

namespace App\Traits;

trait Linkable
{
    public function getUrl()
    {
        if (method_exists($this, 'getSlug')) return route('front.' . $this->entity_type . '.show', $this->getSlug());
        return route('front.' . $this->entity_type . '.show', $this->id);
    }
}
