<?php

namespace backend\modules\system\models;


/**
 * @property integer $id
 * @property string $country_code
 * @property string $country_name
 * @property integer $is_active
 */
class SystemCountryBase extends \yii\db\ActiveRecord
{

    public $tableName = 'system_country';
    public $uploadFolder = 'system-country';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_country';
    }

}