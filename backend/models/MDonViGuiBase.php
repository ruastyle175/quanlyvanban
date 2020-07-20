<?php

namespace backend\models;


/**
 * @property integer $id
 * @property string $ten_don_vi
 * @property integer $trang_thai
 */
class MDonViGuiBase extends \yii\db\ActiveRecord
{

    public $tableName = 'm_don_vi_gui';
    public $uploadFolder = 'mdon-vi-gui';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_don_vi_gui';
    }

}