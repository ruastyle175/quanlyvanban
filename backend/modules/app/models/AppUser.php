<?php

namespace backend\modules\app\models;

use backend\modules\system\models\SystemCountry;
use common\components\FHelper;
use Yii;
use yii\helpers\ArrayHelper;

/**
 *
 * @property string $avatar_file
 *
 * @property string $latitude
 * @property string $longitude
 * @property string $weight
 * @property string $height
 * @property string $balance
 * @property string $rate
 * @property string $rate_count
 * @property string $last_login
 * @property string $last_activity
 *
 * @property Auth $auth
 * @property AppMeta[] $metas
 *
 *
 *
 */
class AppUser extends AppUserBase
{
    public $avatar_file;
    //meta attributes
    public $latitude;
    public $longitude;
    public $weight;
    public $height;
    public $balance;
    public $rate;
    public $rate_count;
    public $last_login;
    public $last_activity;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude', 'weight', 'height', 'balance', 'rate', 'rate_count', 'last_login', 'last_activity'], 'string', 'max' => 255],
            [['name', 'username', 'email', 'password'], 'required'],
            [['auth_id', 'role'], 'integer'],
            [['content'], 'string'],
            [['avatar', 'name', 'username', 'email', 'password', 'password_hash', 'password_reset_token', 'dob', 'address'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 2000],
            [['gender', 'city', 'state', 'country', 'type', 'status'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 25],
            [['is_online', 'is_active'], 'string', 'max' => 1],
            [['created_date', 'modified_date'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['avatar_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'avatar' => 'Avatar',
            'name' => 'Name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'auth_id' => 'Auth ID',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'description' => 'Description',
            'content' => 'Content',
            'gender' => 'Gender',
            'dob' => 'Dob',
            'phone' => 'Phone',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'role' => 'Role',
            'type' => 'Type',
            'status' => 'Status',
            'is_online' => 'Is Online',
            'is_active' => 'Is Active',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'avatar_file' => 'Avatar File',
        ];
    }

    public static function genderArray()
    {
        return array(
            AppUserBase::GENDER_MALE => 'Male',
            AppUserBase::GENDER_FEMALE => 'Female',
            AppUserBase::GENDER_OTHER => 'Other',
        );
    }

    public static function genderLabel($key)
    {
        $str = array(
            AppUserBase::GENDER_MALE => '<span class="label label-sm label-info">' . 'Male' . '</span>',
            AppUserBase::GENDER_FEMALE => '<span class="label label-sm label-info">' . 'Female' . '</span>',
            AppUserBase::GENDER_OTHER => '<span class="label label-sm label-info">' . 'Other' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function typeArray()
    {
        return array(
            AppUserBase::TYPE_NORMAL => 'Normal',
            AppUserBase::TYPE_VIP => 'Vip',
            AppUserBase::TYPE_STAFF => 'Staff',
        );
    }

    public static function typeLabel($key)
    {
        $str = array(
            AppUserBase::TYPE_NORMAL => '<span class="label label-sm label-info">' . 'Normal' . '</span>',
            AppUserBase::TYPE_VIP => '<span class="label label-sm label-info">' . 'Vip' . '</span>',
            AppUserBase::TYPE_STAFF => '<span class="label label-sm label-info">' . 'Staff' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function statusArray()
    {
        return array(
            AppUserBase::STATUS_NORMAL => 'Normal',
            AppUserBase::STATUS_BAN => 'Ban',
            AppUserBase::STATUS_PENDING => 'Pending',
        );
    }

    public static function statusLabel($key)
    {
        $str = array(
            AppUserBase::STATUS_NORMAL => '<span class="label label-sm label-info">' . 'Normal' . '</span>',
            AppUserBase::STATUS_BAN => '<span class="label label-sm label-info">' . 'Ban' . '</span>',
            AppUserBase::STATUS_PENDING => '<span class="label label-sm label-info">' . 'Pending' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function lookupData($table_name, $key, $value)
    {
        $result = array();
        $objects = array();
        if ($table_name == "system_country") {
            $objects = SystemCountry::find()->all();
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
        if ($table_name == "system_country") {
            $object = SystemCountry::find()->where($condition)->one();
        }
        return isset($object) ? $object->{$needle} : "";
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuth()
    {
        return $this->hasOne(Auth::className(), ['id' => 'auth_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetas()
    {
        return $this->hasMany(AppMeta::className(), ['user_id' => 'id']);
    }

    /**
     * @return array
     */
    public function loadMeta() {
        $metas = $this->metas;
        $result = array();
        foreach ($metas as $meta) {
            $result[$meta->meta_key] = $meta->meta_value;
        }
        return $result;
    }

    public function fillMeta() {
        $metas = self::loadMeta();
        $this->latitude = FHelper::getExistArrayValueByKey('latitude', $metas);
        $this->longitude = FHelper::getExistArrayValueByKey('longitude', $metas);
        $this->weight = FHelper::getExistArrayValueByKey('weight', $metas);
        $this->height = FHelper::getExistArrayValueByKey('height', $metas);
        $this->rate = FHelper::getExistArrayValueByKey('rate', $metas);
        $this->rate_count = FHelper::getExistArrayValueByKey('rate_count', $metas);
        $this->balance = FHelper::getExistArrayValueByKey('balance', $metas);
        $this->last_login = FHelper::getExistArrayValueByKey('last_login', $metas);
        $this->last_activity = FHelper::getExistArrayValueByKey('last_activity', $metas);
    }

    public function metaFields() {
        return [
            'latitude',
            'longitude',
            'weight',
            'height',
            'balance',
            'rate',
            'rate_count',
            'last_login',
            'last_activity',
        ];
    }
    public function saveMeta() {
        $connection = Yii::$app->db;
        $array_meta = [];
        $meta_fields = self::metaFields();
        foreach ($meta_fields as $meta_field) {
            $array_meta[] = [
                $this->id,
                $meta_field,
                $this->{$meta_field}
            ];
        }
        AppMeta::deleteAll(['user_id' => $this->id]);
        $connection->createCommand()->batchInsert('app_meta',
            [
                'user_id',
                'meta_key',
                'meta_value',
            ],
            $array_meta
        )->execute();
    }

    public function afterFind()
    {
        self::fillMeta();
        parent::afterFind(); // TODO: Change the autogenerated stub
    }
}