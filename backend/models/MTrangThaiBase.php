<?php

namespace backend\models;


/**
 * @property integer $id
 * @property string $trang_thai
 * @property integer $del_flg
 */
class MTrangThaiBase extends \yii\db\ActiveRecord
{

    public $tableName = 'm_trang_thai';
    public $uploadFolder = 'mtrang-thai';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_trang_thai';
    }

}