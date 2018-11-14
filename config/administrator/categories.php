<?php

use App\Models\Category;

return [
    'title'  => 'category',
    'single' => 'category',
    'model'  => Category::class,

    'action_permission' => [
        'delete' => function () {
            return Auth::user()->hasRole('Founder');
        },
    ],

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => 'title',
            'sortable' => false,
        ],
        'description' => [
            'title'    => 'description',
            'sortable' => false,
        ],
        'operation' => [
            'title'    => 'manage',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'name' => [
            'title' => 'name',
        ],
        'description' => [
            'title' => 'description',
            'type'  => 'textarea',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => 'category id',
        ],
        'name' => [
            'title' => 'name',
        ],
        'description' => [
            'title' => 'description',
        ],
    ],
    'rules' => [
        'name' => 'required|min:1|unique:categories',
    ],
];
