<?php

namespace App\View\Components\Admin\Blocks;

use Illuminate\View\Component;

class Module extends Component
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


    public function __construct($block = null, $admin = false, $exists = false)
    {
        if ($block) {
            $this->config['x'] = $block->x;
            $this->config['y'] = $block->y;
            $this->config['w'] = $block->width;
            $this->config['h'] = $block->height;
            $this->config['block_id'] = $block->id;
            $this->config['block'] = $block;
        }
        $this->config['is_admin'] = $admin;
        $this->config['exists'] = $exists;
    }


    public function render()
    {
        return block('module', decodeBlockConfig($this->config));
    }
}
