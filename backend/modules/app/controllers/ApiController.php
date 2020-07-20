<?php

namespace backend\modules\app\controllers;


/**
 * Default controller for the `api` module
 */
class ApiController extends \backend\controllers\ApiController
{
    /**
     * Renders the index view for the module
     * @return array
     *
     */

    public function actions()
    {
        return [
            'login' => ['class' => 'backend\modules\app\actions\LoginAction', 'checkAccess' => [$this, 'checkAccess']],
            'register' => ['class' => 'backend\modules\app\actions\RegisterAction', 'checkAccess' => [$this, 'checkAccess']],
            'profile' => ['class' => 'backend\modules\app\actions\ProfileAction', 'checkAccess' => [$this, 'checkAccess']],
            'logout' => ['class' => 'backend\modules\app\actions\LogoutAction', 'checkAccess' => [$this, 'checkAccess']],
            'forget-password' => ['class' => 'backend\modules\app\actions\ForgetPasswordAction', 'checkAccess' => [$this, 'checkAccess']],
            'update-profile' => ['class' => 'backend\modules\app\actions\UpdateProfileAction', 'checkAccess' => [$this, 'checkAccess']],
            'change-password' => ['class' => 'backend\modules\app\actions\ChangePasswordAction', 'checkAccess' => [$this, 'checkAccess']],
            'device' => ['class' => 'backend\modules\app\actions\DeviceAction', 'checkAccess' => [$this, 'checkAccess']],
            'update-location' => ['class' => 'backend\modules\app\actions\UpdateLocationAction', 'checkAccess' => [$this, 'checkAccess']],
            'push-notification' => ['class' => 'backend\modules\app\actions\PushNotificationAction', 'checkAccess' => [$this, 'checkAccess']],
        ];
    }
}
