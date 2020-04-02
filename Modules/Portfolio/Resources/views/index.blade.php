@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="http://cms.test/admin/">Admin</a></li>
        <li><a href="http://cms.test/admin/modules/">Modules</a></li>
        <li><a href="http://cms.test/admin/modules/portfolio/">Portfolio</a></li>
        <li>List items</li>
    </ul>
@endsection

@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'All items'])
    
        
        {{-- Table --}}
        @include('admin.partials.table', ['fields' => $items])
        {{-- End --}}
        
        
        {{-- Create button --}}
            @if (Auth::user()->hasAccess('MODULE_USE'))
            <a href="{{ route('admin.modules.portfolio.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
            @endif
        {{-- End --}}

    
        {{-- Pagination --}}
        <div class="float-right">{{ $items->render() }}</div>
        {{-- End --}}

    
        @endwrapper
    @endsection
