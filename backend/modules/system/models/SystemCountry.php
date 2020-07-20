<?php

namespace backend\modules\system\models;

use Yii;

/**
 */
class SystemCountry extends SystemCountryBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active'], 'required'],
            [['is_active'], 'integer'],
            [['country_code'], 'string', 'max' => 2],
            [['country_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('system', 'ID'),
            'country_code' => Yii::t('system', 'Country Code'),
            'country_name' => Yii::t('system', 'Country Name'),
            'is_active' => Yii::t('system', 'Is Active'),
        ];
    }
}