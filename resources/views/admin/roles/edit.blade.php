@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">Roles</a></li>
        <li>Edit</li>
    </ul>
@endsection

@section('content')
    {!! Form::model($role, ['method' => 'PATCH', 'action' => ['RolesController@update', $role->id], 'class' => 'col-12']) !!}
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <strong>Basic data</strong>
                    </div>
                    
                    @include('admin.partials.validation')
                    
                    <div class="form-group row">
                        <div class="col">
                            {!! Form::label('name', 'Role name: ') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col">
                            {!! Form::label('description', 'Description: ') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <strong>User's access</strong>
                    </div>
                    
                    <div class="form-group">
                        <span class="text-primary">General rules:</span>
                        <div class="form-check">
                            {!! Form::checkbox('access[ADMIN_VIEW]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[ADMIN_VIEW]', 'Admin panel view', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <span class="text-primary">Users rules:</span>
                        <div class="form-check">
                            {!! Form::checkbox('access[USER_CREATE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[USER_CREATE]', 'Create new users', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[USER_EDIT]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[USER_EDIT]', 'Edit users', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[USER_PASSWORD]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[USER_PASSWORD]', 'Edit user password', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[USER_ROLE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[USER_ROLE]', 'Change user\'s role', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[USER_DELETE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[USER_DELETE]', 'Delete users', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="text-primary">Categories rules:</span>
                        <div class="form-check">
                            {!! Form::checkbox('access[CATEGORY_CREATE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[CATEGORY_CREATE]', 'Create new categories', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[CATEGORY_EDIT]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[CATEGORY_EDIT]', 'Edit categories', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[CATEGORY_DELETE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[CATEGORY_DELETE]', 'Delete categories', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <span class="text-primary">Roles rules:</span>
                        <div class="form-check">
                            {!! Form::checkbox('access[ROLE_CREATE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[ROLE_CREATE]', 'Create new roles', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[ROLE_EDIT]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[ROLE_EDIT]', 'Edit roles', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[ROLE_DELETE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[ROLE_DELETE]', 'Delete roles', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="text-primary">Page rules:</span>
                        <div class="form-check">
                            {!! Form::checkbox('access[PAGE_CREATE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[PAGE_CREATE]', 'Create new pages', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[PAGE_EDIT]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[PAGE_EDIT]', 'Edit pages', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[PAGE_DELETE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[PAGE_DELETE]', 'Delete pages', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <span class="text-primary">Posts rules:</span>
                        <div class="form-check">
                            {!! Form::checkbox('access[POST_CREATE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[POST_CREATE]', 'Create new posts', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[POST_EDIT]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[POST_EDIT]', 'Edit posts', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[POST_DELETE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[POST_DELETE]', 'Delete posts', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="text-primary">Newsletters rules:</span>
                        <div class="form-check">
                            {!! Form::checkbox('access[NEWSLETTER_SEND_MESSAGE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[POST_SEND_MESSAGE]', 'Send messages', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[NEWSLETTER_CREATE_MESSAGE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[NEWSLETTER_CREATE_MESSAGE]', 'Create new messages', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[NEWSLETTER_EDIT_MESSAGE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[NEWSLETTER_EDIT_MESSAGE]', 'Edit messages', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[NEWSLETTER_DELETE_MESSAGE]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[NEWSLETTER_DELETE_MESSAGE]', 'Delete messages', ['class' => 'form-check-label']) !!}
                        </div>
                        
                        <div class="form-check">
                            {!! Form::checkbox('access[NEWSLETTER_CREATE_LAYOUT]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[NEWSLETTER_CREATE_LAYOUT]', 'Create message layouts', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[NEWSLETTER_EDIT_LAYOUTS]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[NEWSLETTER_EDIT_LAYOUTS]', 'Edit message layouts', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::checkbox('access[NEWSLETTER_DELETE_LAYOUT]', '1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('access[NEWSLETTER_DELETE_LAYOUT]', 'Delete message layouts', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection