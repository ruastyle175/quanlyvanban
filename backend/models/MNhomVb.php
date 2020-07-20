<?php

namespace backend\models;

use Yii;

/**
 */
class MNhomVb extends MNhomVbBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nhom_vb'], 'string', 'max' => 255],
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
            'nhom_vb' => Yii::t('VbDen', 'Nhom Vb'),
            'del_flg' => Yii::t('VbDen', 'Del Flg'),
        ];
    }
}