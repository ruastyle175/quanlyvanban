<?php

namespace backend\modules\system;

use common\models\User;
use Yii;

/**
 * system module definition class
 */
class System extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\system\controllers';

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

        return
            array(
                array(
                    'active' => $module == 'system',
                    'name' => Yii::t('common', 'System'),
                    'icon' => 'icon-settings',
                    'display' => !Yii::$app->user->isGuest && User::isAdmin(Yii::$app->user->identity->role),
                    'children' => array(
                        array(
                            'active' => $controller == 'setting',
                            'name' => Yii::t('common', 'Settings'),
                            'icon' => 'glyphicon glyphicon-cog',
                            'url' => Yii::$app->urlManager->createUrl(['/system/setting/index']),
                        ),
                        array(
                            'active' => $module == 'system' && ($controller == 'role' || $action == 'right'),
                            'name' => Yii::t('common', 'Roles'),
                            'icon' => 'glyphicon glyphicon-tower',
                            'url' => Yii::$app->urlManager->createUrl(['system/role/index']),
                        ),
                        array(
                            'active' => $module == 'system' && $controller == 'user',
                            'name' => Yii::t('common', 'Users'),
                            'icon' => 'glyphicon glyphicon-user',
                            'url' => Yii::$app->urlManager->createUrl(['system/user/index']),
                        )
                    ),
                ),
            );

    }

    public static function rightModules()
    {
        return array(
            array(
                'module' => 'common',
                'module_title' => 'Common',
                'obj' => array(
                    'Site',
                    'Sample',
                    'SampleCategory'
                )
            ),
            array(
                'module' => 'system',
                'module_title' => 'System',
                'obj' => array(
                    'Setting',
                    'User',
                    'Access Control'
                )
            ),
            array(
                'module' => 'app',
                'module_title' => 'App',
                'obj' => array(
                    'User',
                    'Device',
                    'Notification',
                )
            ),
        );
    }
}
