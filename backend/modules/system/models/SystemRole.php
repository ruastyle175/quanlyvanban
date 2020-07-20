<?php

namespace backend\modules\system\models;

use Yii;

/**
 * @property SystemRight[] $rights
 *
 */
class SystemRole extends SystemRoleBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'color', 'description', 'is_active'], 'required'],
            [['name', 'color'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1000],
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
            'name' => 'Name',
            'color' => 'Color',
            'description' => 'Description',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRights()
    {
        return $this->hasMany(SystemRight::className(), ['role_id' => 'id']);
    }
}