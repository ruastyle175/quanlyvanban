<?php

namespace backend\modules\app\actions;

use backend\modules\app\models\AppDeviceAPI;
use common\base\api\Action;
use common\components\FApi;
use common\components\FConstant;
use common\components\FHelper;

class DeviceAction extends Action
{
    public $is_secured = false;

    public function run()
    {
        $imei = FHelper::getRequestParam(['imei', 'ime'], '');
        $gcm_id = FHelper::getRequestParam(['gcm_id', 'device_token'], '');
        $type = FHelper::getRequestParam(['type'], ''); //android/ios
        $status = FHelper::getRequestParam(['is_active', 'status'], 1); //1/0

        $error_init = $this->initialRun();
        if (!empty($error_init) != 0) {
            return $error_init;
        }

        $user_id = $this->user_id;

        if (
            strlen($imei) == 0
            || strlen($gcm_id) == 0
            || strlen($type) == 0
        ) {
            return FApi::getOutputForAPI('', FConstant::ERROR, FConstant::MISSING_PARAMS, ['code' => 202]);
        }


        $check = AppDeviceAPI::find()->where("imei = '" . $imei . "'")->one();
        /* @var $check AppDeviceAPI */
        if (isset($check)) {

            if (strlen($status) != 0) {
                $check->is_active = $status;
            }
            $check->token = $gcm_id;
            $check->user_id = $user_id;

            if ($check->save()) {
                return FApi::getOutputForAPI($check, FConstant::SUCCESS, 'OK', ['code' => 200]);

            } else {
                return FApi::getOutputForAPI('', FConstant::ERROR, 'FAIL', ['code' => 201]);

            }
        } else {
            $new_device = new AppDeviceAPI();
            $new_device->user_id = $user_id;
            $new_device->is_active = $status;
            $new_device->imei = $imei;
            if (is_numeric($type)) {
                if ($type == 1) {
                    $type = AppDeviceAPI::TYPE_ANDROID;
                }
                if ($type == 2) {
                    $type = AppDeviceAPI::TYPE_IOS;
                }
            }
            $new_device->type = $type;
            $new_device->token = $gcm_id;
            if ($new_device->save()) {
                return FApi::getOutputForAPI($new_device, FConstant::SUCCESS, 'OK', ['code' => 200]);
            } else {
                return FApi::getOutputForAPI('', FConstant::ERROR, 'FAIL', ['code' => 201]);
            }
        }
    }

}
