@if ( !Auth::user() )
<div class="login-block">
    {{ Form::open(['method' => 'POST', "url" => '/login', 'class' => 'w-100']) }}


    <strong class="login-block__title">User panel</strong>
    {{-- <p class="login-block__content">Enter your credentials to log in.</p> --}}

    <div class="form-group">
        {{ Form::text('email', null, ['class' => 'form-control login-block__input', 'placeholder' => 'Email address...'])}}
    </div>

    <div class="form-group">
        {{ Form::password('password', ['class' => 'form-control login-block__input', 'placeholder' => 'Password...'])}}
    </div>

    {{ Form::submit('Log in', ['class' => 'btn btn-primary']) }}
    <a href="" class="login-block__link">Register</a>
    <a href="" class="login-block__link">Forgot password</a>
</div>

@endif
