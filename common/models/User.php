<?php
namespace common\models;

use backend\modules\system\models\SystemRole;
use backend\modules\system\models\UserRole;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $overview
 * @property string $image
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property string $role
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @property string $uploadFolder
 * @property string $tableName
 * @property string $image_file
 * @property array $roles_selected
 * @property string $new_password
 *
 * @property SystemRole[] $roles
 *
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = -1;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const ROLE_USER = 1;
    const ROLE_MODERATOR = 2;
    const ROLE_ADMIN = 0;

    const ACTION_CREATE = 'create';
    const ACTION_UPDATE = 'update';
    const ACTION_DELETE = 'delete';
    const ACTION_VIEW = 'view';

    public $image_file;
    public $tableName = 'user';
    public $uploadFolder = 'user';
    public $new_password; //if use password => can not get post value when update
    public $roles_selected;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['role', 'default', 'value' => 10],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN, self::ROLE_MODERATOR]],

            [['username', 'name', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            ['new_password', 'required', 'on' => 'create'],
            ['new_password', 'string', 'max' => 255],

            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'name', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 300],
            [['overview'], 'string', 'max' => 2000],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['image_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Name',
            'image' => 'Image',
            'overview' => 'Overview',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'role' => 'Role',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'image_file' => 'Image File',
            'new_password' => 'Password',
            'roles_selected' => 'Roles',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    public function getRole()
    {
        return $this->role;
    }
    public static function isAdmin($role)
    {
        return $role == self::ROLE_ADMIN;
    }

    public static function isModerator($role)
    {
        return $role == self::ROLE_MODERATOR;
    }

    public static function isNormalUser($role)
    {
        return $role == self::ROLE_USER;
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function afterDelete()
    {
        $id = $this->id;
        //delete image
        $applicationUploadFolder = Yii::getAlias('@' . UPLOAD_DIR);
        $image_old = $this->image;
        if (strlen($image_old) > 0) {
            if (is_file($applicationUploadFolder . '/' . $this->uploadFolder . '/' . $image_old)) {
                unlink($applicationUploadFolder . '/' . $this->uploadFolder . '/' . $image_old);
            }
        }
        //delete roles
        UserRole::deleteAll('user_id = ' . $id);

        parent::afterDelete(); // TODO: Change the autogenerated stub
    }

    public static function showRoleLabel($role)
    {
        $str = array(
            self::ROLE_USER => 'User',
            self::ROLE_MODERATOR => 'Moderator',
            self::ROLE_ADMIN => 'Super Admin',
        );
        return isset($str[$role]) ? $str[$role] : $role;
    }

    public static function userActionArray()
    {
        $str = array(
            self::ACTION_CREATE,
            self::ACTION_UPDATE,
            self::ACTION_DELETE,
            self::ACTION_VIEW,
        );
        return $str;
    }

    public static function userActionLabel($action)
    {
        $str = array(
            self::ACTION_CREATE => 'Create',
            self::ACTION_UPDATE => 'Update',
            self::ACTION_DELETE => 'Delete',
            self::ACTION_VIEW => 'View',
        );
        return isset($str[$action]) ? $str[$action] : $action;
    }

    public static function roleArray()
    {
        return array(
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_USER => 'User',
            self::ROLE_MODERATOR => 'Moderator',
        );
    }

    public static function roleLabel($key)
    {
        $str = array(
            self::ROLE_ADMIN => '<span class="label label-sm label-danger">' . 'Admin' . '</span>',
            self::ROLE_USER => '<span class="label label-sm label-default">' . 'User' . '</span>',
            self::ROLE_MODERATOR => '<span class="label label-sm label-info">' . 'Moderator' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function roleLabels($model)
    {
        /* @var User $model */
        $roles = $model->roles;
        $role_labels = array();
        foreach ($roles as $role) {
            $role_labels[] = '<span class="label label-sm" style="background:' . $role->color . ';">' . $role->name . '</span>';
        }
        return implode('&nbsp;', $role_labels);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(SystemRole::className(), ['id' => 'role_id'])
            ->viaTable('user_role', ['user_id' => 'id']);
    }

    public static function statusArray()
    {
        return array(
            self::STATUS_DELETED => 'Disabled',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',

        );
    }

    public static function statusLabel($key)
    {
        $str = array(
            self::STATUS_DELETED => '<span class="label label-sm label-info">' . 'Disabled' . '</span>',
            self::STATUS_ACTIVE => '<span class="label label-sm label-info">' . 'Active' . '</span>',
            self::STATUS_INACTIVE => '<span class="label label-sm label-info">' . 'Inactive' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function lookupData($table_name, $key, $value)
    {
        $result = array();
        $objects = array();
        if ($table_name == "system_role") {
            $objects = SystemRole::find()->all();
        }
        if (count($objects) != 0) {
            $result = ArrayHelper::map($objects, $key, $value);
        }
        return $result;
    }

    public static function lookupLabel($table_name, $lookup_key, $lookup_value, $needle)
    {
        if (is_numeric($lookup_value)) {
            $condition = "$lookup_key = $lookup_value";
        } else {
            $condition = "$lookup_key = '$lookup_value'";
        }
        if ($table_name == "system_role") {
            $object = SystemRole::find()->where($condition)->one();
        }
        return isset($object) ? $object->{$needle} : "";
    }
}
