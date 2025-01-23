<?php

return [
    'title' => 'Setting',
    'plural_title' => 'Settings',
    'table' => [
        'columns' => [
            'title' => 'Title',
            'description' => 'Description',
            'logo' => 'Logo',
            'organization_name' => 'Organization Name'
        ]
    ],
    'form' => [
        'sections' => [
            'general_information' => [
                'title' => 'General Information',
            ],
            'seo' => [
                'title' => 'SEO',
                'subtitle' => 'Place your google analytic and adsense code here. This will be added to the head tag of your blog post only.',
            ],
            'quick_links' => [
                'title' => 'Quick Links',
                'subtitle' => 'Add your quick links here. This will be displayed in the footer of your blog.',
            ],
        ],
        'fields' => [
            'general_information' => [
                'title' => 'Title',
                'description' => 'Description',
                'logo' => 'Logo',
                'favicon' => 'Favicon',
                'organization_name' => 'Organization Name',
            ],
            'seo' => [
                'google_console_code' => 'Google Console Code',
                'google_analytic_code' => 'Google Analytic Code',
                'google_adsense_code' => 'Google Adsense Code',
            ],
            'quick_links' => [
                'repeater_quick_links' => [
                    'title' => 'Links',
                    'label' => 'Label',
                    'url' => 'URL',
                    'add_to_links' => 'Add to Links',
                    'helper_text' => 'URL should start with http:// or https://'
                ]
            ]
        ]
    ]
];