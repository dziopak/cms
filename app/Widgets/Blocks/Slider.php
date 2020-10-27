<?php

namespace App\Widgets\Blocks;

use Arrilot\Widgets\AbstractWidget;

class Slider extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'is_admin' => false,
        'h' => 1,
        'w' => 12,
        'min-w' => '6',
        'min-h' => '1',
        'header' => 'Slider',
        'x' => 0,
        'y' => 0,
        'non-resizeable' => false,
        'id' => 'slider-block'
    ];

    public function convertSlidersList()
    {
        $all = \App\Entities\Slider::all();
        $sliders = [];

        foreach ($all as $slider) {
            $sliders[$slider->id] = $slider->name;
        }

        return $sliders;
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $this->config = decodeBlockConfig($this->config);
        $slider = \App\Entities\Slider::find($this->config['block']->config['slider_id'] ?? 0);
        return block('slider', $this->config, ['sliders' => $this->convertSlidersList()], ['slider' => $slider]);
    }
}
