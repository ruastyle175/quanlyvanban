<?php

namespace backend\controllers;

use backend\models\Sample;
use backend\models\SampleCategory;
use backend\models\VbDen;
use backend\models\VbDi;
use backend\models\VbTrinh;
use backend\modules\app\App;
use backend\modules\system\System;
use common\components\AccessRule;
use common\components\FConstant;
use common\components\FHtml;
use common\components\FSetting;
use kartik\form\ActiveForm;
use Yii;
use yii\base\Action;
use yii\base\Module;
use yii\helpers\StringHelper;
use yii\web\Controller;

/**
 * @property string $uploadFolder
 * @property array $mainMenu;
 */
class BackendController extends Controller
{
    public $mainMenu = array();
    public $uploadFolder;

    public function init()
    {
        parent::init();

        if (isset(Yii::$app->view->theme)) {
            Yii::$app->assetManager->bundles['yii\\bootstrap\\BootstrapAsset'] = [
                'css' => []
            ];
        }

//To turn off bootstrap.css and others
//Place above code here
//Or place below code on config/main.php
//Remove some assets js or css
//        'assetManager' => [
//        'bundles' => [
//                //disable bootstrap.css
//                'yii\bootstrap\BootstrapAsset' => [
//                    'css' => [],
//                ],
//                //disable bootstrap.js
//                'yii\bootstrap\BootstrapPluginAsset' => [
//                    'js' => []
//                ],
//                //disable jquery.js
//                'yii\web\JqueryAsset' => [
//                        'js'=>[]
//                    ],
//                ],
//                //UPDATE
//                //As Soju mentioned in comments, another alternative way would be disabling these files in AppAsset class, which is located in ./assets/, then remove the following lines:
//                //public $depends = [
//                    //'yii\web\YiiAsset',              #REMOVE
//                    //'yii\bootstrap\BootstrapAsset',  #REMOVE
//                    //];
//        ],
//    ],

        $this->view->params['toolBarActions'] = array();

        $isAjax = FHtml::configLayout('isAjax', false);
        $this->view->params['isAjax'] = $isAjax;
        $this->view->params['displayType'] = $isAjax ? "modal-remote" : "";

        $body_class = array(
            'page-content-white',
            'page-sidebar-closed-hide-logo'
        );
        $header_class = array(
            'page-header',
            'navbar'
        );
        $header_inner_class = array('page-header-inner');
        $sidebar_menu_class = array(
            'page-sidebar-menu',
            'page-header-fixed'
        );

        $themeStyle = FHtml::configLayout('themeStyle', 'md');
        $this->view->params['themeStyle'] = $themeStyle;
        if ($themeStyle == "md") {
            $this->view->params['cssComponents'] = "components-md";
            $this->view->params['cssPlugins'] = "plugins-md";
            $body_class[] = "page-md";
        } else {
            if ($themeStyle == "rounded") {
                $this->view->params['cssComponents'] = "components-rounded";
            } else {
                $this->view->params['cssComponents'] = "components";
            }
            $this->view->params['cssPlugins'] = "plugins";
        }

        $layoutStyle = FHtml::configLayout('layoutStyle', 'fluid');
        $this->view->params['layoutStyle'] = $layoutStyle;
        if ($layoutStyle == "boxed") {
            $body_class[] = "page-boxed";
            $header_inner_class[] = "container";
        }

        $headerStyle = FHtml::configLayout('headerStyle', 'fixed');
        $this->view->params['headerStyle'] = $headerStyle;
        if ($headerStyle == "fixed") {
            $body_class[] = "page-header-fixed";
            $header_class[] = "navbar navbar-fixed-top";
        } else {
            $header_class[] = "navbar-static-top";
        }

        //$sidebarMode =  FHtml::configLayout('sidebarMode', 'default');
        //$this->view->params['sidebarMode'] = $sidebarMode;

        $sidebarStyle = FHtml::configLayout('sidebarStyle', 'default');
        $this->view->params['sidebarStyle'] = $sidebarStyle;
        if ($sidebarStyle == "light") {
            $sidebar_menu_class[] = "page-sidebar-menu-light";
        }

        $sidebarPosition = FHtml::configLayout('sidebarPosition', 'left');
        $this->view->params['sidebarPosition'] = $sidebarPosition;
        if ($sidebarPosition == "right") {
            $body_class[] = "page-sidebar-reversed";
        }

        $footerStyle = FHtml::configLayout('footerStyle', 'fixed');
        $this->view->params['footerStyle'] = $footerStyle;
        if ($footerStyle == "fixed") {
            $body_class[] = "page-footer-fixed";
        }

        $this->view->params['bodyClass'] = implode(" ", $body_class);
        $this->view->params['headerClass'] = implode(" ", $header_class);
        $this->view->params['headerInnerClass'] = implode(" ", $header_inner_class);
        $this->view->params['sidebarMenuClass'] = implode(" ", $sidebar_menu_class);

        $this->view->params['portletStyle'] = 'portlet' . ' ' . FConstant::WIDGET_TYPE_LIGHT;
        $this->view->params['mainIcon'] = FHtml::configLayout('mainIcon', 'fa-fa-list');
        $this->view->params['mainColor'] = FHtml::configLayout('mainColor', FConstant::WIDGET_COLOR_DEFAULT);
        $this->view->params['displayPortlet'] = FHtml::configLayout('displayPortlet', true);
        $this->view->params['activeFormType'] = FHtml::configLayout('activeFormType', ActiveForm::TYPE_HORIZONTAL);
        $this->view->params['displayPageContentHeader'] = FHtml::configLayout('displayPageContentHeader', true);
    }

    public function beforeAction($action)
    {
        $this->uploadFolder = Yii::getAlias('@' . UPLOAD_DIR);
        $this->createMenu();
        return parent::beforeAction($action);
    }

    public function createMenu()
    {
        $module = $this->module;
        $controller = Yii::$app->controller;
        $action = $this->action;
        $params = Yii::$app->request->queryString;

        $menu = self::backendMenu($module, $controller, $action, $params);

        $this->mainMenu = $menu;
        $this->view->params['mainMenu'] = $this->mainMenu;
    }

    /**
     * @param $module Module
     * @param $controller Controller
     * @param $action Action
     * @param $params string
     * @return array
     */
    public function backendMenu($module, $controller, $action, $params)
    {
        $current_module = $module->id;
        $current_controller = $controller->id;
        $current_action = $action->id;

        $params_array = array();

        $params_array_explode = explode('&', $params);
        foreach ($params_array_explode as $item) {
            $position = strpos($item, '=');
            $key = substr($item, 0, $position);
            $value = substr($item, $position + 1, strlen($item));
            $params_array[$key] = $value;
        }

//        $menu[] = array(
//            'active' => $current_controller == 'site' && ($current_action == 'index' || $current_action == 'error'),
//            'name' => Yii::t('common', 'Home'),
//            'icon' => 'glyphicon glyphicon-home',
//            'url' => Yii::$app->urlManager->createUrl(['/site/index']),
//            'display' => true,
//        );

        //vb-den
        $menu[] = array(
            'active' => $current_controller == 'vb-den',
            'name' => Yii::t('common', 'Văn bản đến'),
            'icon' => 'glyphicon glyphicon-list',
            'url' => Yii::$app->urlManager->createUrl(['/vb-den/index']),
            'display' => AccessRule::matchRights(StringHelper::basename(VbDen::className()), 'index')
        );

        //vb-di
        $menu[] = array(
            'active' => $current_controller == 'vb-di',
            'name' => Yii::t('common', 'Văn bản đi'),
            'icon' => 'glyphicon glyphicon-list',
            'url' => Yii::$app->urlManager->createUrl(['/vb-di/index']),
            'display' => AccessRule::matchRights(StringHelper::basename(VbDi::className()), 'index')
        );

        //vb-trinh
        $menu[] = array(
            'active' => $current_controller == 'vb-trinh',
            'name' => Yii::t('common', 'Văn bản trình'),
            'icon' => 'glyphicon glyphicon-list',
            'url' => Yii::$app->urlManager->createUrl(['/vb-trinh/index']),
            'display' => AccessRule::matchRights(StringHelper::basename(VbTrinh::className()), 'index')
        );

//        $menu = array_merge($menu, App::createModuleMenu($current_module, $current_controller, $current_action));
        $menu = array_merge($menu, System::createModuleMenu($current_module, $current_controller, $current_action));

        return $menu;
    }
}

