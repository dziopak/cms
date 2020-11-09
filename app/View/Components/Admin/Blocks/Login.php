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
        if ($block) {
            if (!empty($block->x)) $this->config['x'] = $block->x;
            if (!empty($block->y)) $this->config['y'] = $block->y;
            if (!empty($block->width)) $this->config['w'] = $block->width;
            if (!empty($block->height)) $this->config['h'] = $block->height;
            if (!empty($block->auto)) $this->config['auto'] = false;
            $this->config['block'] = $block;
        }
        $this->config['is_admin'] = $admin;
        $this->config['exists'] = $exists;
    }


    public function render()
    {
        return block('login', decodeBlockConfig($this->config));
    }
}
