@extends('Theme::index', ['css' => 'users'])

@section('module')
    <div class="user user--login row">
        <div class="user__column user__column--login col col-md-6">

            {{-- Title --}}
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">

                {{-- CSRF token --}}
                @csrf

                {{-- Section 1 --}}
                <h2>{{ __('Theme::users.email.verify.title') }}</h2>
                <p class="user__login-intro">{{ __('Theme::users.email.verify.intro') }}</p>

                {{-- Section 2 --}}
                <h2>{{ __('Theme::users.email.verify.sub-title') }}</h2>
                <p>{{ __('Theme::users.email.verify.sub-intro') }}</p>

                {{-- Alert --}}
                @if (session('resent'))
                    <div class="alert alert-success mt-4" role="alert">
                        <small>{{ __('Theme::users.email.verify.message') }}</small>
                    </div>
                @endif

                {{-- Submit button --}}
                {{ Form::submit(__('Theme::users.email.verify.button'), ['class' => 'btn cta']) }}

            </form>

        </div>
    </div>
@endsection


