<?php

namespace common\components;

use backend\modules\system\models\SystemRight;
use common\models\User;
use Yii;
use yii\base\Action;
use yii\base\InlineAction;

class AccessRule extends \yii\filters\AccessRule
{
    protected function matchRole($user)
    {
        /* @var User $identity */
        $identity = $user->identity;

        if (FConstant::GLOBAL_ACCESS_CONTROL_MODE == FConstant::MODE_RIGHT_BAC) { //If use MODE_RIGHT_BAC => skip
            return true;
        }

        if (empty($this->roles)) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif (!$user->getIsGuest() && $role === $identity->role) {
                return true;
            }
        }

        return false;
    }

    public static function matchRights($obj, $action)
    {
        $user = Yii::$app->user;

        /* @var User $identity */

        if ($user->isGuest) {
            return false;
        }

        $identity = $user->identity;
        $role = $identity->role;

        if (FConstant::GLOBAL_ACCESS_CONTROL_MODE == FConstant::MODE_ROLE_BAC) { //If use MODE_ROLE_BAC => skip
            return true;
        }

        if ($role == User::ROLE_ADMIN) { //Super admin
            return true;
        } else {
            $roles = $identity->roles;
            $role_ids = array();
            if (count($roles) != 0) {
                foreach ($roles as $role) {
                    $role_ids[] = $role->id;
                }
                $role_id_string = implode(',', $role_ids);
                $rights = SystemRight::find()->where("role_id IN ($role_id_string) AND obj = '$obj' AND permission = '$action'")->one();
                if (count($rights) != 0) {
                    return true;
                }
            }
        }
        return false;
    }
}