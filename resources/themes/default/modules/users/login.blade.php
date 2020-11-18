@extends('Theme::index', ['css' => 'users'])

@section('module')
    <div class="user user--login row">
        <div class="user__column user__column--login col col-md-6">

            {{-- Title --}}
            <h2>{{ __('Theme::users.login.title') }}</h2>
            <p class="user__login-intro">{{ __('Theme::users.login.intro') }}</p>

            {{ Form::open(['method' => 'POST', "url" => route('login'), 'class' => 'w-100']) }}
                @csrf

                <div class="form-group">
                    {{-- Email input --}}
                    {!! Form::email('email', old('email'), [
                        'id' => 'login_email',
                        'class' => 'form-control form-control user__login-control user__login-control--login '.($errors->has('email') && old('action') === 'login' ? 'is-invalid' : ''),
                        'placeholder' => __('Theme::users.fields.email').'...',
                        'autofocus', 'required'
                    ]) !!}

                    {{-- Email validation --}}
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    {{-- Password field --}}
                    {!! Form::password('password', [
                        'id' => 'password',
                        'class' => 'form-control user__login-control user__login-control--password '.($errors->has('password') && old('action') === 'login' ? 'is-invalid' : ''),
                        'placeholder' => __('Theme::users.fields.password').'...',
                        'autocomplete' => "current-password",
                        'required'
                    ]) !!}

                    {{-- Password validation --}}
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="user__social-login">
                    <a href="{{ url('login/facebook') }}" class="user__social-login-button user__social-login-button--facebook"></a>
                    <a href="{{ url('login/google') }}" class="user__social-login-button user__social-login-button--google"></a>
                    <a href="{{ url('login/github') }}" class="user__social-login-button user__social-login-button--github"></a>
                </div>


                {{-- Remember me field --}}
                <div class="form-group user__remember-group">
                    {!! Form::checkbox('remember', 1, old('remember'), [
                        'class' => 'form-control user__login-control user__login-control--checkbox'
                    ]) !!}
                    <label class="user__label" for="remember">
                        {{ __('Theme::users.fields.remember') }}
                    </label>
                </div>

                {{-- Action type hidden field --}}
                {!! Form::hidden('action', 'login') !!}


                {{-- Submit button --}}
                {{ Form::submit(__('Theme::users.login.button'), ['class' => 'btn cta']) }}

                {{-- Remind password link --}}
                <a href="{{ route('password.request') }}" class="login-block__link">{{ __('Theme::users.password.reset.link') }}</a>

            {{ Form::close() }}

        </div>


        <div class="user__column user__column--register col col-md-6">

            {{-- Title --}}
            <h2>{{ __('Theme::users.register.title') }}</h2>
            <p class="user__login-intro">{{ __('Theme::users.register.intro') }}</p>

            {{ Form::open(['method' => 'POST', "url" => '/register', 'class' => 'w-100']) }}
                <div class="form-group">
                    {!! Form::text('name', old('name'), [
                        'id' => 'register_name',
                        'class' => 'form-control form-control user__login-control user__login-control--login '.($errors->has('name') && old('action') === 'name' ? 'is-invalid' : ''),
                        'placeholder' => __('Theme::users.fields.username').'...',
                        'autocomplete' => "name",
                        'autofocus', 'required'
                    ]) !!}

                    {{-- Email validation --}}
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::email('email', old('email'), [
                        'id' => 'register_email',
                        'class' => 'form-control form-control user__login-control user__login-control--login '.($errors->has('email') && old('action') === 'register' ? 'is-invalid' : ''),
                        'placeholder' => __('Theme::users.fields.email').'...',
                        'autocomplete' => "email",
                        'autofocus', 'required'
                    ]) !!}

                    {{-- Email validation --}}
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {{-- Password field --}}
                    {!! Form::password('password', [
                        'id' => 'register_password',
                        'class' => 'form-control user__login-control user__login-control--password '.($errors->has('password') && old('action') === 'register' ? 'is-invalid' : ''),
                        'placeholder' => __('Theme::users.fields.password').'...',
                        'autocomplete' => "new-password",
                        'required'
                    ]) !!}

                    {{-- Password validation --}}
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {{-- Password field --}}
                    {!! Form::password('password_confirmation', [
                        'id' => 'register_password',
                        'class' => 'form-control user__login-control user__login-control--password '.($errors->has('password_confirmation') && old('action') === 'register' ? 'is-invalid' : ''),
                        'placeholder' => __('Theme::users.fields.repeat_password').'...',
                        'required'
                    ]) !!}
                </div>

                {{-- Action type hidden field --}}
                {!! Form::hidden('action', 'register') !!}

                {{-- Social login button --}}
                <div class="user__social-register">
                    <a href="{{ url('login/facebook') }}" class="user__social-register-button user__social-register-button--facebook">
                        Facebook
                    </a>

                    <a href="{{ url('login/google') }}" class="user__social-register-button user__social-register-button--google">
                        Google
                    </a>

                    <a href="{{ url('login/github') }}" class="user__social-register-button user__social-register-button--github">
                        Github
                    </a>
                </div>

                {{-- Submit button --}}
                {{ Form::submit(__('Theme::users.register.button'), ['class' => 'btn cta cta-success']) }}

            {{ Form::close() }}

        </div>
    </div>
@endsection
