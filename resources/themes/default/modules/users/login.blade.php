@extends('Theme::index', ['css' => 'users'])

@section('module')
    <div class="user user--login">

        {{-- Title --}}
        <h2>{{ __('Theme::users.log_in') }}</h2>

        {{ Form::open(['method' => 'POST', "url" => '/login', 'class' => 'w-100']) }}
            <div class="form-group">
                {{ Form::text('email', null, ['class' => 'form-control user__login-control user__login-control--login', 'placeholder' => 'Email address...'])}}
            </div>

            <div class="form-group">
                {{ Form::password('password', ['class' => 'form-control user__login-control user__login-control--password', 'placeholder' => 'Password...'])}}
            </div>

            {{ Form::submit('Log in', ['class' => 'btn cta']) }}

            <a href="" class="login-block__link">Register</a>
            <a href="" class="login-block__link">Forgot password</a>
        {{ Form::close() }}

    </div>
@endsection


