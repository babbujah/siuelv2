<?php
return [
    'general' =>  [
        'timezone' => 'America/Sao_Paulo',
        'language' => 'pt',
<<<<<<< HEAD
        'application' => 'siuel',
        'title' => 'Sistema Integrado de UEL',
=======
        'application' => 'template',
        'title' => 'SIUEL',
>>>>>>> 163f49b1be7bd4d2f8af61ef540171bf9e1f8062
        'theme' => 'adminbs5',
        'seed' => 'odfu6asnodf8as',
        'rest_key' => '',
        'multiunit' => '1',
        'public_view' => '0',
        'public_entry' => '',
        'debug' => '1',
        'strict_request' => '0',
        'multi_lang' => '1',
        'require_terms' => '0',
        'concurrent_sessions' => '1',
        'lang_options' => [
          'pt' => 'Português',
          'en' => 'English',
          'es' => 'Español',
        ],
        'multi_database' => '0',
        'validate_strong_pass' => '1',
        'notification_login' => '0',
        'welcome_message' => 'Deixe o mundo um pouco melhor do que encontrou. Lord Baden-Powell',
        'request_log_service' => 'SystemRequestLogService',
        'request_log' => '0',
        'request_log_types' => 'cli,web,rest',
        /*'password_renewal_interval' => '',*/
    ],
    'recaptcha' => [
        'enabled' => '0',
        'key' => '...',
        'secret' => '...'
    ],
    'permission' =>  [
        'public_classes' => [
          'SystemRequestPasswordResetForm',
          'SystemPasswordResetForm',
          'SystemRegistrationForm',
          'SystemPasswordRenewalForm',
          'SystemConcurrentAccessView'
        ],
        'user_register' => '1',
        'reset_password' => '1',
        'default_groups' => '2',
        'default_screen' => '30',
        'default_units' => '1',
    ],
    'highlight' => [
        'comment' => '#808080',
        'default' => '#FFFFFF',
        'html' => '#C0C0C0',
        'keyword' => '#62d3ea',
        'string' => '#FFC472',
    ],
    'login' => [
<<<<<<< HEAD
        'logo' => 'app/images/logo nova 7 gess.jpeg',
        'background' => ''
=======
        'logo' => '../images/brasão 7 gess.png',
        'background' => '../images/alcateia lobo guara feira de artesanato capa.jpg'
>>>>>>> 163f49b1be7bd4d2f8af61ef540171bf9e1f8062
    ],
    'template' => [
        'navbar' => [
            'has_program_search' => '1',
            'has_notifications' => '1',
            'has_messages' => '1',
            'has_docs' => '1',
            'has_contacts' => '1',
            'has_support_form' => '1',
            'has_wiki' => '1',
            'has_news' => '1',
            'has_menu_mode_switch' => '1',
            'has_main_mode_switch' => '1'
        ],
        'dialogs' => [
            'use_swal' => '1'
        ],
        'theme' => [
            /*'menu_dark_color' => 'rgb(29 45 83)',*/
            'menu_dark_color' => '#458712',
            'menu_mode'  => 'dark',
            'main_mode'  => 'light'
        ]
    ]
];
