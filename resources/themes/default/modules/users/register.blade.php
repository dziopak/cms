@extends('Theme::index', ['css' => 'users'])

@section('module')
    <div class="user user--login">

        {{-- Title --}}
        <h2>{{ __('Theme::users.register') }}</h2>

        {{ Form::open(['method' => 'POST', "url" => '/register', 'class' => 'w-100']) }}
            <div class="form-group">
                {{ Form::email('email', null, ['class' => 'form-control user__login-control user__login-control--login', 'placeholder' => __('Theme::users.email').'...'])}}
            </div>

            <div class="form-group">
                {{ Form::password('password', ['class' => 'form-control user__login-control user__login-control--password', 'placeholder' => __('Theme::users.password').'...'])}}
            </div>

            <div class="form-group">
                {{ Form::password('repeat_password', ['class' => 'form-control user__login-control user__login-control--password', 'placeholder' => __('Theme::users.repeat_password').'...'])}}
            </div>

            {{ Form::submit(__('Theme::users.register_button'), ['class' => 'btn cta']) }}

        {{ Form::close() }}

    </div>
@endsection


