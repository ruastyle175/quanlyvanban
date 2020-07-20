<?php

namespace backend\modules\app\actions;

use backend\modules\app\models\AppUserAPI;
use common\base\api\Action;
use common\components\FConstant;
use common\components\FApi;
use common\components\FHelper;

/* @var $check AppUserAPI */
class ProfileAction extends Action
{
    public $is_secured = true;
    public $is_dynamic = false;

    public function run()
    {
        $this->model_fields = AppUserAPI::getInstance()->dynamicFields();
        $error_init = $this->initialRun();
        if (!empty($error_init) != 0) {
            return $error_init;
        }

        $destination_id = FHelper::getRequestParam('user_id', '');
        $user_id = $this->user_id;

        if (strlen($destination_id) == 0) {
            $check = AppUserAPI::find()->select($this->fields)->where(['id' => $user_id])->one();
        } else {
            $check = AppUserAPI::find()->select($this->fields)->where(['id' => $destination_id])->one();
        }

        if (isset($check)) {
            $data = $check;
            return FApi::getOutputForAPI($data, FConstant::SUCCESS, 'OK', ['code' => 200]);
        } else {
            return FApi::getOutputForAPI('', FConstant::ERROR, FConstant::USER_NOT_FOUND, ['code' => 221]);
        }
    }

}
