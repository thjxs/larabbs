<?php

use Spatie\Permission\Models\Role;

return [
    'title' => 'role',
    'single' => 'role',
    'model' => Role::class,

    'permission' => function()
    {
        return Auth::user()->can('manage_users');
    },

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => 'identification',
        ],
        'permissions' => [
            'title' => 'permission',
            'output' => function ($value, $model) {
                $model->load('permissions');
                $result = [];
                foreach ($model->permissions as $permission) {
                    $result[] = $permission->name;
                }
                return empty($result) ? 'N/A' : implode($result, ' | ');
            },
            'sortable' => false,
        ],

        'operation' => [
            'title' => 'manage',
            'output' => function ($value, $model) {
                return $value;
            },
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => 'identification',
        ],
        'permissions' => [
            'type' => 'relationship',
            'title' => 'permission',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => 'identification',
        ],
    ],

    'rules' => [
        'name' => 'required|max:15|unique:roles,name',
    ],
];