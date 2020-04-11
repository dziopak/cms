<?php

namespace App\Widgets\front;

use Arrilot\Widgets\AbstractWidget;
use App\Helpers\ThemeHelpers;

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

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        if ($this->config['is_admin']) {
            return view('admin.blocks.header', [
                'config' => $this->config,
            ]);
        } else {
            return view(ThemeHelpers::getBlockPath('header'), [
                'config' => $this->config,
            ]);
        }
    }
}