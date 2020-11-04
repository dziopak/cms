<?php

namespace App\View\Components\Admin\Blocks;

use Illuminate\View\Component;

class Carousell extends Component
{

    public $config = [
        'is_admin' => false,
        'h' => 1,
        'w' => 12,
        'min-w' => '6',
        'min-h' => '1',
        'header' => 'Carousell',
        'x' => 0,
        'y' => 0,
        'id' => 'carousell-block',
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


    public function render()
    {
        return block('carousell', decodeBlockConfig($this->config));
    }
}
