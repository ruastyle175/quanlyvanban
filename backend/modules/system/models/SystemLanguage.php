<?php

namespace backend\modules\system\models;

use Yii;

/**
 */
class SystemLanguage extends SystemLanguageBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_code', 'language_name', 'is_active'], 'required'],
            [['is_active'], 'integer'],
            [['language_code'], 'string', 'max' => 2],
            [['language_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('system', 'ID'),
            'language_code' => Yii::t('system', 'Language Code'),
            'language_name' => Yii::t('system', 'Language Name'),
            'is_active' => Yii::t('system', 'Is Active'),
        ];
    }
}