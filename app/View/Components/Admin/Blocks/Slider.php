<?php

namespace App\View\Components\Admin\Blocks;

use Illuminate\View\Component;

class Slider extends Component
{

    public $config = [
        'is_admin' => true,
        'h' => 1,
        'w' => 12,
        'min-w' => '6',
        'min-h' => '1',
        'non-resizeable' => false,
        'header' => 'Slider',
        'x' => 0,
        'y' => 0,
        'id' => 'slider-block',
        'auto' => true
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
        $this->config['block_id'] = $block->id;
        $this->config['is_admin'] = $admin;
        $this->config['exists'] = $exists;
    }



    public function render()
    {
        $this->config = decodeBlockConfig($this->config);

        $slider = \App\Entities\Slider::find($this->config['block']->config['slider_id'] ?? 0);
        $slider_list = \App\Entities\Slider::all()
            ->pluck('name', 'id')
            ->toArray();


        return block('slider', $this->config, ['sliders' => $slider_list], ['slider' => $slider]);
    }
}
