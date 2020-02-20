@extends('layouts.admin.containers.full-width')

<?php
    $table_headers = ['Module name' => 'name'];
    $table_data_types = ['active' => 'boolean'];
?>

@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.modules.index') }}">Modules</a></li>
        <li>List all</li>
    </ul>
@endsection


@section('container-content')
    @wrapper('admin.partials.widget', ['title' => 'Active modules'])
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                

                <tbody>
                    @foreach($modules['active'] as $module)
                        <tr>
                            <td><input type="checkbox" name="mass_editor[]"</td>
                            <td>{{ $module->getName() }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endwrapper
    
    @wrapper('admin.partials.widget', ['title' => 'Inactive modules'])
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($modules['inactive'] as $module)
                        <tr>
                            <td><input type="checkbox" name="mass_editor[]"</td>
                            <td>{{ $module->getName() }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endwrapper
@endsection