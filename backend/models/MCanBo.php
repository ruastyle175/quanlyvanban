<?php

namespace backend\models;

use Yii;

/**
 */
class MCanBo extends MCanBoBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_can_bo'], 'string', 'max' => 255],
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
            'ten_can_bo' => Yii::t('VbDen', 'Ten Can Bo'),
            'trang_thai' => Yii::t('VbDen', 'Trang Thai'),
        ];
    }
}