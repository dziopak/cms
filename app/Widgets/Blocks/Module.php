<?php

namespace App\Widgets\Blocks;

use Arrilot\Widgets\AbstractWidget;

class Module extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
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

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return block('module', decodeBlockConfig($this->config));
    }
}
