<?php
return [
    'name' => 'Application',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //'i18n message database
//        'i18n' => [
//            'translations' => [
//                '*' => [
//                    'class' => 'yii\i18n\DbMessageSource',
//                    'db' => 'db',
//                    'sourceLanguage' => 'xx-XX', // Developer language
//                    'sourceMessageTable' => '{{%language_source}}',
//                    'messageTable' => '{{%language_translate}}',
//                    'cachingDuration' => 86400,
//                    'enableCaching' => true,
//                ],
//            ],
//        ],
    ],
//    'language' => 'en',
];
