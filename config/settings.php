<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Settings
    |--------------------------------------------------------------------------
    |
    | In here you can define all the settings used in your app, it will be
    | available as a settings page where user can update it if needed
    | create sections of settings with a type of input.
    */
    'seo' => [
        'title' => 'SEO',
        'elements' => [
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'site_title',
                'label' => 'Site Título',
                'value' => 'Forumm'
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'meta_labelwords',
                'label' => 'Meta labelwords'
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'meta_description',
                'label' => 'Meta Descrição'
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'meta_description',
                'label' => 'Meta Descrição'
            ]
        ]
    ],
    'analytics' => [
        'title' => 'Analytics',
        'elements' => [
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'analytics',
                'label' => 'Analytics'
            ]
        ]
    ],
    'social' => [
        'title' => 'Social',
        'elements' => [
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'facebook',
                'label' => 'Facebook'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Twitter',
                'label' => 'twitter'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Pinterest',
                'label' => 'pinterest'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Youtube',
                'label' => 'youtube'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Instagram',
                'label' => 'instagram'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Twitch',
                'label' => 'twitch'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Discord',
                'label' => 'discord'
            ],
        ]
    ],
    'points' => [
        'title' => 'Pontos',
        'elements' => [
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Signup',
                'label' => 'points_signup',
                'value' => '200'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Convite',
                'label' => 'points_invite',
                'value' => '100'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Download',
                'label' => 'points_download',
                'value' => '20'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Comentar',
                'label' => 'points_comment',
                'value' => '4'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Upload',
                'label' => 'points_upload',
                'value' => '30'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Classificação',
                'label' => 'points_rating',
                'value' => '5'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Tópico',
                'label' => 'points_topic',
                'value' => '8'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Postagem',
                'label' => 'points_post',
                'value' => '5'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Deletar',
                'label' => 'points_delete',
                'value' => '15'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Agradecer',
                'label' => 'points_thanks',
                'value' => '5'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Reportar',
                'label' => 'points_report',
                'value' => '5'
            ],
        ]
    ],
    'policy' => [
        'title' => 'Política',
        'elements' => [
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'privacy',
                'label' => 'Privacidade'
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'disclaimer',
                'label' => 'Aviso Legal'
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'terms',
                'label' => 'Termos e Condições'
            ]
        ]
    ],
    'mail' => [
        'title' => 'Mail',
        'elements' => [
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Mail driver',
                'label' => 'mail_driver',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Mail host',
                'label' => 'mail_host',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Mail porta',
                'label' => 'mail_port',
            ],
            [
                'type' => 'email',
                'data' => 'string',
                'name' => 'Mail usuario',
                'label' => 'mail_username',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Mail senha',
                'label' => 'mail_password',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Mail tls',
                'label' => 'mail_encryption',
            ],
        ]
    ],
    'others' => [
        'title' => 'Outros',
        'elements' => [
            [
                'type' => 'select', // input fields type
                'data' => 'boolean', // data type, string, int, boolean
                'name' => 'Signup On',
                'label' => 'signup_on',
                'value' => '1',
                'options' => [
                    '1' => 'Sim',
                    '0' => 'Nao'
                ]
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'boolean', // data type, string, int, boolean
                'name' => 'Convite On',
                'label' => 'invite_on',
                'value' => '1',
                'options' => [
                    '1' => 'Sim',
                    '0' => 'Nao'
                ]
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'boolean', // data type, string, int, boolean
                'name' => 'forum On',
                'label' => 'forum_on',
                'value' => '1',
                'options' => [
                    '1' => 'Sim',
                    '0' => 'Nao'
                ]
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'boolean', // data type, string, int, boolean
                'name' => 'RNH On',
                'label' => 'rnh_on',
                'value' => '1',
                'options' => [
                    '1' => 'Sim',
                    '0' => 'Nao'
                ]
            ],
            [
                'type' => 'number',
                'data' => 'numeric',
                'name' => 'Ratio Máximo',
                'label' => 'max_ratio',
                'value' => '2.000'
            ],
            [
                'type' => 'number',
                'data' => 'numeric',
                'name' => 'Ratio Mínimo',
                'label' => 'min_ratio',
                'value' => '1.200'
            ],
            [
                'type' => 'number',
                'data' => 'numeric',
                'name' => 'Ratio Baixo',
                'label' => 'low_ratio',
                'value' => '0.550'
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Convite expira em',
                'label' => 'invitedays',
                'value' => '7'
            ],
        ]
    ],

];
