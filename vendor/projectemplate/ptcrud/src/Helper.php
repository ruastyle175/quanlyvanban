<?php
/**
 * Created by PhpStorm.
 * User: Quyen_Bui
 * Date: 7/12/2016
 * Time: 3:10 PM
 */

namespace projectemplate\ptcrud;

use common\components\FHelper;
use function GuzzleHttp\Psr7\str;
use yii\base\Controller;

class Helper extends Controller
{
    const
        LOOKUP_KEYWORD = 'LOOKUP:',
        DROPDOWN_KEYWORD = 'DROPDOWN:',
        DROPDOWN_NUMERIC_KEYWORD = 'DROPDOWN-NUMERIC:',
        FILE_KEYWORD = 'FILE:',
        COLOR_KEYWORD = 'COLOR:',
        RATING_KEYWORD = 'RATING:',
        COORDINATE_KEYWORD = 'COORDINATE:';


    const
        SIMPLE = 'simple',
        COMPLEX = 'complex';

    public static function hiddenFields() //Hiden fields backend
    {
        return array(
            'id',
            '*password',
            '*auth'
        );
    }

    public static function hiddenApiFields() //Hiden fields api model
    {
        return array(
            '*password',
            '*auth'
        );
    }

    public static function autoSetFields()
    {
        return array(
            'created_date',
            'modified_date',
            'created_at',
            'updated_at'
        );
    }

    public static function checkHiddenField($name, $array) //columns.php modelapi
    {
        foreach ($array as $item) {
            if (strpos($item, '*') === false) {
                if ($name == $item) {
                    return true;
                }
            } else {
                if (strpos($name, trim($item, '*')) !== false) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function keyword($string)
    {
        $keywords = array(
            self::LOOKUP_KEYWORD,
            self::DROPDOWN_KEYWORD,
            self::DROPDOWN_NUMERIC_KEYWORD,
            self::FILE_KEYWORD,
            self::COLOR_KEYWORD,
            self::COORDINATE_KEYWORD,
            self::RATING_KEYWORD
        );

        foreach ($keywords as $item) {
            if (strpos($string, $item) !== false) {
                return $item;
            }
        }
        return false;
    }

    /* @return string */
    public static function getContentAfterKeyword($text, $keyword)
    {
        $result = "";
        $position = strpos($text, $keyword);
        if ($position !== false) {
            $result = substr($text, $position + strlen($keyword), strlen($text));
        }
        return $result;
    }


    public static function dropdownDataFromDbComment($comment, $keyword)
    {
        $result = array();
        $content = self::getContentAfterKeyword($comment, $keyword); //Json or string
        if (strlen($content) != 0) {
            $data = json_decode($content, true);
            $selection = array();
            if (json_last_error() == JSON_ERROR_NONE) {
                //json array
                $type = "complex";
                if (is_array($data) && !empty($data)) {
                    if (FHelper::isSequentialArray($data)) { //Sequeltial array (simple with string as element or multi dimensional array with child array as element)
                        foreach ($data as $item) {
                            if (is_array($item)) {  // [{"key":"aaa","value":"AAA AAA"},{"key":"bbb","value":"BBB"},{"key":"ccc","value":"CCC"}] //multi dimensional
                                $selection[$item['key']] = $item['value'];
                            }
                            else { //["xxx","yyy","zzz"] //array require only value
                                $type = "simple";
                                $selection[] = $item;
                            }
                        }
                    } else { //{"xx":"X X","yy":"Y Yy"} //object require key & value
                        $selection = $data;
                    }
                }
                $result["type"] = $type;
                $result["data"] = $selection;
            } else {
                //string glue by | ; , only for string value
                $type = "simple";
                $split_string = '';
                if (strpos($content, "|") !== false) {
                    $split_string = "|";
                } elseif (strpos($content, ";") !== false) {
                    $split_string = ";";
                } elseif (strpos($content, ",") !== false) {
                    $split_string = ",";
                }
                if (strlen($split_string) != 0) {
                    $selection = explode($split_string, $content);
                    $result["type"] = $type;
                    $result["data"] = $selection;
                }
            }
        }
        return $result;
    }

    public static function dropdownNumericDataFromDbComment($comment, $keyword)
    {
        $result = array();
        $content = self::getContentAfterKeyword($comment, $keyword);
        if (strlen($content) != 0) {
            //string glue by | ; , only for string value
            $split_string = '';
            if (strpos($content, "|") !== false) {
                $split_string = "|";
            } elseif (strpos($content, ";") !== false) {
                $split_string = ";";
            } elseif (strpos($content, ",") !== false) {
                $split_string = ",";
            }
            if (strlen($split_string) != 0) {
                $data = explode($split_string, $content);
                $split_string_2 = "=";
                $selection = array();
                foreach ($data as $item) {
                    $option = explode($split_string_2, $item);
                    $data_item = array();
                    if (count($option) != 0) {
                        foreach ($option as $option_item) {
                            if(is_numeric($option_item)) {
                                $data_item['value'] = $option_item;
                            } else {
                                $data_item['name'] = $option_item;
                            }
                        }
                    }
                    $selection[] = $data_item;
                }
                $result["data"] = $selection;
            }
        }
        return $result;
    }

    public static function lookupDataFromDbComment($comment, $keyword)
    {
        $result = array();
        $content = self::getContentAfterKeyword($comment, $keyword); //String
        $data = explode("|", $content);
        $result["table"] = $data[0];
        $result["key"] = $data[1];
        $result["value"] = $data[2];
        return $result;
    }

    public static function coordinateDataFromDbComment($comment, $keyword)
    {
        $result = array();
        $content = self::getContentAfterKeyword($comment, $keyword); //Json
        if (strlen($content) != 0) {
            $data = json_decode($content, true);
            if (json_last_error() == JSON_ERROR_NONE) {
                $result = $data;
            }
        }
        return $result;
    }

    public static function fileDataFromDbComment($comment, $keyword)
    {
        $result = array();
        $content = self::getContentAfterKeyword($comment, $keyword); //Json
        if (strlen($content) != 0) {
            $data = json_decode($content, true);
            if (json_last_error() == JSON_ERROR_NONE) {
                $result = $data;
            }
        }
        return $result;
    }

    public static function ratingDataFromDbComment($comment, $keyword)
    {
        $result = array();
        $content = self::getContentAfterKeyword($comment, $keyword); //Json
        if (strlen($content) != 0) {
            $data = json_decode($content, true);
            if (json_last_error() == JSON_ERROR_NONE) {
                $result = $data;
            }
        }
        return $result;
    }

    public static function constantKey($field, $string)
    {
        $string = self::humanize2id($string);

        $result = strtoupper($field . "_" . $string);

        return $result;
    }

    public static function humanize2id($text)
    {
        return strtolower(str_replace([" ", "-"], "_", $text));
    }

    public static function humanize2key($text)
    {
        return strtolower(str_replace([" ", "_"], "-", $text));
    }
}