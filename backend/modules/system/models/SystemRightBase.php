<?php

namespace backend\modules\system\models;


/**
 * @property integer $id
 * @property integer $role_id
 * @property string $module
 * @property string $obj
 * @property string $permission
 * @property integer $is_active
 */
class SystemRightBase extends \yii\db\ActiveRecord
{

    public $tableName = 'system_right';
    public $uploadFolder = 'system-right';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_right';
    }

}