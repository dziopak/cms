<?php

    namespace App\Http\Utilities\Admin;

    use App\Http\Utilities\ModelUtilities;
    use App\Page;
    use Auth;

    class PageUtilities {


        public static function store($request) {
            $data = $request->except('thumbnail');
            $data['user_id'] = Auth::user()->id;

            Page::create($data);
            return redirect(route('admin.pages.index'));
        }


        public static function update($id, $request) {
            $data = ModelUtilities::makeDirtyRequest($request->file('thumbnail'), $request->except('thumbnail'));
            $page = Page::findOrFail($id)->update($data);

            return redirect(route('admin.pages.index'));
        }


        public static function destroy($id) {
            $page = Page::findOrFail($id)->delete();
            return redirect(route('admin.pages.index'));
        }


        public static function massAction($request) {
            $data = $request->all();
            if (empty($data['mass_edit'])) {
                return redirect()->back()->with('error', 'No pages were selected.');
            } else {
                switch($data['mass_action']) {
                    case 'delete':
                        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
                        Page::whereIn('id', $data['mass_edit'])->delete();
                    break;

                    case 'hide':
                        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
                        Page::whereIn('id', $data['mass_edit'])->update(['is_active' => 0]);
                    break;

                    case 'show':
                        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
                        Page::whereIn('id', $data['mass_edit'])->update(['is_active' => 1]);
                    break;

                    case 'category':
                        // TO DO //
                        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
                        return redirect()->back()->with('error', 'Functionality not ready yet.');
                    break;
                }
            }
            return redirect(route('admin.pages.index'));
        }
    }
