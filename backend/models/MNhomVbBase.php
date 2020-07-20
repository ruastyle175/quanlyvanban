<?php

namespace backend\models;


/**
 * @property integer $id
 * @property string $nhom_vb
 * @property integer $del_flg
 */
class MNhomVbBase extends \yii\db\ActiveRecord
{

    public $tableName = 'm_nhom_vb';
    public $uploadFolder = 'mnhom-vb';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_nhom_vb';
    }

}