<?php

namespace backend\modules\system\models;

use common\base\api\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $color
 * @property string $description
 * @property integer $is_active
 */
class SystemRoleAPI extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_role';
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
            'name',
            'color',
            'description',
            'is_active'
        ];
        return $fields;
    }

}