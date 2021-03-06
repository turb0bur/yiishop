<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id'            => 'yiishop',
    'basePath'      => dirname(__DIR__),
    'bootstrap'     => ['log'],
    'language'      => 'en-US',
    'defaultRoute'  => 'category/index',
    'components'    => [
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'BnGrlGSihAqaJ2KDn_KxEpyS0aqf3l98',
            'baseUrl'             => ''
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
//            'loginUrl'        => 'cart/view'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'localhost',
//                'username' => 'username',
//                'password' => 'password',
//                'port' => '587',
//                'encryption' => 'tls',
//            ],
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'           => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
//                TODO Add rules for admin orders
                'category/<id:\d+>/page/<page:\d+>' => 'category/view',
                'category/<id:\d+>'                 => 'category/view',
                'product/<id:\d+>'                  => 'product/view',
                'search'                            => 'category/search',
            ],
        ],

    ],
    'modules'       => [
        'admin' => [
            'class'        => 'app\modules\admin\Module',
            'layout'       => 'admin',
            'defaultRoute' => 'order/index',
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class'  => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root'   => [
                'baseUrl'  => '/web',
                'path'     => 'uploads',
                'name'     => 'Uploads'
            ],
//            'watermark' => [
//                'source'         => __DIR__ . '/logo.png',
//                'marginRight'    => 5,
//                'marginBottom'   => 5,
//                'quality'        => 95,
//                'transparency'   => 70,
//                'targetType'     => IMG_GIF | IMG_JPG | IMG_PNG | IMG_WBMP,
//                'targetMinPixel' => 200
//            ]
        ]
    ],
    'params'        => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
