<?php

namespace backend\modules\system\models;

use Yii;

/**
 */
class SystemSetting extends SystemSettingBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting_value'], 'string'],
            [['setting_key'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('system', 'ID'),
            'setting_key' => Yii::t('system', 'Setting Key'),
            'setting_value' => Yii::t('system', 'Setting Value'),
            'type' => Yii::t('system', 'Type'),
        ];
    }

    public static function typeArray()
    {
        return array(
            SystemSettingBase::TYPE_APPLICATION => Yii::t('system', 'Application'),
            SystemSettingBase::TYPE_LAYOUT => Yii::t('system', 'Layout'),
        );
    }

    public static function typeLabel($key)
    {
        $str = array(
            SystemSettingBase::TYPE_APPLICATION => '<span class="label label-sm label-info">' . Yii::t('system', 'Application') . '</span>',
            SystemSettingBase::TYPE_LAYOUT => '<span class="label label-sm label-info">' . Yii::t('system', 'Layout') . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    /**
     * @param $key mixed
     * @return
     */
    public static function getSettingValueByKey($key)
    {
        /* @var SystemSetting $item */
        $response = array();
        if (!is_array($key)) {
            $item = self::find()->where("setting_key ='" . $key . "'")->one();
            if (isset($item)) {
                $response[$item->setting_key] = $item->setting_value;
            }
        } else {
            $data = self::find()->where(['setting_key' => $key])->all();
            foreach ($data as $item) {
                $response[$item->setting_key] = $item->setting_value;
            }
        }
        return $response;
    }

    public static function setSettingValueByKey($key, $value)
    {
        \Yii::$app->db->createCommand()->update('system_setting', ['setting_value' => $value], 'setting_key = "' . $key . '"')->execute();
    }

}