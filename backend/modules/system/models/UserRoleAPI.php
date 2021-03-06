<?php

namespace backend\modules\system\models;

use common\base\api\ActiveRecord;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 */
class UserRoleAPI extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_role';
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
            'user_id',
            'role_id'
        ];
        return $fields;
    }

}