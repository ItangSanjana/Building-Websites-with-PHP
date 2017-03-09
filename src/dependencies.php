<?php
// DIC configuration

$container = $app->getContainer();

// View renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Messager
$container['messager'] = function ($c) {
    $settings = $c->get('settings')['messager'];
    return Swift_Message::newInstance($settings['subject']);
};

// Mailer
$container['mailer'] = function ($c) {
    $settings = $c->get('settings')['mailer'];
    return Swift_Mailer::newInstance($settings['transport']);
};
