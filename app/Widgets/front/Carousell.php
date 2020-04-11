<?php

namespace App\Widgets\front;

use Arrilot\Widgets\AbstractWidget;
use App\Helpers\ThemeHelpers;

class Carousell extends AbstractWidget
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
        'header' => 'Carousell',
        'x' => 0,
        'y' => 0,
        'id' => 'carousell-block',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        if ($this->config['is_admin']) {
            return view('admin.blocks.carousell', [
                'config' => $this->config,
            ]);
        } else {
            return view(ThemeHelpers::getBlockPath('carousell'), [
                'config' => $this->config,
            ]);
        }
    }
}
