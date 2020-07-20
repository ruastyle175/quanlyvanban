<?php

namespace backend\models;

use Yii;

/**
 */
class MNguoiNhan extends MNguoiNhanBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nguoi_nhan'], 'string', 'max' => 255],
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
            'nguoi_nhan' => Yii::t('VbDen', 'Nguoi Nhan'),
            'trang_thai' => Yii::t('VbDen', 'Trang Thai'),
        ];
    }
}