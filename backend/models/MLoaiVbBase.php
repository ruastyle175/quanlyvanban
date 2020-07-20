<?php

namespace backend\models;


/**
 * @property integer $id
 * @property string $loai_vb
 * @property integer $del_flg
 */
class MLoaiVbBase extends \yii\db\ActiveRecord
{

    public $tableName = 'm_loai_vb';
    public $uploadFolder = 'mloai-vb';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_loai_vb';
    }

}