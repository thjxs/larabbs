<?php

use App\Models\Reply;

return [
    'title' => 'Reply',
    'single' => 'Reply',
    'model' => Reply::class,

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'content' => [
            'title' => 'content',
            'sortable' => false,
            'output' => function ($value, $model) {
                return '<div style="max-width: 220px">' . $value . '</div>';
            },
        ],
        'user' => [
            'title' => 'author',
            'sortable' => false,
            'output' => function ($value, $model) {
                $avatar = $model->user->getAvatar();
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height: 22px; width: 22px;">' . $model->user->name;
                return model_link($value, $model);
            },
        ],
        'topic' => [
            'title' => 'topic',
            'sortable' => false,
            'output' => function ($value, $model) {
                return '<div style="max-width: 260px;">' . model_admin_link($model->topic->title, $model->topic) . '</div>';
            },
        ],
        'operation' => [
            'title' => 'manage',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'user' => [
            'title' => 'user',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'search_fields' => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'topic' => [
            'title' => 'topic',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'search_fields' => array("CONCAT(id, ' ', title)"),
        ],
        'content' => [
            'title' => 'reply content',
            'type' => 'textarea',
        ],
    ],
    'filters' => [
        'user' => [
            'title' => 'user',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'search_fields' => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'topic' => [
            'title' => 'title',
            'type' => 'relationship',
            'name_field' => 'title',
            'autocomplete' => true,
            'search_fields' => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'content' => [
            'title' => 'reply content',
        ],
    ],
    'rules' => [
        'content' => 'required',
    ],
];