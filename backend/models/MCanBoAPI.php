<?php

namespace backend\models;

use common\base\api\ActiveRecord;

/**
 * @property integer $id
 * @property string $ten_can_bo
 * @property integer $trang_thai
 */
class MCanBoAPI extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_can_bo';
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
            'ten_can_bo',
            'trang_thai'
        ];
        return $fields;
    }

}