@extends('layouts.admin')

@section('breadcrumbs')

@endsection

@section('content')
<iframe src="{{ route('unisharp.lfm.show')}}?type=image" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
@endsection