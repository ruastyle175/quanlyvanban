<?php

namespace backend\models;


/**
 * @property integer $id
 * @property string $ten_can_bo
 * @property integer $trang_thai
 */
class MCanBoBase extends \yii\db\ActiveRecord
{

    public $tableName = 'm_can_bo';
    public $uploadFolder = 'mcan-bo';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_can_bo';
    }

}