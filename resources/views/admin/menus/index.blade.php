@extends('layouts.admin')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>Manage menus</strong>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                {!! Menu::render() !!}
            </div>
        </div>
    </div>
    {!! Menu::scripts() !!}
@endsection