<?php

namespace plugins\Testimonials\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use plugins\Testimonials\Entities\Testimonial;
use plugins\Testimonials\Http\Utilities\TableData;
use App\Models\File;

class TestimonialsController extends Controller
{

    public function index(Request $request)
    {
        $testimonials = Testimonial::filter($request)->paginate(15);
        $table = TableData::testimonialsIndex();
        return view('testimonials::index', compact('testimonials', 'table'));
    }


    public function create()
    {
        return view('testimonials::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->file('thumbnail')) {

            $thumbnail = $request->file('thumbnail');
            $name = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move('images/testimonials', $name);

            $photo = File::create(['path' => 'testimonials/' . $name, 'type' => '1']);
            $data['file_id'] = $photo->id;
        }


        Testimonial::create($data);
        return redirect(route('admin.plugins.testimonials.index'));
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $form = getModuleData('testimonials_form', 'Testimonials', ['thumbnail' => getThumbnail($testimonial->thumbnail)]);
        return view('testimonials::edit', compact('form', 'testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $data = $request->all();

        $testimonial->update($data);
        return redirect(route('admin.plugins.testimonials.index'));
    }

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('testimonials::delete', compact('testimonial'));
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id)->delete();
        return redirect(route('admin.plugins.testimonials.index'));
    }
}
