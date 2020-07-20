<?php

namespace backend\models;

use Yii;

/**
 */
class MLoaiVb extends MLoaiVbBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loai_vb'], 'string', 'max' => 255],
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
            'loai_vb' => Yii::t('VbDen', 'Loai Vb'),
            'del_flg' => Yii::t('VbDen', 'Del Flg'),
        ];
    }
}