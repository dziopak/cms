<?php

namespace App\Plugins\Lang\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Plugins\Lang\Utilities\DatabaseActions;
use App\Plugins\Lang\Entities\Lang;


class LangsController extends Controller
{

    public function index()
    {
        $langs = Lang::all();
        $table = getModuleData('lang_index_table', 'Lang');

        return view('Lang::index', compact('langs', 'table'));
    }


    public function create()
    {
        $form = getModuleData('lang_form', 'lang');
        return view('Lang::create', compact('form'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        (new DatabaseActions($data['lang_tag']))->createLang();

        Lang::create($data);
        return redirect(route('Lang::index'));
    }


    public function edit($lang_id)
    {
        $form = getModuleData('lang_form', 'lang');
        $lang = Lang::findOrFail($lang_id);
        return view('Lang::edit', compact('lang', 'form'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['lang_tag']);

        Lang::findOrFail($id)->update($data);

        return redirect(route('Lang::index'));
    }


    public function delete($id)
    {
        $lang = Lang::findOrFail($id);
        return view('Lang::delete', compact('lang'));
    }


    public function destroy($id)
    {
        ($lang = Lang::findOrFail($id))->delete();

        (new DatabaseActions($lang->lang_tag))->deleteLang();
        return redirect(route('Lang::index'));
    }


    public function setLang(Request $request)
    {
        session(['lang' => $request->get('lang')]);
        return redirect()->back();
    }
}
