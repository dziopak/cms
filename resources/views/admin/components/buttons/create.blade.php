@if (empty($access) || Auth::user()->hasAccess($access))

    {{-- Link --}}
    @if (!empty($route))
    <a href="{{ route($route) }}" class="btn btn-success">
        <i class="fa fa-plus" aria-hidden="true"></i>
        {{ __('admin/general.create_button') }}
    </a>

    {{-- Button --}}
    @else
        <button type="submit" class="btn btn-success">
            <i class="fa fa-plus" aria-hidden="true"></i>
            {{ __('admin/general.create_button') }}
        </button>
    @endif

@endif
