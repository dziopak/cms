<?php

namespace Modules\Portfolio\Events;

use Illuminate\Queue\SerializesModels;

class PortfolioItemUpdateEvent
{
    use SerializesModels;

    public $item;
    public $thumbnail;

    public function __construct($item, $thumbnail)
    {
        $this->item = $item;
        $this->thumbnail = $thumbnail;
    }
}
