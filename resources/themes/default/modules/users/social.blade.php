@extends('Theme::index', ['css' => 'users'])

@section('module')
    <div class="user user--login row">
        <div class="user__column user__column--login col col-md-6">


            <form class="d-inline" method="POST" action="{{ route('front.user.social.update') }}">
                @csrf

                {{-- Title --}}
                <h2>{{ __('Theme::users.social.profile.complete.title') }}</h2>
                <p class="user__login-intro">{{ __('Theme::users.social.profile.complete.title') }}</p>


                @if ($fields['email'])
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
                @endif


                @if($fields['password'])
                    <div class="form-group">
                        {{-- Password field --}}
                        {!! Form::password('password', [
                            'id' => 'password',
                            'class' => 'form-control user__login-control user__login-control--password '.($errors->has('password') ? 'is-invalid' : ''),
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


                    <div class="form-group">
                        {{-- Password field --}}
                        {!! Form::password('password_confirmation', [
                            'id' => 'register_password',
                            'class' => 'form-control user__login-control user__login-control--password '.($errors->has('password_confirmation') ? 'is-invalid' : ''),
                            'placeholder' => __('Theme::users.fields.repeat_password').'...',
                            'required'
                        ]) !!}

                        {{-- Password validation --}}
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endif

                {{-- Alert --}}
                @if (session('error'))
                    <div class="alert alert-danger mt-4" role="alert">
                        <small>{{ $session('error') }}</small>
                    </div>
                @endif

                {{ Form::submit(__('Theme::users.social.profile.complete.button'), ['class' => 'btn cta']) }}
            </p>
            </form>


        </div>
    </div>
@endsection


