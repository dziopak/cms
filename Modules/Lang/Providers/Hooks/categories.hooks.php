<?php
    Hook::listen('template.category_left_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.categories.left', compact('langs'));
    });