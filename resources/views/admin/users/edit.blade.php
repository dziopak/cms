@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('content-left')
    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['Admin\Modules\UsersController@update', $user->id], 'files' => 'true']) !!}
        <x-wrapper title="admin/users.edit_right_title">

            <div class="row">
                <div class="col" style="max-width: 200px;">

                    {{-- Display avatar --}}
                    <x-form-fields :fields="$form['profile']['avatar']" />

                </div>

                <div class="col" style="display: inline-block;">
                    <strong>{{'@'.$user->name}}</strong><br/>

                    @if ($user->first_name && $user->last_name)
                        <span>{{$user->first_name.' '.$user->last_name}}</span><br/>
                    @endif

                    {{ __('admin/general.created_at') }} {{$user->created_at}}<br/>
                    <small>{{$user->role->name}}</small>
                </div>
            </div>
        </x-wrapper>

        <x-wrapper title="admin/users.edit_left_title">

            {{-- Validation report --}}
            <x-form-validation :errors="$errors" />

            {{-- Display form --}}
            <x-form-fields :fields="$form['basic_data']" />

            {{-- Save button --}}
            <div class="form-group">
                <input type="hidden" value="{{$user->id}}" name="user_id" />
                {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
            </div>

        </x-wrapper>
    {!! Form::close() !!}
@endsection


@section('content-right')

    <x-wrapper title="admin/users.recent_actions">

        {{-- Display logs --}}
        <x-logs :data="$logs" />

    </x-wrapper>

    <x-wrapper title="admin/users.change_password">

        {{-- Open the form --}}
        {!! Form::open(['method' => 'PUT', 'action' => ['Admin\Modules\UsersController@password', $user->id]]) !!}

        {{-- Display form --}}
        <x-form-fields :fields="$form['password_change']" />

        {{-- Save button --}}
        <x-update-button />

        {{-- Close the form --}}
        {!! Form::close() !!}

    </x-wrapper>

@endsection
