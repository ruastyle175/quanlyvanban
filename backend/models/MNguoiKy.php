<?php

namespace backend\models;

use Yii;

/**
 */
class MNguoiKy extends MNguoiKyBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nguoi_ky'], 'string', 'max' => 255],
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
            'nguoi_ky' => Yii::t('VbDen', 'Nguoi Ky'),
            'trang_thai' => Yii::t('VbDen', 'Trang Thai'),
        ];
    }
}