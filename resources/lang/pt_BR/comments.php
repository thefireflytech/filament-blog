<?php

return [
    'title' => 'Comentário',
    'plural_title' => 'Comentários',
    'forms' => [
        'fields' => [
            'user' => 'Usuário',
            'post' => 'Publicação',
            'comment' => 'Comentário',
            'approved' => 'Aprovado',
        ]
    ],
    'tables' => [
        'columns' => [
            'user' => 'Usuário',
            'post' => 'Publicação',
            'comment' => 'Comentário',
            'approved' => 'Aprovado',
            'approved_at' => [
                'label' => 'Aprovado Em',
                'placeholder' => 'Não aprovado ainda',
            ]
        ],
        'filters' => [
            'user' => 'Usuário',
        ]
    ]
];