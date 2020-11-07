<?php

namespace App\View\Components\Admin\Blocks;

use Illuminate\View\Component;

class Carousel extends Component
{

    public $config = [
        'is_admin' => false,
        'h' => 1,
        'w' => 1,
        'min-w' => '1',
        'min-h' => '1',
        'header' => 'Empty space',
        'x' => 0,
        'y' => 0,
        'id' => 'empty-block',
    ];

    public function __construct($block, $admin = false, $exists = false)
    {
        if ($block) {
            if (!empty($block->x)) $this->config['x'] = $block->x;
            if (!empty($block->y)) $this->config['y'] = $block->y;
            if (!empty($block->width)) $this->config['w'] = $block->width;
            if (!empty($block->height)) $this->config['h'] = $block->height;
            if (!empty($block->auto)) $this->config['auto'] = $block->auto;
            $this->config['block'] = $block;
        }
        $this->config['is_admin'] = $admin;
        $this->config['exists'] = $exists;
    }


    public function render()
    {
        $this->config = decodeBlockConfig($this->config);
        return block('carousel', $this->config);
    }
}
