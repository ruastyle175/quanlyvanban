<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * @property string $currentPassword
 * @property string $newPassword
 * @property string $newPasswordRepeat
 */
class PasswordForm extends Model
{
    public $currentPassword;
    public $newPassword;
    public $newPasswordRepeat;

    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
            ['currentPassword', 'checkPassword'],
            [
                'newPasswordRepeat', 'compare',
                'compareAttribute' => 'newPassword',
                //'message' => Yii::t('common', 'Repeat New Password must be equal to "New Password"'),
                'message' => Yii::t('common', '"Repeat New Password" must be repeated exactly of "New Password"')
            ],
        ];
    }

    public function checkPassword($attribute, $params)
    {
        /* @var $current_user User */
        $current_user = Yii::$app->user->identity;
        /* @var $user User */
        $user = User::find()->where(['username' => $current_user->username])->one();
        if (!$user || !$user->validatePassword($this->currentPassword)) {
            $this->addError($attribute, 'Old password is incorrect');
        }
    }

    public function attributeLabels()
    {
        return [
            'currentPassword' => 'Current Password',
            'newPass' => 'New Password',
            'repeatNewPass' => 'Re-type New Password',
        ];
    }
}