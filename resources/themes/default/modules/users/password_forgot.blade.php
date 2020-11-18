@extends('Theme::index', ['css' => 'users'])

@section('module')
    <div class="user user--login">
        <div class="user user--login row">
            <div class="user__column user__column--login col col-md-6">

            {{-- Title --}}
            <h2>{{ __('Theme::users.password.reset.title') }}</h2>
            <p class="user__login-intro">{{ __('Theme::users.password.reset.intro') }}</p>

            {{ Form::open(['method' => 'POST', "route" => 'password.email', 'class' => 'w-100']) }}

                    @csrf

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

                    {{-- Show status --}}
                    @if (session('status'))
                        <div class="alert alert-success mt-4" role="alert">
                            <small>{{ session('status') }}</small>
                        </div>
                    @endif

                    {{-- Submit button --}}
                    {{ Form::submit(__('Theme::users.password.reset.button'), ['class' => 'btn cta']) }}

                    {{-- Go back --}}
                    <a href="{{ route('login') }}" class="login-block__link">{{ __('Theme::general.go_back') }}</a>

                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection


