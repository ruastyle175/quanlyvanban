<?php

namespace backend\modules\app\actions;

use backend\modules\app\models\AppUserAPI;
use common\base\api\Action;
use common\components\FConstant;
use common\components\FApi;
use Yii;

class RegisterAction extends Action
{
    public $is_secured = false;

    public function run()
    {
        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
        $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

        if (strlen($username) == 0
            || strlen($name) == 0
            || strlen($password) == 0
        ) {
            return FApi::getOutputForAPI('', FConstant::ERROR, FConstant::MISSING_PARAMS, ['code' => 202]);
        }

        $check = AppUserAPI::find()->where("username = '" . $username . "'")->one();

        if (isset($check)) {
            return FApi::getOutputForAPI('', FConstant::ERROR, FApi::getErrorMsg(225), ['code' => 225]);
        } else {
            $now = time();
            $today = date('Y-m-d H:i:s', $now);

            $new_user = new AppUserAPI();
            $new_user->name = $name;
            $new_user->email = $username;
            $new_user->username = $username;
            $new_user->gender = $gender;
            $new_user->address = $address;
            $new_user->phone = $phone;
            $new_user->is_active = FConstant::STATE_ACTIVE;
            $new_user->status = FConstant::LABEL_NORMAL;
            $new_user->created_date = $today;
            $new_user->balance = 1000000;
            $new_user->rate = 0;
            $new_user->rate_count = 0;

            $reset_token = md5($now);
            $new_user->password_reset_token = $reset_token;
            $new_user->setPassword($password);
            $new_user->generateAuthKey();

            if ($new_user->save()) {
                $send = Yii::$app->mailer->compose(['html' => 'welcome-html', 'text' => 'welcome-text', 'htmlLayout' => '@layouts/welcome-html.php'], ['user' => $new_user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($new_user->email)
                    ->setSubject('[' . Yii::$app->name . '] Welcome new member')
                    ->send();
                if ($send) {
                    return FApi::getOutputForAPI('', FConstant::SUCCESS, 'OK', ['code' => 200]);
                } else {
                    $new_user->delete();
                    return FApi::getOutputForAPI('', FConstant::ERROR, 'Can not send activation email, please check your email address', ['code' => 229]);
                }
            } else {
                $errors = $new_user->getErrors();
                $error_message = FApi::getErrorMessage($errors);
                return FApi::getOutputForAPI('', FConstant::ERROR, $error_message, ['code' => 203]);
            }
        }
    }
}
