<?php

    namespace App\Http\Utilities;

    use Illuminate\Support\Facades\Validator;
    use App\Http\Utilities\AuthResponse;

    use Hook;

    class TableData {
        static function modulesIndex() {
            $table['headers'] = ['Module name' => 'name', 'Description' => 'description'];
            $table['data_types'] = ['active' => 'boolean'];
            $table['actions'] = [
                'Control panel' => [
                    'url' => 'admin.modules.{module_slug}.index',
                    'class' => 'success',
                    'access' => 'MODULE_USE',
                ],
                'Settings' => [
                    'url' => 'admin.modules.{module_slug}.index',
                    'class' => 'primary',
                    'access' => 'MODULE_EDIT'
                ],
                'Disable' => [
                    'url' => 'admin.modules.{module_slug}.index',
                    'class' => 'warning',
                    'access' => 'MODULE_EDIT'
                ],
                'Delete' => [
                    'url' => 'admin.modules.{module_slug}.index',
                    'class' => 'danger',
                    'access' => 'MODULE_EDIT'
                ],
            ];
            
            return $table;
        }

        static function rolesIndex() {
            $table['headers'] = ['Role name' => 'name'];
            $table['actions'] = [
                'Edit' => [
                    'url' => 'admin.users.roles.edit',
                    'class' => 'success',
                    'access' => 'ROLE_EDIT'
                ],
                'Duplicate' => [
                    'url' => 'admin.users.roles.duplicate',
                    'class' => 'primary',
                    'access' => 'ROLE_CREATE'
                ],
                'Delete' => [
                    'url' => 'admin.users.roles.delete',
                    'class' => 'danger',
                    'disabled' => ['0', '1'],
                    'access' => 'ROLE_DELETE'
                ],
            ];
            $table['sort_by'] = [
                'name' => 'Name'
            ];

            return $table;
        }

        static function pageCategoriesIndex() {
            $table['headers'] = ['Category name' => 'name'];
            $table['actions'] = [
                'Edit' => [
                    'url' => 'admin.pages.categories.edit',
                    'class' => 'success',
                    'access' => 'CATEGORY_EDIT'
                ],
                'Delete' => [
                    'url' => 'admin.pages.categories.delete',
                    'class' => 'danger',
                    'access' => 'CATEGORY_DELETE'
                ]
            ];
            $table['mass_edit'] = [
                'delete' => 'Delete selected'
            ];
            $table['sort_by'] = [
                'name' => 'Name'
            ];

            return $table;
        }

        static function usersIndex() {
            $table['headers'] = [' ' => 'photo', 'Email' => 'email', 'Active' => 'is_active', 'Role' => 'role', 'Created' => 'created_at'];
            $table['data_types'] = ['photo' => 'image', 'is_active' => 'boolean', 'created_at' => 'date', 'role' => 'name'];
            $table['actions'] = [
                'Edit' => [
                    'url' => 'admin.users.edit',
                    'class' => 'success',
                    'access' => 'USER_EDIT'
                ],
                'Status' => [
                    'url' => 'admin.users.disable',
                    'class' => 'primary',
                    'access' => 'USER_EDIT'
                ],
                'Delete' => [
                    'url' => 'admin.users.delete',
                    'class' => 'danger',
                    'access' => 'USER_DELETE'
                ]
            ];
            $table['mass_edit'] = [
                "delete" => "Delete selected",
                "hide" => "Disable / Hide",
                "show" => "Enable / Show",
                "role" => "Set role",
            ];
            $table['mass_edit_extend'] = 'users';
            $table['sort_by'] = [
                'email' => 'Email',
                'name' => 'Username',
                'first_name' => 'First name',
                'last_name' => 'Last name',
            ];

            $table['headers'] = Hook::get('UsersIndexTableHeaders',[$table['headers']],function($table_headers){
                return $table['headers'];
            });

            return $table;
        }

        static function pagesIndex() {
            $table['headers'] = [' ' => 'thumbnail', 'Title' => 'name', 'Author' => 'author', 'Created at' => 'created_at'];
            $table['data_types'] = ['thumbnail' => 'image', 'author' => 'name'];
            $table['actions'] = [
                'Edit' => [
                    'url' => 'admin.pages.edit',
                    'class' => 'success',
                    'access' => 'PAGE_EDIT'
                ],
                'Delete' => [
                    'url' => 'admin.pages.delete',
                    'class' => 'danger',
                    'access' => 'PAGE_DELETE'
                ]
            ];
            $table['mass_edit'] = [
                "delete" => "Delete selected",
                "hide" => "Disable / Hide",
                "show" => "Enable / Show",
            ];
            $table['sort_by'] = [
                'name' => 'Title',
                'user_id' => 'Author',
                'created_at' => 'Creation date'
            ];

            return $table;
        }

        static function postsIndex() {
            $table['headers'] = [' ' => 'thumbnail', 'Title' => 'name', 'Visible' => 'is_active', 'Author' => 'author', 'Created at' => 'created_at'];
            $table['data_types'] = ['thumbnail' => 'image', 'author' => 'name', 'is_active' => 'boolean'];
            $table['actions'] = [
                'Edit' => [
                    'url' => 'admin.posts.edit',
                    'class' => 'success',
                    'access' => 'POST_EDIT'
                ],
                'Delete' => [
                    'url' => 'admin.posts.delete',
                    'class' => 'danger',
                    'access' => 'POST_DELETE'
                ]
            ];
            $table['mass_edit'] = [
                "delete" => "Delete selected",
                "hide" => "Disable / Hide",
                "show" => "Enable / Show",
            ];
            $table['sort_by'] = [
                'name' => 'Title',
                'user_id' => 'Author',
                'created_at' => 'Creation date'
            ];

            return $table;
        }

        static function postCategoriesIndex() {
            $table['headers'] = ['Category name' => 'name'];
            $table['actions'] = [
                'Edit' => [
                    'url' => 'admin.posts.categories.edit',
                    'class' => 'success',
                    'access' => 'CATEGORY_EDIT'
                ],
                'Delete' => [
                    'url' => 'admin.posts.categories.delete',
                    'class' => 'danger',
                    'access' => 'CATEGORY_DELETE'
                ]
            ];
            $table['mass_edit'] = [
                'delete' => 'Delete selected'
            ];
            $table['sort_by'] = [
                'name' => 'Name'
            ];

            return $table;
        }
    }