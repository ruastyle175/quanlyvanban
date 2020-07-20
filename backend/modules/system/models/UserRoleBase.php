<?php

namespace backend\modules\system\models;


/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 */
class UserRoleBase extends \yii\db\ActiveRecord
{

    public $tableName = 'user_role';
    public $uploadFolder = 'user-role';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_role';
    }

}