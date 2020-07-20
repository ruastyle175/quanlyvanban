<?php

namespace backend\modules\app\actions;

use backend\modules\app\models\AppDeviceAPI;
use common\base\api\Action;
use common\components\FConstant;
use common\components\FHelper;
use common\components\FInteractive;
use yii\helpers\ArrayHelper;


class PushNotificationAction extends Action
{
    public function run()
    {
        //http://www.yiiframework.com/wiki/780/drills-search-by-a-has_many-relation-in-yii-2-0/
        $title = FHelper::getRequestParam('title', '');
        $message = FHelper::getRequestParam('message', '');
        $data = FHelper::getRequestParam('data', '');


        //$condition = ['is_active' => FConstant::STATE_ACTIVE];
        //$android_condition = array_merge($condition, [['OR', ['type' => 1], ['type' => 'android']]]);
        //$ios_condition = array_merge($condition, [['OR', ['type' => 2], ['type' => 'ios']]]);

        $condition = 'is_active = ' . FConstant::STATE_ACTIVE;
        $android_condition = $condition . " AND (type = 1 OR type = 'android')";
        $ios_condition = $condition . " AND (type = 2 OR type = 'ios')";

        $all_android_devices = AppDeviceAPI::find()->select('token')->where($android_condition)->all();
        $android_devices = array_column(ArrayHelper::toArray($all_android_devices), 'token');

        $all_ios_devices = AppDeviceAPI::find()->select('token')->where($ios_condition)->all();
        $ios_devices = array_column(ArrayHelper::toArray($all_ios_devices), 'token');

        $check = json_decode($data, true);

        $additional_data = ['title' => $title];
        if (json_last_error() == JSON_ERROR_NONE) {
            if (is_array($check)) {
                $additional_data = array_merge($additional_data, $check);
            }
        }

        if (!empty($android_devices)) {
            try {
                FInteractive::pushAndroid($android_devices, $message, $additional_data);
            } catch (\Exception $e) {
                return $e;
            }
        }

        if (!empty($ios_devices)) {
            try {
                FInteractive::pushIosFcmTopic($ios_devices, $message, $additional_data);
            } catch (\Exception $e) {
                return $e;
            }
        }
    }
}
