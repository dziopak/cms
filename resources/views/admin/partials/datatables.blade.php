@push('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
@endpush

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
@endpush


<div class="table-responsive">


    {{-- Table headers --}}
    <table {{ !empty($id) ? 'id='.$id.'' : '' }} class="table table-striped table-hover">
        @include('admin.partials.table.headers')
    </table>
    {{-- End --}}


    {{-- DataTables.js init  --}}
    <script>
        $(document).ready(function() {
            $('#users_table').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.datatables.users') }}",
                "columns": [
                    {
                        "data": "id",
                        "render": function($id) {
                            return '<input type="checkbox" name="mass_edit[]" value="'+$id+'">';
                        }
                    },
                    {
                        "data": "avatar",
                        "render": function(avatar, email) {
                            return '<img src="'+avatar.replace('admin/', '')+'" width="80" alt="user">';
                        }
                    },
                    { "data": "email" },
                    { "data": "is_active" },
                    { "data": "role" },
                    { "data": "created_at" },
                    { "data": "username" },
                    {
                        "data": "id",
                        "sortable" : false,
                        "render": function($id) {
                            @include('admin.partials.table.datatables_actions')
                        }
                    },
                ]
            } );
        });
    </script>
    {{-- End --}}


</div>
