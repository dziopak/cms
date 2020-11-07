<?php

namespace App\View\Components\Admin\Widgets;

use Illuminate\View\Component;

class WidgetDivider extends Component
{

    public $config = [
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


    public function render()
    {
        return view('admin.widgets.widget_divider', ['config' => (array) $this->config]);
    }
}
