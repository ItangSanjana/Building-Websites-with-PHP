<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Messager settings
        'messager' => [
            'subject' => 'Email From Our Website',
        ],

        // Mailer settings
        'mailer' => [
            'transport' => Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs'),
        ],
    ],
];
