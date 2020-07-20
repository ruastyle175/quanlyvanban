<?php

namespace backend\modules\app\controllers;

use backend\controllers\BackendController;
use backend\modules\app\models\NotificationForm;
use common\components\AccessRule;
use common\components\FInteractive;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Default controller for the `app` module
 */
class DefaultController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index', 'notification'],
                'rules' => [
                    [
                        'actions' => ['notification'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionNotification()
    {
        $model = new NotificationForm;
        if (isset($_REQUEST['NotificationForm'])) {
            $title = $_REQUEST['NotificationForm']['title'];
            $message = $_REQUEST['NotificationForm']['message'];
            $link = isset($_REQUEST['NotificationForm']['link']) ? $_REQUEST['NotificationForm']['link'] : '';
            if (strlen($message) > 0) {
                $push_link = ['app/api/push-notification'];
                $push_data = array(
                    'title' => $title,
                    'message' => $message,
                    'data' => json_encode(
                        array(
                            'link' => $link
                        )
                    )
                );
                FInteractive::async($push_link, $push_data);
                Yii::$app->getSession()->setFlash('success', 'Send notification successfully');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Empty message');
            }

            return $this->redirect(Yii::$app->request->getReferrer());
        }

        return $this->render('notification', [
            'model' => $model
        ]);
    }

}
