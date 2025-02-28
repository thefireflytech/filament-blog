<?php

return [
    'title' => 'Publicação',
    'plural_title' => 'Publicações',
    'forms' => [
        'fields' => [
            'category' => 'Categoria',
            'title' => 'Título',
            'slug' => 'Slug',
            'sub_title' => 'Subtítulo',
            'tags' => 'Tags',
            'body' => 'Conteúdo',
            'cover_photo' => 'Foto de Capa',
            'photo_alt_text' => 'Texto Alternativo da Foto',
            'status' => [
                'label' => 'Status',
                'options' => [
                    'pending' => 'Pendente',
                    'scheduled' => 'Agendado',
                    'published' => 'Publicado',
                ],
            ],
            'published_at' => 'Publicado em',
            'scheduled_for' => 'Agendado para',
            'user' => 'Usuário',
            'keywords' => 'Palavras-chave',
            'description' => 'Descrição',
        ],
        'sections' => [
            'general' => 'Geral',
            'publish_information' => 'Informações de Publicação',
            'description' => 'Descrição',
            'header_title' => 'Detalhes da Postagem',
            'titles' => 'Títulos',
            'feature_image' => 'Imagem em Destaque',
            'status' => 'Status',
            'comment' => 'Comentário',
        ],
        'tabs' => [
            'edit_page' => [
                'add_seo_detail' => 'Adicionar Detalhe de SEO',
                'view_post' => 'Visualizar Publicação',
                'manage_seo_details' => 'Gerenciar Detalhes de SEO',
                'manage_comments' => 'Gerenciar Comentários',
                'edit_post' => 'Editar Publicação',
            ],
            'list_page' => [
                'all' => 'Todas',
                'published' => 'Publicadas',
                'scheduled' => 'Agendadas',
                'pending' => 'Pendentes',
            ]
        ],
        'widget' => [
            'cards' => [
                'published_post' => 'Publicação Publicada',
                'scheduled_post' => 'Publicação Agendada',
                'pending_post' => 'Publicação Pendente',
            ]
        ],
        'actions' => [
            'preview' => 'Pré-Visualizar',
            'send_notification' => 'Notificar Nova Publicação',
        ]
    ],
    'tables' => [
        'columns' => [
            'title' => 'Título',
            'status' => 'Status',
            'cover_photo' => 'Foto de Capa',
            'author' => 'Autor',
            'description' => 'Descrição',
            'keywords' => 'Palavras-chave',
            'commented_by' => 'Comentado Por',
            'comment' => 'Comentário',
            'approved_at' => [
                'label' => 'Aprovado Em',
                'placeholder' => 'Não aprovado ainda',
            ],
        ],
        'filters' => [
            'user' => 'Usuário',
        ]
    ]
];