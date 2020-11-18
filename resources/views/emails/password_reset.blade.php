@component('mail::message')
# Resetowanie hasła

Kliknij w link poniżej aby zresetować hasło dla konta {{ $user->name }}. Jeżeli to nie Ty wnosiłeś/aś o zresetowanie hasła, prosimy o zignorowanie tej wiadomości.

@component('mail::button', ['url' => $url])
Zresetuj swoje hasło
@endcomponent

Dziękujemy za korzystanie z serwisu.<br>
Pozdrawiamy, zespół <a href="{{ url('/') }}" title="{{ config('app.name') }}">{{ config('app.name') }}</a>
@endcomponent
