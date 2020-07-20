<?php

namespace backend\models;

use common\base\api\ActiveRecord;

/**
 * @property integer $id
 * @property string $nguoi_ky
 * @property integer $trang_thai
 */
class MNguoiKyAPI extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_nguoi_ky';
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
            'nguoi_ky',
            'trang_thai'
        ];
        return $fields;
    }

}