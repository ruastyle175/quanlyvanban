<?php

namespace backend\modules\app\models;

use Yii;

/**
 * @property integer $id
 * @property string $avatar
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property integer $auth_id
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $description
 * @property string $content
 * @property string $gender
 * @property string $dob
 * @property string $phone
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property integer $role
 * @property string $type
 * @property string $status
 * @property integer $is_online
 * @property integer $is_active
 * @property string $created_date
 * @property string $modified_date
 *
 * @property string $uploadFolder
 * @property string $tableName
 */
class AppUserBase extends \yii\db\ActiveRecord
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const GENDER_OTHER = 'other';
    const TYPE_NORMAL = 'normal';
    const TYPE_VIP = 'vip';
    const TYPE_STAFF = 'staff';
    const STATUS_NORMAL = 'normal';
    const STATUS_BAN = 'ban';
    const STATUS_PENDING = 'pending';

    public $tableName = 'app_user';
    public $uploadFolder = 'app-user';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_user';
    }

    public function afterDelete()
    {
        //$id = $this->id;
        $applicationUploadFolder = Yii::getAlias('@' . UPLOAD_DIR);
        $avatar_old = $this->avatar;
        if (strlen($avatar_old) > 0) {
            if (is_file($applicationUploadFolder . '/' . $this->uploadFolder . '/' . $avatar_old)) {
                unlink($applicationUploadFolder . '/' . $this->uploadFolder . '/' . $avatar_old);
            }
        }
        AppMetaBase::deleteAll(['user_id' => $this->id]);
        parent::afterDelete(); // TODO: Change the autogenerated stub
    }
}