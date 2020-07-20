<?php

namespace backend\models;


/**
 * @property integer $id
 * @property string $nguoi_ky
 * @property integer $trang_thai
 */
class MNguoiKyBase extends \yii\db\ActiveRecord
{

    public $tableName = 'm_nguoi_ky';
    public $uploadFolder = 'mnguoi-ky';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_nguoi_ky';
    }

}