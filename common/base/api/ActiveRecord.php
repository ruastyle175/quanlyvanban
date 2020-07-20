<?php

namespace common\base\api;


use common\components\FHelper;
use Yii;

class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @return ActiveRecord|object
     * @throws \yii\base\InvalidConfigException
     */
    public static function getInstance()
    {
        return Yii::createObject(['class' => get_called_class()]);
    }

    public function fields()
    {
        $fields = parent::fields();
        $request_fields = $this->requestFields();
        if (!empty($request_fields)) {
            $fields = $request_fields;
        } else {
            $api_fields = $this->apiFields();
            if (!empty($api_fields)) {
                $fields = $api_fields;
            }
        }
        return $fields;
    }

    /**
     * @return array
     */
    public function requestFields()
    {
        $fields = [];
        $field_params = FHelper::getRequestParam(['fields', 'columns'], '');
        if (strlen($field_params) != 0) {
            $array_fields = explode(',', $field_params);
            if (is_array($array_fields)) {
                $fields = $array_fields;
            }
        }
        return $fields;
    }


    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function apiFields()
    {
        $fields = [];
        $schema = static::getTableSchema();
        if (isset($schema)) {
            $fields = array_keys($schema->columns);
        }
        return $fields;
    }
}
