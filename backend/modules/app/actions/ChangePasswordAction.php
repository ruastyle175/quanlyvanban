<?php

namespace backend\modules\app\actions;

use backend\modules\app\models\AppUserAPI;
use common\base\api\Action;
use common\components\FApi;
use common\components\FConstant;

class ChangePasswordAction extends Action
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized()) !== true)
            return $re;

        $user_id = $this->user_id;

        $current_password = isset($_REQUEST['current_password']) ? $_REQUEST['current_password'] : '';
        $new_password = isset($_REQUEST['new_password']) ? $_REQUEST['new_password'] : '';

        $check = AppUserAPI::findOne($user_id);
        if (isset($check)) {
            if (isset($check->password) && strlen($check->password) != 0) {
                if (!$check->validatePassword($current_password)) {
                    return FApi::getOutputForAPI('', FConstant::ERROR, 'Current password mismatch', ['code' => 225]);
                }
                if ($check->validatePassword($new_password)) {
                    return FApi::getOutputForAPI('', FConstant::ERROR, 'Current password and new password are the same', ['code' => 234]);
                }
            }
            $check->setPassword($new_password);
            $check->generateAuthKey();

            if ($check->save()) {
                return FApi::getOutputForAPI('', FConstant::SUCCESS, 'OK', ['code' => 200]);
            } else {
                return FApi::getOutputForAPI('', FConstant::ERROR, 'FAIL', ['code' => 201]);
            }
        } else {
            return FApi::getOutputForAPI('', FConstant::ERROR, FConstant::USER_NOT_FOUND, ['code' => 221]);
        }
    }
}
