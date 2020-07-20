<?php
namespace backend\actions;

use common\base\api\Action;
use common\components\FHelper;
use Yii;

class SendEmailAction extends Action
{
    public function run()
    {
        $email = FHelper::getRequestParam('email', '');
        $title = FHelper::getRequestParam('title', '');
        $content = FHelper::getRequestParam('content', '');

        if (strlen($email) != 0 AND strlen($title) != 0 AND strlen($content) != 0) {
            $title = "[" . Yii::$app->name . "] $title";

            \Yii::$app->mailer->compose()
                ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
                ->setTo($email)
                ->setSubject($title)
                ->setHtmlBody($content)
                ->send();
        }

        /*Yii::$app->mailer->compose()
            ->setFrom('fruity.tester@gmail.com')
            ->setTo('fruity.cuonghq@gmail.com')
            ->setSubject('Test email')
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send()*/;
        //$params = 'Hello';
        /*\Yii::$app->mailer->compose(['html' => 'demo-template-html', 'text' => 'demo-template-text'], ['params' => $params])
            ->setFrom('fruity.tester@gmail.com')
            ->setTo('fruity.nam@gmail.com')
            ->setSubject('Hello')
            ->send();*/

        //mail('fruity.nam@gmail.com', 'My Subject', $params);
    }
}
