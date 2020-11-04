<?php

namespace App\View\Components\Admin\Blocks;

use Illuminate\View\Component;

class Footer extends Component
{

    public $config = [
        'is_admin' => false,
        'h' => 1,
        'w' => 12,
        'min-w' => '12',
        'min-h' => '1',
        'non-resizeable' => true,
        'header' => 'Footer',
        'x' => 0,
        'y' => 0,
        'id' => 'footer-block',
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
        return block('footer', decodeBlockConfig($this->config));
    }
}
