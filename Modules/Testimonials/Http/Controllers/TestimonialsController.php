<?php

namespace Modules\Testimonials\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Testimonials\Entities\Testimonial;
use Modules\Testimonials\Http\Utilities\TableData;
use App\File;

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
            $name = time(). '_' .$thumbnail->getClientOriginalName();
            $thumbnail->move('images/testimonials', $name);
            
            $photo = File::create(['path' => 'testimonials/'.$name, 'type' => '1']);
            $data['file_id'] = $photo->id;

        }
        

        $testimonial = Testimonial::create($data);
        return redirect(route('admin.modules.testimonials.index'));
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('testimonials::edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $data = $request->all();
        
        if ($request->file('thumbnail')) {
            
            $thumbnail = $request->file('thumbnail');
            $name = time(). '_' .$thumbnail->getClientOriginalName();
            $thumbnail->move('images/testimonials', $name);
            
            $photo = File::create(['path' => 'testimonials/'.$name, 'type' => '1']);
            $data['file_id'] = $photo->id;

        }
        

        $testimonial->update($data);
        return redirect(route('admin.modules.testimonials.index'));
    }

    public function delete($id) {
        $testimonial = Testimonial::findOrFail($id);
        return view('testimonials::delete', compact('testimonial'));
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id)->delete();
        return redirect(route('admin.modules.testimonials.index'));
    }
}
