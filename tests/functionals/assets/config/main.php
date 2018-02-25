<?php

use bupy7\pages\tests\Env;
use yii\filters\AccessControl;

$env = Env::getInstance();

return [
    'id' => 'app-test',
    'basePath' => __DIR__ . '/..',
    'vendorPath' => __DIR__ . '/../../../../vendor',
    'aliases' => [
        '@bupy7/pages' => __DIR__ . '/../../../../src',
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'bootstrap' => ['pages'],
    'modules' => [
        'pages' => [
            'class' => 'bupy7\pages\Module',
        ],
    ],
    'components' => [
        'request' => [
            'enableCsrfValidation' => false,
            'cookieValidationKey' => 'wefJDF8sfdsfSDefwqdxj9oq',
            'scriptFile' => __DIR__ . '/index.php',
            'scriptUrl' => '/index.php',
            'url' => '/',
        ],
        'assetManager' => [
            'basePath' => '@app/assets',
            'baseUrl' => '/',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => sprintf('mysql:host=%s;dbname=%s', $env->getDbHost(), $env->getDbName()),
            'username' => $env->getDbUsername(),
            'password' => $env->getDbPassword(),
            'charset' => 'utf8',
        ],
        'user' => [
            'identityClass' => 'bupy7\pages\tests\functionals\assets\models\User',
        ],
    ],
];
