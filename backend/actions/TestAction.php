<?php

namespace backend\actions;

use common\base\api\Action;
use common\components\FHelper;
use Yii;

class TestAction extends Action
{
    public function run()
    {

        $modules = array_keys(Yii::$app->modules);
        //$skip_modules = ['gridview', 'gii'];
        //$content_modules = array_diff($modules, $skip_modules);


        echo "<pre>";
        var_dump(Yii::$app->modules);die;


        var_dump(FHelper::isSequentialArray(array('a', 'b', 'c'))); // false
        var_dump(FHelper::isSequentialArray(array("0" => 'a', "1" => 'b', "2" => 'c'))); // false
        var_dump(FHelper::isSequentialArray(array("1" => 'a', "0" => 'b', "2" => 'c'))); // true
        var_dump(FHelper::isSequentialArray(array("a" => 'a', "b" => 'b', "c" => 'c'))); // true

        die;
        $send = Yii::$app->mailer->compose()
            //->setHtmlBody($pending->content)
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML fuck you content</b>')
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
            ->setTo(['immrhy@gmail.com'])
            ->setSubject('[' . Yii::$app->name . '] ' . "Test")
            ->send();
    }
}
