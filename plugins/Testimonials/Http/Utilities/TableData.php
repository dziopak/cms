<?php

namespace plugins\Testimonials\Http\Utilities;

class TableData
{
    static function testimonialsIndex()
    {
        $table['headers'] = ['' => 'thumbnail', 'Author' => 'author', 'Creation date' => 'created_at'];
        $table['data_types'] = ['created_at' => 'date', 'thumbnail' => 'image'];
        $table['actions'] = [
            'Edit' => [
                'url' => 'admin.plugins.testimonials.edit',
                'class' => 'success',
                // 'access' => 'CATEGORY_EDIT'
            ],
            'Delete' => [
                'url' => 'admin.plugins.testimonials.delete',
                'class' => 'danger',
                // 'access' => 'CATEGORY_DELETE'
            ]
        ];
        $table['mass_edit'] = [
            'delete' => 'Delete selected'
        ];
        $table['sort_by'] = [
            'author' => 'Author',
            'created_at' => 'Creation date'
        ];

        return $table;
    }
}
