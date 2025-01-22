<?php

return [
    'table' => [
        'columns' => [
            'title' => 'Título',
            'description' => 'Descrição',
            'logo' => 'Logo',
            'organization_name' => 'Nome da Organização'
        ]
    ],
    'form' => [
        'sections' => [
            'general_information' => [
                'title' => 'Informações Gerais',
            ],
            'seo' => [
                'title' => 'SEO',
                'subtitle' => 'Coloque aqui o código do Google Analytics e do Adsense. Isso será adicionado à tag head apenas da sua postagem no blog.',
            ],
            'quick_links' => [
                'title' => 'Links Rápidos',
                'subtitle' => 'Adicione seus links rápidos aqui. Eles serão exibidos no rodapé do seu blog.',
            ],
        ],
        'fields' => [
            'general_information' => [
                'title' => 'Título',
                'description' => 'Descrição',
                'logo' => 'Logo',
                'favicon' => 'Favicon',
                'organization_name' => 'Nome da Organização',
            ],
            'seo' => [
                'google_console_code' => 'Código do Google Console',
                'google_analytic_code' => 'Código do Google Analytics',
                'google_adsense_code' => 'Código do Google Adsense',
            ],
            'quick_links' => [
                'repeater_quick_links' => [
                    'title' => 'Links',
                    'label' => 'Etiqueta',
                    'url' => 'URL',
                    'add_to_links' => 'Adicionar aos Links',
                    'helper_text' => 'A URL deve começar com http:// ou https://'
                ]
            ]
        ]
    ]
];
