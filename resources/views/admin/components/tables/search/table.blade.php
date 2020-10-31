<div class="table-responsive">
    <table {{ !empty($table_id) ? 'id='.$table_id.'' : '' }} class="data-list-table table table-striped table-hover">

        {{-- Table headers --}}
        <x-table-headers type="search"/>

        <tbody>
            @foreach($fields as $key => $field)

                {{-- Display fields --}}
                @include('admin.components.tables.search.partials.fields')

            @endforeach
        </tbody>
    </table>
</div>

