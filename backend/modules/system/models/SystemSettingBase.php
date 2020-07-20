<?php

namespace backend\modules\system\models;


/**
 * @property integer $id
 * @property string $setting_key
 * @property string $setting_value
 * @property string $type
 */
class SystemSettingBase extends \yii\db\ActiveRecord
{
    const TYPE_APPLICATION = 'application';
    const TYPE_LAYOUT = 'layout';

    public $tableName = 'system_setting';
    public $uploadFolder = 'system-setting';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_setting';
    }

}