<?php

namespace App\View\Components\Admin\Blocks;

use Illuminate\View\Component;

class Login extends Component
{

    public $config = [
        'is_admin' => false,
        'h' => 1,
        'w' => 3,
        'min-w' => '3',
        'max-w' => '4',
        'min-h' => '1',
        'max-h' => '1',
        'header' => 'Login form',
        'x' => 0,
        'y' => 0,
        'non-resizeable' => false,
        'id' => 'login-block'
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
        return block('login', decodeBlockConfig($this->config));
    }
}
