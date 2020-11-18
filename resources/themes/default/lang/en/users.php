<?php

return [
    'user' => 'Użytkownik',
    'registered' => 'Zarejestrowany',

    'login' => [
        'title' => 'Sign in',
        'intro' => 'Log in using your account\'s credentials, or choose other verification method.',
        'link' => 'Sign in',
        'button' => 'Log in'
    ],
    'register' => [
        'title' => 'Sign up',
        'intro' => 'No account yet? Sign up for free and check new possibilities with D-CMS!',
        'button' => 'Register'
    ],
    'fields' => [
        'email' => 'Email address',
        'password' => 'Password',
        'repeat_password' => 'Repeat password',
        'username' => 'Username',
        'remember' => 'Remember me'
    ],
    'profile' => [
        'edit' => [
            'title' => 'Edit profile'
        ]
    ],
    'password' => [
        'reset' => [
            'title' => 'Password reset',
            'intro' => 'To get back access to your account, fill the form with email address you used to register your account and check your inbox. You will receive a message with link, which will redirect you straight to password reset form.',
            'link' => 'I forgot my password',
            'button' => 'Send link',
            'confirmed' => [
                'title' => 'Set new password',
                'intro' => 'Fill in your email addres and your new password - twice. After submiting this form your password will be changed.',
                'notice' => '<small>- Password must have at least 8 characters</small><br/><small>- Secure password should contain numbers, as well as capital and lowercase letters.</small>',
                'button' => 'Reset password'
            ]
        ],
        'verify' => [
            'title' => 'Confirm your password',
            'intro' => 'You need to re-authorize to finish this task. Fill in your password and confirm by pressing the button below.'
        ]
    ],
    'email' => [
        'verify' => [
            'title' => 'Verify your account',
            'intro' => 'Before you\'ll go further you have to verify your email. Check your mailbox and proceed by clicking received link.',
            'sub-title' => 'Didn\'t get a message?',
            'sub-intro' => 'Please, wait for few minutes and make sure it didn\'t land in SPAM folder. If verification message didn\'t show up within few minutes, try to resend it using link below.',
            'message' => 'New verification link has been sent.',
            'button' => 'Resend'
        ]
    ],
    'social' => [
        'profile' => [
            'complete' => [
                'title' => 'Fill missing data',
                'intro' => 'Successfully created new account using social media profile. Fill missing data in the form to finish your registration proccess.',
                'button' => 'Save'
            ]
        ]
    ]
];
