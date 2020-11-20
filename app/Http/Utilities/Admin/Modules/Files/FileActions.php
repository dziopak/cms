<?php

namespace App\Http\Utilities\Admin\Modules\Files;

use Auth;

class FileActions
{
    protected $items;
    private $request;


    public function __construct($items, $request)
    {
        $this->items = $items;
        $this->request = $request;
    }


    public function delete()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');

        dispatchEvent(FileDestroyEvent::class, $this->items, function () {
            $this->items->delete();
            flushCache('File');
        });

        return redirect()->back()->with('crud', __('admin/messages.categories.mass.universal'));
    }
}
