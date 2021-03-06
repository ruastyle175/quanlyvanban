<?php

namespace backend\models;

use common\base\api\ActiveRecord;

/**
 * @property integer $id
 * @property string $nhom_vb
 * @property integer $del_flg
 */
class MNhomVbAPI extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_nhom_vb';
    }

    public function fields()
    {
        $fields = parent::fields(); // TODO: Change the autogenerated stub
        return $fields;
    }

    public function apiFields()
    {
        //$fields = parent::apiFields(); // TODO: Change the autogenerated stub
        $fields = [
            'id',
            'nhom_vb',
            'del_flg'
        ];
        return $fields;
    }

}