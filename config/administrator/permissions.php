<?php

use Spatie\Permission\Models\Permission;

return [
    'title' => 'permission',
    'single' => 'permission',
    'model' => Permission::class,

    'permission' => function() {
        return Auth::user()->can('manage_users');
    },

    'action_permissions' => [
        'create' => function ($model) {
            return true;
        },
        'update' => function($model) {
            return true;
        },
        'delete' => function ($model) {
            return false;
        },
        'view' => function ($model) {
            return true;
        },
    ],

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => 'identification',
        ],
        'operation' => [
            'title' => 'manage',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '(!!)identification',
            'hint' => 'important',
        ],
        'roles' => [
            'type' => 'relationship',
            'title' => 'role',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'name' => [
            'title' => 'identification',
        ],
    ],
];