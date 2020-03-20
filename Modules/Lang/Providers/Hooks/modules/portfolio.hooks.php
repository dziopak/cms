<?php
    Hook::listen('template.module_portfolio_left_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.modules.portfolio.left', compact('langs'));
    });

    Hook::listen('template.module_portfolio_right_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.modules.portfolio.right', compact('langs'));
    });

    Hook::listen('template.module_portfolio_bottom_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.modules.portfolio.bottom', compact('langs'));
    });