<?php

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

class CustomAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    //Move to BackendController
    //load yii ActiveForm, GridView or other widgets will load bootstrap again
    /*public function init()
    {
        if(isset(Yii::$app->view->theme)) {
            Yii::$app->assetManager->bundles['yii\\bootstrap\\BootstrapAsset'] = [
                'css' => []
            ];
        }
        parent::init(); // TODO: Change the autogenerated stub
    }*/
}