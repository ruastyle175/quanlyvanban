<?php

namespace backend\models;

use Yii;

/**
 */
class MDonViGui extends MDonViGuiBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_don_vi'], 'string', 'max' => 255],
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
            'ten_don_vi' => Yii::t('VbDen', 'Ten Don Vi'),
            'trang_thai' => Yii::t('VbDen', 'Trang Thai'),
        ];
    }
}