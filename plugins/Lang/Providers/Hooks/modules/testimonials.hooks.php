<?php
    Hook::listen('template.modules_testimonials', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.modules.testimonials', compact('langs'));
    });