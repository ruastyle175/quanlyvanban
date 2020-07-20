<?php

namespace backend\modules\app\models;


/**
 * @property string $id
 * @property integer $user_id
 * @property string $meta_key
 * @property string $meta_value
 * @property integer $last_update
 */
class AppMetaBase extends \yii\db\ActiveRecord
{

    public $tableName = 'app_meta';
    public $uploadFolder = 'app-meta';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_meta';
    }

}