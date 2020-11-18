<?php

return [
    'user' => 'Użytkownik',
    'registered' => 'Zarejestrowany',

    'login' => [
        'title' => 'Zaloguj się',
        'intro' => 'Zaloguj się przy pomocy adresu email i hasła, lub wybierz inną z dostępnych metod logowania.',
        'link' => 'Zaloguj się',
        'button' => 'Zaloguj się'
    ],
    'register' => [
        'title' => 'Rejestracja',
        'intro' => 'Nie posiadasz jeszcze konta? Zarejestruj się za darmo i sprawdź możliwości D-CMS!',
        'button' => 'Zarejestruj'
    ],
    'fields' => [
        'email' => 'Adres email',
        'password' => 'Hasło',
        'repeat_password' => 'Powtórz hasło',
        'username' => 'Login',
        'remember' => 'Zapamiętaj mnie'
    ],
    'profile' => [
        'edit' => [
            'title' => 'Edytuj profil'
        ]
    ],
    'password' => [
        'reset' => [
            'title' => 'Zresetuj hasło',
            'intro' => 'Aby odzyskać dostęp do swojego konta, podaj adres email na który jest zarejestrowane. Następnie sprawdź swoją skrzynkę pocztową - w otrzymanej wiadomości znajdziesz link, który przekieruje Cię bezpośrednio do formularza resetowania hasła.',
            'link' => 'Zapomniałem hasła',
            'button' => 'Wyślij link',
            'confirmed' => [
                'title' => 'Ustaw nowe hasło',
                'intro' => 'Podaj swój adres email, a następnie dwukrotnie wprowadź nowe hasło. Po przesłaniu poniższego formularza twoje hasło zostanie zmienione.',
                'notice' => '<small>- Hasło musi składać się z conajmniej 8 znaków</small><br/><small>- Bezpieczne hasło powinno zawierać zarówno liczby, jak i małe i duże litery</small>',
                'button' => 'Zresetuj hasło'
            ]
        ],
        'verify' => [
            'title' => 'Potwierdź hasło',
            'intro' => 'Do wykonania tej operacji wymagana jest ponowna autoryzacja. Wpisz swoje hasło i zatwierdź przyciskiem poniżej.'
        ]
    ],
    'email' => [
        'verify' => [
            'title' => 'Zweryfikuj swoje konto',
            'intro' => 'Zanim przejdziesz dalej twój adres email musi zostać zweryfikowany. Sprawdź swoją skrzynkę pocztową i dokonaj weryfikacji, klikając w przesłany przez nas link.',
            'sub-title' => 'Mail nie dotarł?',
            'sub-intro' => 'Odczekaj parę minut i upewnij się że mail nie trafił do folderu spam. Jeśli wiadomość z wymaganym do weryfikacji linkiem nie dotarła w przeciągu kilku-kilkunastu minut, spróbuj ponownie klikając w przycisk poniżej.',
            'message' => 'Ponownie wysłaliśmy email weryfikacyjny.',
            'button' => 'Wyślij ponownie'
        ]
    ],
    'social' => [
        'profile' => [
            'complete' => [
                'title' => 'Uzupełnij swoje dane',
                'intro' => 'Pomyślnie utworzono konto poprzez media społecznościowe. Uzupełnij brakujące dane konta aby przejść dalej.',
                'button' => 'Zapisz'
            ]
        ]
    ]
];
