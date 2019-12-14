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
                'rules' => 'required|min:2|max:45',
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
                'type' => 'textarea',
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
                'label' => 'Facebook',
                'rules' => 'nullable|string|url|max:255'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Twitter',
                'label' => 'twitter',
                'rules' => 'nullable|string|url|max:255'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Pinterest',
                'label' => 'pinterest',
                'rules' => 'nullable|string|url|max:255'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Youtube',
                'label' => 'youtube',
                'rules' => 'nullable|string|url|max:255'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Instagram',
                'label' => 'instagram',
                'rules' => 'nullable|string|url|max:255'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Twitch',
                'label' => 'twitch',
                'rules' => 'nullable|string|url|max:255'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'Discord',
                'label' => 'discord',
                'rules' => 'nullable|string|url|max:255'
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
                'value' => '200',
                'rules' => 'required|min:1|max:250',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Convite',
                'label' => 'points_invite',
                'value' => '100',
                'rules' => 'required|min:1|max:250',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Download',
                'label' => 'points_download',
                'value' => '20',
                'rules' => 'required|min:1|max:250',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Comentar',
                'label' => 'points_comment',
                'value' => '4',
                'rules' => 'required|min:1|max:250',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Upload',
                'label' => 'points_upload',
                'value' => '30',
                'rules' => 'required|min:1|max:250',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Classificação',
                'label' => 'points_rating',
                'value' => '5',
                'rules' => 'required|min:1|max:250',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Tópico',
                'label' => 'points_topic',
                'value' => '8',
                'rules' => 'required|min:1|max:250',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Postagem',
                'label' => 'points_post',
                'value' => '5',
                'rules' => 'required|min:1|max:250',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Deletar',
                'label' => 'points_delete',
                'value' => '15',
                'rules' => 'required|min:1|max:250',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Agradecer',
                'label' => 'points_thanks',
                'value' => '5',
                'rules' => 'required|min:1|max:250',
            ],
            [
                'type' => 'number',
                'data' => 'int',
                'name' => 'Pontos Reportar',
                'label' => 'points_report',
                'value' => '5',
                'rules' => 'required|min:1|max:250',
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
                'label' => 'Privacidade',
                'rules' => 'nullable|string|max:65530'
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'disclaimer',
                'label' => 'Aviso Legal',
                'rules' => 'nullable|string|max:65530'
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'terms',
                'label' => 'Termos e Condições',
                'rules' => 'nullable|string|max:65530'
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
                'rules' => 'required|email'
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
                'rules' => 'required|boolean', // validation rule of laravel
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
                'rules' => 'required|boolean', // validation rule of laravel
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
                'rules' => 'required|boolean', // validation rule of laravel
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
                'rules' => 'required|boolean', // validation rule of laravel
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
                'value' => '7',
                'rules' => 'required|integer|min:1|max:150'
            ],
        ]
    ],

];
