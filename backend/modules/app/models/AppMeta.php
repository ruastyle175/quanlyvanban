<?php

namespace backend\modules\app\models;

use Yii;

/**
 */
class AppMeta extends AppMetaBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'last_update'], 'integer'],
            [['meta_key'], 'required'],
            [['meta_value'], 'string'],
            [['meta_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'meta_key' => 'Meta Key',
            'meta_value' => 'Meta Value',
            'last_update' => 'Last Update',
        ];
    }
}