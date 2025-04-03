<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'ru-RU',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'asdadgvcxvxcgdfg',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ''=>'site/index',
                'register'=>'site/register',
                'login'=>'site/login',
                'logout'=>'site/logout',

                'profile'=>'site/profile',

                'notifications'=> 'notifications/index',
                'notifications/mark-as-read/<id:\d+>'=> 'notifications/mark-as-read',
                'notifications/read/<id:\d+>'=> 'notifications/read',

                'admin'=>'admin/type',

                'type'=>'type/index',

                'device/<type_id:\d+>'=>'device/index',
                'device/view/<id:\d+>'=>'device/view',
                'device/create/<type_id:\d+>'=>'device/create',

                'device/detail/<id:\d+>'=>'site/device',

                'scenario-user/create/<scenarioId:\d+>'=>'scenario-user/create',
                'scenario-user/update/<id:\d+>'=>'scenario-user/update',
                'scenario-user/delete/<userId:\d+>'=>'scenario-user/delete',

                'group/<id:\d+>'=>'group/index',
                'group/enable-click/<id:\d+>'=>'group/enable-click',
                'group/disable-click/<id:\d+>'=>'group/disable-click',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
