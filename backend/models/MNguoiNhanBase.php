<?php

namespace backend\models;


/**
 * @property integer $id
 * @property string $nguoi_nhan
 * @property integer $trang_thai
 */
class MNguoiNhanBase extends \yii\db\ActiveRecord
{

    public $tableName = 'm_nguoi_nhan';
    public $uploadFolder = 'mnguoi-nhan';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_nguoi_nhan';
    }

}