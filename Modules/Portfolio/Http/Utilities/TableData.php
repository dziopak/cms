<?php
    namespace Modules\Portfolio\Http\Utilities;

    class TableData {
        static function portfolioIndex() {
            $table['headers'] = ['' => 'thumbnail', 'Name' => 'name', 'slug' => 'slug', 'Created' => 'created_at'];
            $table['data_types'] = ['thumbnail' => 'image', 'created_at' => 'date'];
            $table['actions'] = [
                'Edit' => [
                    'url' => 'admin.modules.portfolio.edit',
                    'class' => 'success',
                    'access' => 'MODULE_USE'
                ],
                'Delete' => [
                    'url' => 'admin.modules.portfolio.delete',
                    'class' => 'danger',
                    'access' => 'MODULE_USE'
                ]
            ];
            $table['mass_edit'] = [
                'delete' => 'Delete selected'
            ];
            $table['sort_by'] = [
                'name' => 'Name',
                'slug' => 'Slug',
                'created_at' => 'Creation date',
            ];

            return $table;
        }
    }