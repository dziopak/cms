@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


{{-- Search / Filters bar --}}
@if ((!isset($filters) || $filters === true) && (!isset($controls) || $controls === true))
    @include('admin.partials.searchfilterbar')
@endif


{{-- Form opening --}}
{{ Form::open(['method' => 'POST', "url" => $endpoint ?? url()->current().'/mass', 'class' => 'w-100', 'id' => $form_id ?? '']) }}

    {{-- Table --}}
    <div class="table-responsive">
        <table {{ !empty($id) ? 'id='.$id.'' : '' }} class="data-list-table table table-striped table-hover">
            @include('admin.partials.table.headers')

            <tbody>
                @foreach($fields as $key => $field)
                    <tr data-row="{{ $field->id }}">
                        <td><input type="checkbox" name="mass_edit[{{ $key }}]" value="{{ $field->id }}"></td>
                        @include('admin.partials.table.fields')

                        @if ((!isset($actions) || $actions === true) && (!isset($controls) || $controls === true))
                            @include('admin.partials.table.actions')
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- Mass edit dropdown --}}
    @if ((!isset($mass_action) || $mass_action === true) && (!isset($controls) || $controls === true))
        @include('admin.partials.massedit.massedit')
    @endif


{{ Form::close() }}
