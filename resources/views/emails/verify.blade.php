@component('mail::message')
# Dziękujemy za rejestrację w serwisie Dziopak.pl

Twoje konto zostało założone. Aby jednak uzyskać dostęp do wszystkich treści zawartch na stronie, musisz zweryfikować swój adres email. Wystarczy że klikniesz w przycisk poniżej, poczym zostaniesz przekierowany bezpośrednio do strony edycji profilu.

@component('mail::button', ['url' => $url])
Zweryfikuj swoje konto
@endcomponent

Dziękujemy za korzystanie z serwisu.<br>
Pozdrawiamy, zespół <a href="{{ url('/') }}" title="{{ config('app.name') }}">{{ config('app.name') }}</a>
@endcomponent
