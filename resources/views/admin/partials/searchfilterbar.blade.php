{{ Form::open(['method' => 'GET', "url" => url()->current(), 'class' => 'w-100']) }}
    <div class="row mb-3">
        <div class="col-3">
            {{ Form::text('search', (!empty($_GET['search']) ? $_GET['search'] : null), ["class" => "form-control", "placeholder" => "Search..."]) }}
        </div>
        @if (!empty($table['sort_by']))
            <div class="col-2">
                {{ Form::select('sort_by', $table['sort_by'], (!empty($_GET['sort_by']) ? $_GET['sort_by'] : null), ["class" => "form-control", "placeholder" => "Sort by..."]) }}
            </div>
            <div class="col-2">
                {{ Form::select('sort_order', ['asc' => 'Ascending', 'desc' => 'Descending'], (!empty($_GET['sort_order']) ? $_GET['sort_order'] : null), ["class" => "form-control"]) }}
            </div>
        @endif
        <div class="col">
            <input type="submit" value="Filter" class="btn btn-primary">
        </div>
    </div>
{{ Form::close() }}