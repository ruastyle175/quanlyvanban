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
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'app' => [
            'class' => 'backend\modules\app\App',
        ],
//        'cms' => [
//            'class' => 'backend\modules\cms\Cms',
//        ],
//        'blog' => [
//            'class' => 'backend\modules\blog\Blog',
//        ],
//        'content' => [
//            'class' => 'backend\modules\content\Content',
//        ],
//        'ecommerce' => [
//            'class' => 'backend\modules\ecommerce\Ecommerce',
//        ],
        'system' => [
            'class' => 'backend\modules\system\System',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-backend',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache', //if apcu not loaded => ApcCache
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        //Config for layout and theme
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@backend/views' => '@backend/web/themes/' . DEFAULT_BACKEND_THEME
                ],
                'baseUrl' => '@backend/web/themes/' . DEFAULT_BACKEND_THEME,
            ],
        ],
        //Config I18N for label  can be moved to common/config/main.php to use for both backend and frontend
        'i18n' => [
            'translations' => [
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'common' => 'common.php',
                    ],
                ],
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
                'test*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'test' => 'test.php',
                    ],
                ],
                'VbDen*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'VbDen' => 'VbDen.php',
                    ],
                ],
                'system*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'system' => 'system.php',
                    ],
                ],
                'content*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'content' => 'content.php',
                    ],
                ],
                'ecommerce*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'ecommerce' => 'ecommerce.php',
                    ],
                ],
            ],
        ],
        /* turn off Yii boostrap / jquery
        https://stackoverflow.com/questions/26734385/yii2-disable-bootstrap-js-jquery-and-css
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],

            ],
        ], */
        'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/' . ROOT_FOLDER_NAME . '/' . FRONTEND . '/' . WEB_DIR,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            //'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
        ],
    ],
    'params' => $params,
    'language' => 'vi',
];
