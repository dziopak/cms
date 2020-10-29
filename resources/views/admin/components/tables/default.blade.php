{{-- Search / Filters bar --}}
@if ($filters)
    <x-table-filters :sort="$table['sort_by']" />
@endif


{{-- Form opening --}}
@if ($form)
{{ Form::open(['method' => 'POST', "url" => $endpoint ?? url()->current().'/mass', 'class' => 'w-100', 'id' => $form_id ?? '']) }}
@endif

    {{-- Table --}}
    <div class="table-responsive">
        <table {{ !empty($table_id) ? 'id='.$table_id.'' : '' }} class="data-list-table table table-striped table-hover">

            {{-- Display table headers --}}
            <x-table-headers
                :headers="$table['headers']"
                :actions="$table['actions']"
                :show_actions="$actions"
            />

            <tbody>
                @foreach($fields as $key => $field)
                    <tr data-row="{{ $field->id }}">

                        {{-- Mass edit checkbox --}}
                        <td><input type="checkbox" name="mass_edit[{{ $key }}]" value="{{ $field->id }}"></td>

                        {{-- Display table records --}}
                        <x-table-fields :table="$table" :field="$field" />

                        {{-- Display actions --}}
                        @if ($actions)
                            <x-table-actions :field="$field" :actions="$table['actions']" />
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- Mass edit dropdown --}}
    @if ($mass)
        <x-mass-edit :table="$table" />
    @endif

@if ($form)
{{ Form::close() }}
@endif
