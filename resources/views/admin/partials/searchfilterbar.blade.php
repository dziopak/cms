{{ Form::open(['method' => 'GET', "url" => url()->current(), 'class' => 'w-100']) }}
    <div class="row mb-3">


        {{-- Search input --}}
        <div class="col-3">
            {{ Form::text('search', (!empty($_GET['search']) ? $_GET['search'] : null), ["class" => "form-control", "placeholder" =>  __('admin/partials.search')]) }}
        </div>
        {{-- End --}}


        {{-- Sorting --}}
        @if (!empty($table['sort_by']))
            <div class="col-2">
                {{ Form::select('sort_by', $table['sort_by'], (!empty($_GET['sort_by']) ? $_GET['sort_by'] : null), ["class" => "form-control", "placeholder" => __('admin/partials.sort_by')]) }}
            </div>
            <div class="col-2">
                {{ Form::select('sort_order', ['asc' => __('admin/partials.asc'), 'desc' => __('admin/partials.desc')], (!empty($_GET['sort_order']) ? $_GET['sort_order'] : null), ["class" => "form-control"]) }}
            </div>
        @endif
        {{-- End --}}


        {{-- Submit button --}}
        <div class="col">
            <input type="submit" value="{{ __('admin/partials.filter') }}" class="btn btn-primary">
        </div>
        {{-- End --}}


    </div>
{{ Form::close() }}