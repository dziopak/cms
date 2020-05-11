<?php

namespace App\Widgets\Blocks;

use Arrilot\Widgets\AbstractWidget;

class Header extends AbstractWidget
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
        'min-w' => '12',
        'min-h' => '1',
        'header' => 'Header',
        'x' => 0,
        'y' => 0,
        'non-resizeable' => true,
        'id' => 'header-block'
    ];


    public function run()
    {
        return block('header', decodeBlockConfig($this->config));
    }
}
