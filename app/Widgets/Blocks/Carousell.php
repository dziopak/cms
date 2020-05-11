<?php

namespace App\Widgets\Blocks;

use Arrilot\Widgets\AbstractWidget;

class Carousell extends AbstractWidget
{

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

    public function run()
    {
        return block('carousell', decodeBlockConfig($this->config));
    }
}
