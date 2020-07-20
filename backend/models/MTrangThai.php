<?php

namespace backend\models;

use Yii;

/**
 */
class MTrangThai extends MTrangThaiBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trang_thai'], 'string', 'max' => 255],
            [['del_flg'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('VbDen', 'ID'),
            'trang_thai' => Yii::t('VbDen', 'Trang Thai'),
            'del_flg' => Yii::t('VbDen', 'Del Flg'),
        ];
    }
}