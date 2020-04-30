<?php

namespace App\Widgets\front;

use Arrilot\Widgets\AbstractWidget;

class Login extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
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

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return block('login', decodeBlockConfig($this->config));
    }
}
