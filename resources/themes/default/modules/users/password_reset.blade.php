@extends('Theme::index', ['css' => 'users'])

@section('module')
    <div class="user user--login">
        <div class="user user--login row">
            <div class="user__column user__column--login col col-md-6">

            {{-- Title --}}
            <h2>{{ __('Theme::users.password.reset.confirmed.title') }}</h2>
            <p class="user__login-intro">{!! __('Theme::users.password.reset.confirmed.intro') !!}</p>

            {{ Form::open(['method' => 'POST', "route" => 'password.update', 'class' => 'w-100']) }}

                @csrf

                {!! Form::hidden('token', $token) !!}

                    <div class="form-group">
                        {{-- Email input --}}
                        {!! Form::email('email', old('email'), [
                            'id' => 'login_email',
                            'class' => 'form-control form-control user__login-control user__login-control--login '.($errors->has('email') ? 'is-invalid' : ''),
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
                        {{-- Password confirmation field --}}
                        {!! Form::password('password_confirmation', [
                            'id' => 'register_password',
                            'class' => 'form-control user__login-control user__login-control--password '.($errors->has('password_confirmation') && old('action') === 'register' ? 'is-invalid' : ''),
                            'placeholder' => __('Theme::users.fields.repeat_password').'...',
                            'required'
                        ]) !!}

                        {{-- Password confirmation validation --}}
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {!! __('Theme::users.password.reset.confirmed.notice') !!}


                    {{-- Submit button --}}
                    {{ Form::submit(__('Theme::users.password.reset.confirmed.button'), ['class' => 'btn cta']) }}

                    {{-- Go back --}}
                    <a href="{{ route('login') }}" class="login-block__link">{{ __('Theme::general.go_back') }}</a>

                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection


