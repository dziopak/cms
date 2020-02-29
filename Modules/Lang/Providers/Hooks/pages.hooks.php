<?php
    Hook::listen('template.page_left_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.pages.left', compact('langs'));
    });

    Hook::listen('template.page_right_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.pages.right', compact('langs'));
    });

    Hook::listen('template.page_bottom_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.pages.bottom', compact('langs'));
    });