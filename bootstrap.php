<?php

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    error_log('You must run composer install to run this project');
    exit;
}

require_once realpath(__DIR__.'/vendor/autoload.php');

$settings = require_once realpath(__DIR__.'/config/settings.php');

foreach ($settings['php'] as $key => $value) {
    ini_set($key, $value);
}

$settings['debug'] = (bool) $settings['debug'];