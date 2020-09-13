<?php

namespace plugins\Testimonials\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use plugins\Testimonials\Entities\Testimonial;
use plugins\Testimonials\Transformers\TestimonialResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Utilities\ModelUtilities;

class TestimonialsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $testimonials = QueryBuilder::for(Testimonial::class)
            ->allowedFilters(['author', AllowedFilter::exact('id')])
            ->allowedSorts(['id', 'created_at', 'updated_at', 'author'])
            ->defaultSort('-created_at');

        return TestimonialResource::collection(ModelUtilities::scope($testimonials, $request));
    }
}
