<?php

namespace backend\modules\system\models;


/**
 * @property integer $id
 * @property string $language_code
 * @property string $language_name
 * @property integer $is_active
 */
class SystemLanguageBase extends \yii\db\ActiveRecord
{

    public $tableName = 'system_language';
    public $uploadFolder = 'system-language';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_language';
    }

}