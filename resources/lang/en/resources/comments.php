<?php

return [
    'title' => 'Comment',
    'plural_title' => 'Comments',
    'forms' => [
        'fields' => [
            'user' => 'User',
            'post' => 'Post',
            'comment' => 'Comment',
            'approved' => 'Approved',
        ]
    ],
    'tables' => [
        'columns' => [
            'user' => 'User',
            'post' => 'Post',
            'comment' => 'Comment',
            'approved' => 'Approved',
            'approved_at' => [
                'label' => 'Approved At',
                'placeholder' => 'Not approved yet',
            ]

        ],
        'filters' => [
            'users' => 'Users',
        ]
    ]
];