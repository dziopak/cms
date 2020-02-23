{{ Form::open(['method' => 'GET', "url" => url()->current(), 'class' => 'w-100']) }}
    <div class="row mb-3">
        <div class="col-3">
            <input type="text" placeholder="Search..." name="search" class="form-control">
        </div>
        <div class="col">
            <input type="submit" value="Filter" class="btn btn-primary">
        </div>
    </div>
{{ Form::close() }}