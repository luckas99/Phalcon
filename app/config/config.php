<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'database' => [
        'adapter' => getenv('DB_ADAPTER'),
        'host' => getenv('DB_HOST'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'dbname' => getenv('DB_NAME')
    ],
    'application' => [
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir' => APP_PATH . '/models/',
        'formsDir' => APP_PATH . '/forms/',
        'viewsDir' => APP_PATH . '/views/',
        'libraryDir' => APP_PATH . '/library/',
        'pluginsDir' => APP_PATH . '/plugins/',
        'cacheDir' => BASE_PATH . '/cache/',
        'helpersDir' => BASE_PATH . '/common/helpers',
        'baseUri' => '/',
        'publicUrl' => '/',
        'cryptSalt' => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D'
    ],
    'logger' => [
        'path' => BASE_PATH . '/logs/',
        'format' => '%date% [%type%] %message%',
        'date' => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'application.log',
    ]
]);


