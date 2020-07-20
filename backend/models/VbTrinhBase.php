<?php

namespace backend\models;


/**
 * @property integer $id
 * @property string $so_hieu
 * @property string $noidung_vanban
 * @property string $thoigian_trinh
 * @property integer $id_nguoi_nhan
 * @property string $ghichu
 * @property string $created_at
 * @property string $updated_at
 * @property integer $del_flg
 */
class VbTrinhBase extends \yii\db\ActiveRecord
{

    public $tableName = 'vb_trinh';
    public $uploadFolder = 'vb-trinh';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vb_trinh';
    }

}