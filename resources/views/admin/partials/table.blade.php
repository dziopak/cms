@include('admin.partials.searchfilterbar') 
<div class="table-responsive">
    <table {{ !empty($id) ? 'id='.$id.'' : '' }} class="table table-striped table-hover">
        @include('admin.partials.table.headers')

        <tbody>
            @foreach($fields as $key => $field)
                <tr>
                    <td><input type="checkbox" name="mass_edit[{{ $key }}]" value="{{ $field->id }}"></td>
                    @include('admin.partials.table.fields')
                    @include('admin.partials.table.actions')
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('admin.partials.massedit')