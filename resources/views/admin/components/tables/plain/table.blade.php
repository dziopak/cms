{{-- Table --}}
<div class="table-responsive">
    <table {{ !empty($table_id) ? 'id='.$table_id.'' : '' }} class="data-list-table table table-striped table-hover table-plain">

        {{-- Display table headers --}}
        @include('admin.components.tables.plain.partials.headers', ['headers' => $table['headers']])

        <tbody>
            @foreach((array) $fields as $key => $field)

                @php
                    $field = (array) $field;
                @endphp

                <tr data-row="{{ $field->id ?? $field['id'] ?? $key }}">

                    {{-- Display table records --}}
                    <x-table-fields :table="$table" :field="$field" />

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

