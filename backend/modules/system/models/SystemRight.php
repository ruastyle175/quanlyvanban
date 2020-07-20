<?php

namespace backend\modules\system\models;

use Yii;

/**
 */
class SystemRight extends SystemRightBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'is_active'], 'required'],
            [['role_id'], 'integer'],
            [['module', 'obj', 'permission'], 'string', 'max' => 255],
            [['is_active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'module' => 'Module',
            'obj' => 'Object',
            'permission' => 'Permission',
            'is_active' => 'Is Active',
        ];
    }

    public function showModuleName()
    {
        return ucfirst($this->module);
    }

    public function showActivityName()
    {
        return ucfirst($this->permission);
    }
}