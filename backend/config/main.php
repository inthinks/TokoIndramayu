<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'defaultRoute'=>'site/me',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'dynagrid' => [
            'class' => '\kartik\dynagrid\Module',
            'defaultPageSize'=>50,

// other module settings
        ],
    ],
    //'homeUrl'=>'admin.tokoindramayu.co.id',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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

        'util' => [
            'class' => 'common\models\Util',
            ],

        'authManager'=> [
            'class'=> 'yii\rbac\DbManager',
            //'defaultRoles'=>'guest'
            ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*'request' => [
            'baseUrl' => 'admin.tokoindramayu.co.id'],*/





        'gridview' => [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source,
            'downloadAction' => 'gridview/export/download',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvdynagrid/messages',
                'forceTranslation' => true
            ]
        ],
    ],
    'params' => $params,
];
