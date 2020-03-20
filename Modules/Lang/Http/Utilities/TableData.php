<?php
    namespace Modules\Lang\Http\Utilities;

    class TableData {
        static function langsIndex() {
            $table['headers'] = ['Language name' => 'name', 'Origin name' => 'origin_name', 'Lang tag' => 'lang_tag'];
            $table['actions'] = [
                'Edit' => [
                    'url' => 'admin.modules.lang.edit',
                    'class' => 'success',
                    'access' => 'MODULE_USE'
                ],
                'Delete' => [
                    'url' => 'admin.modules.lang.delete',
                    'class' => 'danger',
                    'access' => 'MODULE_USE'
                ]
            ];
            // $table['mass_edit'] = [
            //     'delete' => 'Delete selected'
            // ];
            // $table['sort_by'] = [
            //     'name' => 'Name',
            //     'origin_name' => 'Original name',
            //     'lang_tag' => 'Language tag',
            // ];

            return $table;
        }
    }