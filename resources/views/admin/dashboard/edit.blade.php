@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">Admin</a></li>
        <li>Dashboard</li>
    </ul>
@endsection

@section('head')
    <script src="{{asset('js/admin/dashboard.js')}}"></script>
@endsection

@section('module-content')
    <div id="dashboard">
        @if (!empty($widgets))
            @foreach($widgets as $key => $row)
                <div class="form-group px-0 col-md-3">
                    <input type="text" id="row[{{$key}}]" class="form-control" placeholder="Name of row" value={{ $row['name'] }}>
                </div>

                <div class="row mb-5" ondrop="drop(event)" data-key="{{ $key }}" ondragover="allowDrop(event)">
                    @foreach($row['widgets'] as $widget => $size)
                        @include('admin.partials.placeholder', ['size' => $size, 'name' => $widget])
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>

    @include('admin.partials.dashboard_controls')

    {{ Form::open(['method' => 'PATCH', 'action' => 'admin\DashboardController@update', 'id' => "dashboard-form"]) }}
        {{ Form::hidden('widgets', null, ['id' => "widgets_array"]) }}
        {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
    {{ Form::close() }}
    
    <style>
        #dashboard .row {
            border: 2px dashed #fff;
            padding: 20px 0;
            background: #dedede;
            margin: 0px 0 20px;
            cursor: pointer;
        }

        #dashboard .row.active {
            border-color: #38c172;
        }
    </style>

    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }
        
        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }
        
        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            if (ev.target.classList.contains('row')) {
                ev.target.appendChild(document.getElementById(data));
            }
        }
    </script>
@endsection
