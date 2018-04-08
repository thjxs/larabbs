<?php

use App\Models\User;

return [
    'title' => 'User',

    'single' => 'User',

    'model' => User::class,

    'permission' => function()
    {
        return Auth::user()->can('manage_users');
    },

    'columns' => [
        'id',

        'avatar' => [
            'title' => 'avatar',

            'output' => function ($avatar, $model) {
                return empty($model->getAvatar()) ? 'N/A' : '<img src="'.$model->getAvatar().'" width="40">';
            },

            'sortable' => false,
        ],

        'name' => [
            'title' => 'User name',
            'sortable' => false,
            'output' => function($name, $model) {
                return '<a href="/users/'.$model->id.'" target=_blank>'.$name.'</a>';
            },
        ],

        'email' => [
            'title' => 'email',
        ],

        'operation' => [
            'title' => 'manage',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => 'User Name',
        ],
        'email' => [
            'title' => 'email',
        ],
        'password' => [
            'title' => 'passowrd',
            'type' => 'password',
        ],
        'avatar' => [
            'title' => 'avatar',
            'type' => 'image',
            'location' => public_path() . '/uploads/images/avatars/',
        ],
        'roles' => [
            'title' => 'Role',
            'type' => 'relationship',
            'name_field' => 'name',
        ],

    ],

    'filters' => [
        'id' => [
            'title' => 'User ID',
        ],
        'name' => [
            'title' => 'User name',
        ],
        'email' => [
            'title' => 'email',
        ],
    ],
];