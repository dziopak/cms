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
        'header' => 'Module',
        'x' => 0,
        'y' => 0,
        'id' => 'module-block',
    ];


    public function __construct($block, $admin = false, $exists = false)
    {
        $this->config['x'] = $block->x;
        $this->config['y'] = $block->y;
        $this->config['w'] = $block->width;
        $this->config['h'] = $block->height;
        $this->config['block_id'] = $block->id;
        $this->config['is_admin'] = $admin;
        $this->config['exists'] = $exists;
        $this->config['block'] = $block;
    }

    public function convertSlidersList()
    {
        $all = \App\Entities\Slider::all();
        $sliders = [];

        foreach ($all as $slider) {
            $sliders[$slider->id] = $slider->name;
        }

        return $sliders;
    }


    public function render()
    {
        $this->config = decodeBlockConfig($this->config);
        $slider = \App\Entities\Slider::find($this->config['block']->config['slider_id'] ?? 0);
        return block('slider', $this->config, ['sliders' => $this->convertSlidersList()], ['slider' => $slider]);
    }
}
