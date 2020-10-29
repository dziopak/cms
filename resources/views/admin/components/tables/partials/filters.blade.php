{{ Form::open(['method' => 'GET', "url" => url()->current(), 'class' => 'w-100']) }}
    <div class="row my-md-4">

        {{-- Search input --}}
        <div class="col-md-3 mb-md-3">
            {{ Form::text('search', (!empty($_GET['search']) ? $_GET['search'] : null), ["class" => "form-control", "placeholder" =>  __('admin/partials.search')]) }}
        </div>
        {{-- End --}}


        {{-- Sorting --}}
        @if (!empty($sort))
        <div class="col-md-2 mb-md-3">
            {{ Form::select('sort_by', $sort, (!empty($_GET['sort_by']) ? $_GET['sort_by'] : null), ["class" => "form-control", "placeholder" => __('admin/partials.sort_by')]) }}
        </div>
        <div class="col-md-2 mb-md-3">
            {{ Form::select('sort_order', ['asc' => __('admin/partials.asc'), 'desc' => __('admin/partials.desc')], (!empty($_GET['sort_order']) ? $_GET['sort_order'] : null), ["class" => "form-control"]) }}
        </div>
        @endif
        {{-- End --}}


        {{-- Submit button --}}
        <div class="responsive-center col mb-md-3">
            <input type="submit" value="{{ __('admin/partials.filter') }}" class="btn btn-primary">
        </div>
        {{-- End --}}


    </div>
{{ Form::close() }}
