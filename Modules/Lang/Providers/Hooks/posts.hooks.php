<?php
    Hook::listen('template.post_left_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.posts.left', compact('langs'));
    });

    Hook::listen('template.post_right_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.posts.right', compact('langs'));
    });

    Hook::listen('template.post_bottom_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.posts.bottom', compact('langs'));
    });