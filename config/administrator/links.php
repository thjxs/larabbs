<?php

use App\Models\Link;

return [
    'title'  => 'recommend',
    'single' => 'recommend',

    'model' => Link::class,

    'permission' => function () {
        return Auth::user()->hasRole('Founder');
    },

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'title' => [
            'title'    => 'name',
            'sortable' => false,
        ],
        'link' => [
            'title'    => 'link',
            'sortable' => false,
        ],
        'operation' => [
            'title'    => 'manage',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'title' => [
            'title' => 'name',
        ],
        'link' => [
            'title' => 'link',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => 'tag id',
        ],
        'title' => [
            'title' => 'name',
        ],
    ],
];
