<?php

    use Modules\UserCustomFields\Entities\UserCustomField;
    
    Hook::listen('ModulesList', function ($callback, $output, $modules) {
        $module = [
            'name' => 'User Custom Fields',
            'slug' => 'user-custom-fields',
            'description' => 'Add custom fields to Users views'
        ];
        $modules[] = $module;
        return $modules;
    });

    Hook::listen('UsersIndexTableHeaders', function ($callback, $output, $table_headers) {
        return array_merge($table_headers, ['First name' => 'first_name']);
    }, 10);
?>