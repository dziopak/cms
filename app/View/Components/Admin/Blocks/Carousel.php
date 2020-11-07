<?php

namespace App\View\Components\Admin\Blocks;

use Illuminate\View\Component;

class Carousel extends Component
{

    public $config = [
        'is_admin' => false,
        'h' => 1,
        'w' => 12,
        'min-w' => '6',
        'min-h' => '1',
        'header' => 'Carousel',
        'x' => 0,
        'y' => 0,
        'id' => 'carousel-block',
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

        $carousel = \App\Entities\Carousel::find($this->config['block']->config['carousel_id'] ?? 0);
        $carousel_list = \App\Entities\Carousel::all()
            ->pluck('name', 'id')
            ->toArray();

        return block('carousel', $this->config, ['carousels' => $carousel_list], ['carousel' => $carousel]);
    }
}
