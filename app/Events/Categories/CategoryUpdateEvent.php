<?php

namespace App\Events\Categories;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CategoryUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $category;
    public $type;


    public function __construct($category)
    {
        $this->category = $category;
        $this->type = $this->getCategoryType();
    }


    private function getCategoryType()
    {
        $class = (new \ReflectionClass($this->category))->getShortName();
        return strtoupper(str_replace('Category', '', $class));
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
