@extends('Theme::index', ['css' => 'users'])

@section('module')
    <div class="user user--login">
        <div class="user user--login row">
            <div class="user__column user__column--login col col-md-6">

                {{-- Title --}}
                <h2>{{ __('Theme::users.password.verify.title') }}</h2>
                <p class="user__login-intro">{!! __('Theme::users.password.verify.intro') !!}</p>

                {{ Form::open(['method' => 'POST', "route" => 'password.confirm', 'class' => 'w-100']) }}

                    @csrf

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

                    {{-- Submit button --}}
                    {{ Form::submit(__('Theme::general.confirm'), ['class' => 'btn cta']) }}

                    {{-- Go back --}}
                    <a href="{{ URL::previous() }}" class="login-block__link">{{ __('Theme::general.go_back') }}</a>

                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection


