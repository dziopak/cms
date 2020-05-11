<?php

namespace App\Widgets\Dashboard;

use Arrilot\Widgets\AbstractWidget;

class WidgetDivider extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'max-h' => 1,
        'w' => 12,
        'h' => 1,
        'min-h' => 1,
        'min-w' => 12,
        'x' => 0,
        'y' => 0,
        'id' => 'widgetDivider',
        'auto' => true,
        'non-resizeable' => true,
        'header' => 'Testowy divider',
        'editable' => 'header'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('admin.widgets.widget_divider', [
            'config' => $this->config,
        ]);
    }
}
