<?php

namespace backend\controllers;

use backend\models\PasswordResetRequestForm;
use backend\models\ResetPassForm;
use backend\models\ResetPasswordForm;
use common\components\FFile;
use common\components\FHelper;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class SiteController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'file', 'request-password-reset', 'reset-password', 'reset-pass'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'logout', 'about', 'delete-file'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionLogin()
    {
        $this->layout = 'login';

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login2', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionFile($file_name, $file_path)
    {
        // check filename for allowed chars (do not allow ../ to avoid security issue: downloading arbitrary files)
        //if (!preg_match('/^[a-z0-9]+\.[a-z0-9]+$/i', $file_name) || !is_file($file_path)) {
        //    throw new \yii\web\NotFoundHttpException('The file does not exists.');
        //}
        return Yii::$app->response->sendFile($file_path, $file_name);

    }

    public static function actionDeleteFile()
    {
        $key = FHelper::getRequestParam('key');
        $pk = FHelper::getRequestParam('pk');
        $pk_value = FHelper::getRequestParam('pk_value');
        $table_name = FHelper::getRequestParam('table_name');
        $attribute = FHelper::getRequestParam('attribute');
        $sub_dir = FHelper::getRequestParam('sub_dir');

        if (strlen($key) != 0)
        {
            $image_path = FFile::getFilePath($key, $sub_dir);
            unlink($image_path);
            if(strlen($table_name) != 0 && strlen($attribute)!=0) {
                Yii::$app->db->createCommand()->update($table_name, [$attribute => ''], "$pk = $pk_value")->execute();
            }

        }
        return true;
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'login';

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password for backend user.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = 'login';

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password for app user.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPass($token)
    {
        $this->layout = 'login';

        try {
            $model = new ResetPassForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
