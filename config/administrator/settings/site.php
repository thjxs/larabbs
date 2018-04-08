<?php

return [
    'title' => 'site setting',

    'permission' => function() {
        return Auth::user()->hasRole('Founder');
    },

    'edit_fields' => [
        'site_name' => [
            'title' => 'site name',
            'type' => 'text',
            'limit' => 50,
        ],
        'contact_email' => [
            'title' => 'contact email',
            'type' => 'text',
            'limit' => 50,
        ],
        'seo_description' => [
            'title' => 'SEO - Descritpion',
            'type' => 'textarea',
            'limit' => 250,
        ],
        'seo_keyword' => [
            'title' => 'SEO - Keywords',
            'type' => 'textarea',
            'limit' => 250,
        ],
    ],

    'rules' => [
        'site_name' => 'required|max:50',
        'contact_email' => 'email',
    ],
    // 'before_save' => function (&$data) {
    //     if (strpos($data['site_name'], 'Powered by LaraBBS') === false) {
    //         $data['site_name'] .= ' - Powered by LaraBBS';
    //     }
    // },

    'actions' => [
        'clear_cache' => [
            'title' => 'clear cache',
            'messages' => [
                'active' => 'clearing',
                'success' => 'cache clear',
                'error' => 'error',
            ],
            'action' => function (&$data) {
                \Artisan::call('cache:clear');
                return true;
            },
        ],
    ],
];