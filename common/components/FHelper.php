<?php

namespace common\components;

use Yii;

class FHelper
{
    /**
     * @param $param
     * @param string $default_value
     * @return mixed|string
     */
    public static function getRequestParam($param, $default_value = '')
    {
        if (is_array($param)) {
            foreach ($param as $item) {
                if (key_exists($item, $_REQUEST)) {
                    return $_REQUEST[$item];
                }
            }
            return $default_value;
        }
        if (key_exists($param, $_REQUEST)) {
            $result = $_REQUEST[$param];
        }
        return (isset($result)) ? $result : $default_value;
    }

    /**
     * @param $array array
     * @param $key
     * @return mixed|string
     */
    public static function getExistArrayValueByKey($key, $array)
    {
        $value = '';
        if (is_array($array)) {
            if (array_key_exists($key, $array)) {
                $value = $array[$key];
            }
        }
        return $value;
    }

    public static function getParamsValueByKey($params, $key)
    {
        $result = false;
        if (strlen($params) != 0) {
            $params_array = explode('&', $params);
            foreach ($params_array as $item) {
                $item_array = explode('=', $item);
                if ($key == $item_array[0]) {
                    $result = $item_array[1];
                }
            }
        }
        return $result;
    }

    public static function currentController()
    {
        return Yii::$app->controller->id;
    }

    public static function currentModule()
    {
        return Yii::$app->controller->module->id;
    }

    public static function currentAction()
    {
        return Yii::$app->controller->action->id;
    }

    public static function isSequentialArray(array $arr) {
        //https://stackoverflow.com/questions/173400/how-to-check-if-php-array-is-associative-or-sequential
        if (array() === $arr) return true;
        return array_keys($arr) === range(0, count($arr) - 1);
    }

    public static function randHexColor() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

}