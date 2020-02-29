@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">Admin</a></li>
        <li>Dashboard</li>
    </ul>
@endsection

@section('module-content')
    <div id="dashboard">
        @if (!empty($widgets))
            @foreach($widgets as $key => $row)
                <strong>{{ $row['name'] }}</strong>
                <div class="row mt-2">
                    @foreach($row['widgets'] as $widget => $size)
                        @widget('admin.'.$widget, ['size' => '2', 'count' => 5])
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
@endsection
