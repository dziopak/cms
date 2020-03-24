@if (Session::has('crud')) 
    <p class="alert alert-success mx-3 w-100">{{ session('crud') }}</p>
@endif

@if (Session::has('error')) 
    <p class="alert alert-danger mx-3 w-100">{{ session('error') }}</p>
@endif