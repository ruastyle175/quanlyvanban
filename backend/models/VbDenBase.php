<?php

namespace backend\models;


/**
 * @property integer $id
 * @property integer $id_donvi_gui
 * @property string $so_hieu
 * @property integer $id_loai_vanban
 * @property string $noidung_vanban
 * @property string $thoigian_banhanh
 * @property string $thoigian_nhan
 * @property integer $id_lanh_dao
 * @property integer $id_can_bo
 * @property string $thoigian_hoanthanh
 * @property integer $id_trang_thai
 * @property string $created_at
 * @property string $updated_at
 * @property integer $del_flg
 */
class VbDenBase extends \yii\db\ActiveRecord
{

    public $tableName = 'vb_den';
    public $uploadFolder = 'vb-den';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vb_den';
    }

}