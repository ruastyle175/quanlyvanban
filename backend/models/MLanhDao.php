<?php

namespace backend\models;

use Yii;

/**
 */
class MLanhDao extends MLanhDaoBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_lanh_dao'], 'string', 'max' => 255],
            [['trang_thai'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('VbDen', 'ID'),
            'ten_lanh_dao' => Yii::t('VbDen', 'Ten Lanh Dao'),
            'trang_thai' => Yii::t('VbDen', 'Trang Thai'),
        ];
    }
}