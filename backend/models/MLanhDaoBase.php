<?php

namespace backend\models;


/**
 * @property integer $id
 * @property string $ten_lanh_dao
 * @property integer $trang_thai
 */
class MLanhDaoBase extends \yii\db\ActiveRecord
{

    public $tableName = 'm_lanh_dao';
    public $uploadFolder = 'mlanh-dao';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_lanh_dao';
    }

}