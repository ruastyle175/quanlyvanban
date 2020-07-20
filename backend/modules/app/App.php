<?php

namespace backend\modules\app;

use common\components\FHtml;
use Yii;

/**
 * app module definition class
 */
class App extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\app\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }

    public static function createModuleMenu($module, $controller, $action)
    {
        return array(
            array(
                'active' => $module == 'app',
                'name' => Yii::t('common', 'App'),
                'icon' => 'icon-docs',
                'children' => array(
                    array(
                        'name' => Yii::t('common', 'User'),
                        'url' => Yii::$app->urlManager->createUrl(['app/user/index']),
                        'active' => $module == 'app' && $controller == 'user',
                        'icon' => 'glyphicon glyphicon-user',
                    ),
                    array(
                        'name' => Yii::t('common', 'Transaction'),
                        'url' => Yii::$app->urlManager->createUrl(['app/transaction/index']),
                        'active' => $module == 'app' && $controller == 'transaction',
                        'icon' => 'fa fa-money',
                    ),
                    array(
                        'name' => Yii::t('common', 'Notification'),
                        'url' => Yii::$app->urlManager->createUrl(['app/default/notification']),
                        'active' => $module == 'app' && $controller == 'default' && $action == 'notification',
                        'icon' => 'glyphicon glyphicon-cloud-upload',
                    ),
                ),
            ),
        );
    }
}
