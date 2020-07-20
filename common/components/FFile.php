<?php

namespace common\components;

use Yii;
use yii\helpers\Inflector;
use yii\helpers\Url;

class FFile
{
    public static function getUploadFolderName($table)
    {
        return Inflector::camel2id($table);
    }

    /**
     * @param bool $folder
     * @return bool|string
     */
    public static function getUploadFolderPath($folder = false)
    {
        $path = Yii::getAlias('@' . UPLOAD_DIR);
        if ($folder && strlen($folder) != 0) {
            $path = $path . DS . $folder . DS;
        }
        return $path;
    }

    /**
     * @param $image
     * @param bool $model_dir
     * @param bool $position
     * @return string
     */
    public static function getImageUrl($image, $model_dir = false, $position = false)
    {
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        } else {

            $baseUpload = Yii::getAlias('@' . UPLOAD_DIR);

            if ($position != FRONTEND) {
                $base_url = Url::base(true);
                $image_path = is_file($baseUpload . DS . $model_dir . DS . $image) ? $base_url . '/' . UPLOAD_DIR . '/' . $model_dir . '/' . $image : $base_url . '/' . UPLOAD_DIR . '/' . WWW_DIR . '/' . FConstant::NO_IMAGE;
                return $image_path;
            } else {
                $base_url = \Yii::$app->urlManagerBackend->baseUrl;

                $image_path = $base_url . '/' . UPLOAD_DIR . '/' . $model_dir . '/' . $image;

                if (!is_file($baseUpload . DS . $model_dir . DS . $image)) {
                    $image_path = $base_url . '/' . UPLOAD_DIR . '/' . WWW_DIR . '/' . FConstant::NO_IMAGE;
                }

                return $image_path;
            }

        }
    }

    /**
     * @param $file
     * @param string $model_dir
     * @param string $default_type
     * @return string
     */
    public static function getImagePath($file, $model_dir = '', $default_type = 'png')
    {
        $baseUpload = Yii::getAlias('@' . UPLOAD_DIR);

        $path = $baseUpload . DS . $model_dir . DS . $file;

        if (is_file($path)) {
            $image_path = $path;
        } else {
            if ($default_type == 'jpg') {
                $image_path = $baseUpload . DS . WWW_DIR . DS . FConstant::NO_IMAGE_JPG;
            } else {
                $image_path = $baseUpload . DS . WWW_DIR . DS . FConstant::NO_IMAGE;
            }
        }
        return $image_path;
    }

    /**
     * @param $file
     * @param string $model_dir
     * @param bool $position
     * @param string $default_file
     * @return string
     */
    public static function getFileURL($file, $model_dir = '', $position = false, $default_file = '')
    {
        if ($position === false)
            $position = BACKEND;
        if (filter_var($file, FILTER_VALIDATE_URL)) {
            return $file;
        } else {
            $baseUpload = Yii::getAlias('@' . UPLOAD_DIR);
            if ($position != FRONTEND) {
                $base_url = Url::base(true);

                if (is_file($baseUpload . DS . $model_dir . DS . $file)) {
                    $image_path = $base_url . '/' . UPLOAD_DIR . '/' . $model_dir . '/' . $file;
                } else {
                    if (strlen($default_file) == 0) {
                        $image_path = '';
                    } else {
                        $image_path = $base_url . '/' . UPLOAD_DIR . '/' . WWW_DIR . '/' . $default_file;
                    }
                }
                return $image_path;

            } else {
                $base_url = \Yii::$app->urlManagerBackend->baseUrl;

                if (is_file($baseUpload . DS . $model_dir . DS . $file)) {
                    $image_path = $base_url . '/' . UPLOAD_DIR . '/' . $model_dir . '/' . $file;
                } else {
                    if (strlen($default_file) == 0) {
                        $image_path = '';
                    } else {
                        $image_path = $base_url . '/' . UPLOAD_DIR . '/' . WWW_DIR . '/' . $default_file;
                    }
                }
                return $image_path;
            }
        }
    }

    /**
     * @param $file
     * @param string $model_dir
     * @param string $default_file
     * @return string
     */
    public static function getFilePath($file, $model_dir = '', $default_file = '')
    {
        $baseUpload = Yii::getAlias('@' . UPLOAD_DIR);

        $path = $baseUpload . DS . $model_dir . DS . $file;

        if (is_file($path)) {
            $image_path = $path;
        } else {
            if ($default_file == '') { //render image
                $image_path = '';
            } else {
                $image_path = $baseUpload . DS . WWW_DIR . DS . $default_file;
            }
        }
        return $image_path;
    }

    public static function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!self::deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }

    public static function deleteNotNecessaryFiles($necessary_files, $folder)
    {
        if (!is_dir($folder)) {
            $uploadFolder = Yii::getAlias('@' . UPLOAD_DIR);
            $folder = $uploadFolder . DS . $folder . DS;

        }
        //Get a list of all of the file names in the folder.
        $files = glob($folder . '/*');

        //Loop through the file list.
        foreach ($files as $file) {
            //Make sure that this is a file and not a directory.
            if (is_file($file)) {
                //Use the unlink function to delete the file.
                if (!in_array(basename($file), $necessary_files))
                    unlink($file);
            }
        }
    }
}