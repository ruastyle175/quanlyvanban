<?php

namespace backend\modules\system\models;


/**
 * @property integer $id
 * @property string $name
 * @property string $color
 * @property string $description
 * @property integer $is_active
 */
class SystemRoleBase extends \yii\db\ActiveRecord
{

    public $tableName = 'system_role';
    public $uploadFolder = 'system-role';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_role';
    }

}