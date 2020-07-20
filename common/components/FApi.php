<?php
/**
 * Created by PhpStorm.
 * User: Darkness
 * Date: 11/30/2016
 * Time: 2:00 PM
 */

namespace common\components;

use Imagine\Image\Box;
use Yii;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\imagine\Image;

class FApi
{
    public static $imageExtension = array('jpg', 'png', 'gif');

    public static function getOutputForAPI($data, $status = '', $message = '', $others = array())
    {

        $out = array();
        $out['status'] = $status;
        $out['data'] = $data;
        foreach ($others as $key => $value) {
            $out[$key] = $value;
        }
        $out['message'] = $message;

        return $out;
    }

    public static function getErrorMessage($errors)
    {
        $error_message = 'FAIL';
        $error_array = array();
        foreach ($errors as $field => $messages) {
            foreach ($messages as $message) {
                $error_array[] = $message;
            }
        }
        if (count($error_array) != 0) {
            $error_message = implode('. ', $error_array);
        }
        return $error_message;
    }

    public static function getErrorMsg($code)
    {
        $str = array(
            200 => 'Success',
            201 => 'Fail',
            202 =>  FConstant::MISSING_PARAMS,
            203 =>  FConstant::MISMATCH_PARAMS,
            204 => 'Token missing',
            205 =>  FConstant::TOKEN_MISMATCH,
            206 =>  FConstant::CAN_NOT_PERFORM,
            207 => 'Internal server error',
            208 => 'Data not found',
            221 => 'User not found',
            222 => 'Wrong password',
            223 => 'Email does not exist',
            224 => 'Email or username does not exist',
            225 => 'Email existed',
            226 => 'Email or username existed',
            227 => 'Current password mismatch',
            228 => 'Your account is not activated',
            229 => 'Fail to send email, please check your email address',
            230 => 'Your account balance is not enough to do this action',
            233 => 'Please login by your social network account and change password',
            234 => 'Current password and new password are the same',
            240 => 'Your request is in processing, please wait',
        );
        if ($code == 'all')
            return $str;
        else
            return isset($str[$code]) ? $str[$code] : '';
    }

    public static function getImageUrlForAPI($image, $folder, $mode = "render") { //mode: render / direct

        if (filter_var($image, FILTER_VALIDATE_URL)) {
            $image_url = $image;
        } else {
            if ($mode == 'render') {
                $image_url = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f' => $image, 'd' => $folder, 's' => '', 't' => 'image']);
            } else {
                $image_url = FFile::getImageUrl($image, $folder);
            }
        }
        return $image_url;
    }

    public static function getFileURLForAPI($file, $folder = '', $mode = "render") //mode: render / direct
    {
        if (filter_var($file, FILTER_VALIDATE_URL)) {
            $file_url = $file;
        } else {
            $file_url = FFile::getFileURL($file, $folder);
            if (strlen($file_url) != 0) {
                if ($mode == "render") {
                    $file_url = Yii::$app->urlManager->createAbsoluteUrl(['api/file', 'f' => $file, 'd' => $folder, 's' => '', 't' => 'file']);
                }
            }
        }
        return $file_url;
    }

    public static function uploadFileAPI($file_upload, $save_path, $old_file = '') {
        $file_name = "";
        if (isset($_FILES[$file_upload])) {
            $ext        = pathinfo($_FILES[$file_upload]['name'], PATHINFO_EXTENSION);
            $now        = time();
            $imageName  = $now . $file_upload . "." . $ext;
            $image_path = $save_path . $imageName;
            $upload     = move_uploaded_file($_FILES[$file_upload]['tmp_name'], $image_path);
            if ($upload) {
                $file_name = $imageName;
                Image::getImagine()->open($image_path)->thumbnail(new Box(300, 300))->save($save_path . 'thumb' . $imageName, ['quality' => 100]);
            }
            else {
                if (strlen($old_file) != 0) {
                    $file_name = $old_file;
                }
            }
        }
        else {
            if (strlen($old_file) != 0) {
                $file_name = $old_file;
            }
        }

        return $file_name;
    }

    public static function deleteFileAPI($file_name, $save_path) {
        if (strlen($file_name) != 0) {
            if (is_file($save_path . '/' . $file_name)) {
                unlink($save_path . '/' . $file_name);
            }
            if (is_file($save_path . '/thumb' . $file_name)) {
                unlink($save_path . '/thumb' . $file_name);
            }
        }
    }

    public static function getObjectType ($className) {
        $id = Inflector::camel2id(str_replace("API", "", StringHelper::basename($className)));
        $lower_name = str_replace('-','_', $id);
        return $lower_name;
    }

    public static function beautyResponse($array)
    {
        $array = array_map(function ($v) {
            return (!is_null($v)) ? is_array($v) ? array_map(function ($v) {
                return (!is_null($v)) ? $v : "";
            }, $v) : $v : "";
        }, $array);
        return $array;
    }
}