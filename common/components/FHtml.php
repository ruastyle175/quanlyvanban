<?php

namespace common\components;

use backend\modules\system\models\SystemSetting;
use himiklab\thumbnail\EasyThumbnailImage;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;

class FHtml
{
    const
        CHANGE_TYPE = 'change',
        CLEAR_TYPE = 'clear',
        FILL_TYPE = 'fill',
        SUBMIT_TYPE = 'submit';
    const
        BUTTON_CREATE = 'create',
        BUTTON_UPDATE = 'update',
        BUTTON_DELETE = 'delete',
        BUTTON_PROCESS = 'processing',
        BUTTON_PENDING = 'pending',
        BUTTON_RESET = 'reset',
        BUTTON_SEARCH = 'search',
        BUTTON_EDIT = 'edit',
        BUTTON_CHANGE = 'change',
        BUTTON_CANCEL = 'cancel',
        BUTTON_DOWNLOAD = 'download',
        BUTTON_ADD = 'add',
        BUTTON_REMOVE = 'remove',
        BUTTON_SELECT = 'select',
        BUTTON_MOVE = 'move',
        BUTTON_RELOAD = 'reload',
        BUTTON_OK = 'ok',
        BUTTON_COPY = 'copy',
        BUTTON_ACCEPT = 'accept',
        BUTTON_REJECT = 'reject',
        BUTTON_APPROVE = 'approve',
        BUTTON_APPROVED = 'approved',
        BUTTON_BACK = 'back',
        BUTTON_READ = 'read',
        BUTTON_UNREAD = 'unread',
        BUTTON_CONFIRM = 'confirm',
        BUTTON_COMPLETE = 'complete',
        BUTTON_REVERT = 'revert',
        BUTTON_CLOSE = 'close',
        BUTTON_SEND = 'send';

    private static $buttonIcons = array(
        self::BUTTON_CREATE => 'fa fa-plus',
        self::BUTTON_SEARCH => 'fa fa-search',
        self::BUTTON_APPROVE => 'fa fa-check',
        self::BUTTON_UPDATE => 'fa fa-save',
        self::BUTTON_DELETE => 'fa fa-trash',
        self::BUTTON_RESET => 'fa fa-refresh',
        self::BUTTON_EDIT => 'fa fa-pencil',
        self::BUTTON_CANCEL => 'fa fa-cancel',
        self::BUTTON_COPY => 'fa fa-copy',
        self::BUTTON_ADD => 'fa fa-plus',
        self::BUTTON_REMOVE => 'fa fa-trash',
        self::BUTTON_SELECT => 'fa fa-share',
        self::BUTTON_MOVE => 'fa fa-move',
        self::BUTTON_OK => 'fa fa-ok',
        self::BUTTON_ACCEPT => 'fa fa-plus',
        self::BUTTON_REJECT => 'fa fa-lock',
        self::BUTTON_APPROVED => 'fa fa-ok-sign',
        self::BUTTON_BACK => 'fa fa-arrow-left',
        self::BUTTON_READ => 'fa fa-bookmark',
        self::BUTTON_UNREAD => 'fa fa-bookmark',
        self::BUTTON_CONFIRM => 'fa fa-signin',
        self::BUTTON_COMPLETE => 'fa fa-remove',
        self::BUTTON_REVERT => 'fa fa-share',
        self::BUTTON_SEND => 'm-fa fa-swapright',
        self::BUTTON_PROCESS => 'fa fa-play',
        self::BUTTON_PENDING => 'fa fa-pause',
    );

    public static function showBoolean($value)
    {
        if ($value === 1) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public static function button($type, $style, $htmlOptions = array(), $isEditable = TRUE)
    {
        if (empty($type) || empty($style) || !array_key_exists($style, self::$buttonIcons))
            return self::showEmpty();
        if (isset($htmlOptions['class']))
            $htmlOptions['class'] = $htmlOptions['class'] . ' btn btn-' . $style;
        else
            $htmlOptions['class'] = 'btn btn-' . $style;
        if (!$isEditable)
            $htmlOptions['class'] .= ' disabled';
        $html = '<button type="' . $type . '" ' . self::renderAttributes($htmlOptions) . '>';
        $html .= '  <i class="' . self::$buttonIcons[$style] . '"></i>';
        if (isset($htmlOptions['value'])) {
            $html .= '  ' . $htmlOptions['value'];
        } else {
            $html .= '  ' . self::buttonValue($style);
        }
        $html .= '</button>';
        return $html;
    }

    public static function showEmpty()
    {
        $str = '<span style=" font-style: italic" class="text muted">' . Yii::t('common', 'Empty') . '</span>';
        return $str;
    }

    public static function showEmptyResult()
    {
        $str = '<span style=" font-style: italic" class="text muted">' . Yii::t('common', 'No result') . '</span>';
        return $str;
    }

    public static function renderAttributes($attributes = array())
    {
        $html = "";
        foreach ($attributes as $key => $value) {
            $html .= ' ' . $key . '="' . $value . '" ';
        }
        return $html;
    }

    private static function buttonValue($style)
    {
        $lib = array(
            self::BUTTON_CREATE => Yii::t('common', 'Create'),
            self::BUTTON_UPDATE => Yii::t('common', 'Update'),
            self::BUTTON_DELETE => Yii::t('common', 'Delete'),
            self::BUTTON_PROCESS => Yii::t('common', 'Processing'),
            self::BUTTON_PENDING => Yii::t('common', 'Pending'),
            self::BUTTON_RESET => Yii::t('common', 'Reset'),
            self::BUTTON_SEARCH => Yii::t('common', 'Search'),
            self::BUTTON_EDIT => Yii::t('common', 'Edit'),
            self::BUTTON_CHANGE => Yii::t('common', 'Change'),
            self::BUTTON_CANCEL => Yii::t('common', 'Cancel'),
            self::BUTTON_DOWNLOAD => Yii::t('common', 'Download'),
            self::BUTTON_COPY => Yii::t('common', 'Copy'),
            self::BUTTON_ADD => Yii::t('common', 'Add'),
            self::BUTTON_REMOVE => Yii::t('common', 'Remove'),
            self::BUTTON_SELECT => Yii::t('common', 'Select'),
            self::BUTTON_MOVE => Yii::t('common', 'Move'),
            self::BUTTON_OK => Yii::t('common', 'Ok'),
            self::BUTTON_ACCEPT => Yii::t('common', 'Accept'),
            self::BUTTON_BACK => Yii::t('common', 'Back'),
            self::BUTTON_SEND => Yii::t('common', 'Send'),
            self::BUTTON_REJECT => Yii::t('common', 'Reject'),
            self::BUTTON_READ => Yii::t('common', 'Read'),
            self::BUTTON_UNREAD => Yii::t('common', 'Unread'),
            self::BUTTON_CONFIRM => Yii::t('common', 'Confirm'),
            self::BUTTON_COMPLETE => Yii::t('common', 'Complete'),
            self::BUTTON_REVERT => Yii::t('common', 'Revert'),
            self::BUTTON_CLOSE => Yii::t('common', 'Close'),
            self::BUTTON_APPROVED => Yii::t('common', 'Approved'),

        );
        return $lib[$style];
    }

    public static function dynamicButton($type, $style, $text, $htmlOptions = array())
    {
        if (empty($type) || empty($style) || !array_key_exists($style, self::$buttonIcons))
            return self::showEmpty();
        if (isset($htmlOptions['class']))
            $htmlOptions['class'] = $htmlOptions['class'] . ' btn btn-' . $style;
        else
            $htmlOptions['class'] = 'btn btn-' . $style;
        $html = '<button type="' . $type . '" ' . self::renderAttributes($htmlOptions) . '>';
        $html .= '  <i class="' . self::$buttonIcons[$style] . '"></i>';
        $html .= '  ' . $text;
        $html .= '</button>';
        return $html;
    }

    public static function buttonSubmit($style, $htmlOptions = array(), $isSmall = FALSE, $isEditable = TRUE, $isShowtext = TRUE)
    {
        $type = self::SUBMIT_TYPE;
        if (empty($type) || empty($style) || !array_key_exists($style, self::$buttonIcons))
            return "";
        if (isset($htmlOptions['class']))
            $htmlOptions['class'] = $htmlOptions['class'] . ' btn btn-' . $style;
        else
            $htmlOptions['class'] = 'btn btn-' . $style;
        if ($isSmall)
            $htmlOptions['class'] .= ' mini';
        if (!$isEditable)
            $htmlOptions['class'] .= ' disabled';
        $html = '<button type="' . $type . '" ' . self::renderAttributes($htmlOptions) . '>';
        $html .= '  <i class="' . self::$buttonIcons[$style] . '"></i>';
        if ($isShowtext)
            $html .= '  ' . self::buttonValue($style);
        $html .= '</button>';
        return $html;
    }

    public static function showLink($text = '', $htmlOptions = array(), $icon = '')
    {
        $html = '<a ' . self::renderAttributes($htmlOptions) . '>';
        if (!empty($icon))
            $html .= '<i class="' . $icon . '"></i> ';
        $html .= $text;
        $html .= '</a>';
        return $html;
    }

    public static function showColor($hex)
    {
        $html = '<span class="label label-sm" style="background: ' . $hex . '">' . $hex . '</span>';
        return $html;
    }

    /**
     * @param $data mixed
     * @return string
     */
    public static function showLabel($data)
    {
        $html = '';
        if (is_array($data)) {
            foreach ($data as $item) {
                $hex =  FHelper::randHexColor();
                $html = '<span class="label label-sm" style="background: ' . $hex . '">' . $item->name . '</span>';
            }
        }
        return $html;
    }

    public static function showImage($image = false, $size = false, $model_dir = false)
    {
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            $src = $image;
        } else {
            if ($image === false) {
                if (!$size) {
                    $src = 'http://www.placehold.it/300x300/EFEFEF/AAAAAA?text=no+image';
                } else {
                    $src = 'http://www.placehold.it/' . $size . 'x' . $size . '/EFEFEF/AAAAAA?text=no+image';
                }
            } else {
                $path = Yii::getAlias('@' . UPLOAD_DIR) . DS;
                $path .= $model_dir . DS;
                $path .= $image;
                if (!file_exists($path)) {
                    if ($size == false) {
                        $src = 'http://www.placehold.it/300x300/EFEFEF/AAAAAA?text=no+image';
                    } else {
                        $src = 'http://www.placehold.it/' . $size . 'x' . $size . '/EFEFEF/AAAAAA?text=no+image';
                    }
                } else {
                    $src = Yii::$app->request->baseUrl . '/' . UPLOAD_DIR . '/' . $model_dir . '/' . $image;
                    return Html::img($src, ['width' => $size]);
                }
            }
        }

        return Html::img($src);
    }

    public static function showImageThumbnail($image, $size = false, $model_dir = false)
    {
        if (!$size) {
            $size = 100;
        }
        if (!$model_dir) {
            $model_dir = "www";
        }
        $baseUpload = Yii::getAlias('@' . UPLOAD_DIR);
        if (strlen($image) > 0) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $imagePath = $baseUpload . DS . $model_dir . DS . $image;
                if (is_file($imagePath)) {
                    return EasyThumbnailImage::thumbnailImg(
                        $imagePath,
                        $size,
                        $size,
                        EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                        ['alt' => $image]);
                } else {
                    $url = Yii::$app->request->baseUrl . '/' . UPLOAD_DIR . '/' . WWW_DIR . '/' . 'no_image.jpg';
                    return Html::img($url, ['width' => $size]);
                }
            } else {
                $imageLink = $image;
                return Html::img($imageLink, ['width' => $size]);
            }
        } else {
            $url = Yii::$app->request->baseUrl . '/' . UPLOAD_DIR . '/' . WWW_DIR . '/' . 'no_image.jpg';
            return Html::img($url, ['width' => $size]);
        }
    }

    public static function showTime($time)
    {
        if (strlen($time) != 0) {
            return date('g:i A', strtotime($time));
        } else
            return $time;
    }

    public static function showDateTime($time)
    {
        $lang = Yii::$app->language;
        if ($lang == "vi") {
            $time_format = "d-m-Y H:i:s";
        } else {
            $time_format = 'Y-m d H:i:s';
        }
        if (!empty($time)) {
            if (is_numeric($time)) {
                return date($time_format, $time);
            } else {
                return date($time_format, strtotime($time));
            }
        } else {
            return '';
        }
    }

    public static function showPrice($price, $lang = false)
    {
        if (!$lang) {
            $lang = Yii::$app->language;
        }
        if ($lang == 'vi') {
            $currency = '₫';
            return $price . $currency;
        } else {
            $currency = "$";
            return $currency . $price;
        }
    }

    public static function showIsActiveLabel($key)
    {
        $str = array(
            1 => '<span class="label label-sm label-success">' . Yii::t('common', "Yes") . '</span>',
            0 => '<span class="label label-sm label-danger">' . Yii::t('common', "No") . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : $key;
    }

    public static function buildBulkActionsMenu($action, $label, $table, $field)
    {
        if (strlen($table) != 0) {
            $option = FSetting::getActionOptions($table, $field);
            if (count($option['child']) != 0) { //data found
                $child = array();
                foreach ($option['child'] as $id => $name) {
                    $child[] = '<li>' . Html::a($name,
                            ["bulk-action", "action" => $action, "field" => $field, "value" => $id],
                            [
                                'role' => 'modal-remote-bulk',
                                'data-confirm' => false,
                                'data-method' => false,
                                'data-request-method' => 'post',
                                'data-confirm-title' => Yii::t('common', 'Are you sure?'),
                                'data-confirm-message' => Yii::t('common', 'Please confirm this action'),
                            ]) . '</li>';
                }
                $result = ['label' => '<i class="' . $option['icon'] . '"></i> ' . $label, 'items' => $child, 'encode' => false];
            } else { //no data found
                $result = '<li>' . Html::a('<i class="' . $option['icon'] . '"></i> ' . $label,
                        ["bulk-action", "action" => $action, "field" => $field],
                        [
                            'role' => 'modal-remote-bulk',
                            'data-confirm' => false,
                            'data-method' => false,
                            'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('common', 'Are you sure?'),
                            'data-confirm-message' => Yii::t('common', 'Please confirm this action'),
                        ]) . '</li>';
            }
        } else { //table = false or ''
            if ($action == FHtml::CLEAR_TYPE) {
                $icon = 'glyphicon glyphicon-remove-sign';
            } elseif ($action == FHtml::FILL_TYPE) {
                $icon = 'glyphicon glyphicon-random';
            } else {
                $icon = 'glyphicon glyphicon-file';
            }
            $result = '<li>' . Html::a('<i class="' . $icon . '"></i> ' . $label,
                    ["bulk-action", "action" => $action, "field" => $field],
                    [
                        'role' => 'modal-remote-bulk',
                        'data-confirm' => false,
                        'data-method' => false,
                        'data-request-method' => 'post',
                        'data-confirm-title' => Yii::t('common', 'Are you sure?'),
                        'data-confirm-message' => Yii::t('common', 'Please confirm this action'),
                    ]) . '</li>';
        }

        return $result;
    }

    public static function buildBulkDeleteMenu()
    {
        return '<li>' . Html::a('<i class="glyphicon glyphicon-trash"></i> ' . Yii::t('common', 'Delete All'),
                ["bulk-delete"],
                [
                    'role' => 'modal-remote-bulk',
                    'data-confirm' => false,
                    'data-method' => false,
                    'data-request-method' => 'post',
                    'data-confirm-title' => Yii::t('common', 'Are you sure?'),
                    'data-confirm-message' => Yii::t('common', 'Please confirm this action'),
                ]) . '</li>';
    }

    //Will be removed
    public static function config($key, $default_value)
    {
        $cache = Yii::$app->cache;
        $timeout = 3600 * 24 * 30;

        //$cache->flush();

        $result = $cache->getOrSet($key, function ($cache) use ($key) {
            $configure_setting = SystemSetting::getSettingValueByKey($key);
            $value = $configure_setting[$key];
            return $value;
        }, $timeout);

        /*$cache_data = $cache->get($key);
        if(!$cache_data){
            $result_setting = SystemSetting::getSettingValueByKey($key);
            $result = $configure_setting[$key];
            $cache->set($key, $result, $timeout);
        } else {
            $result = $cache_data;
        }*/

        if (strlen($result) == 0) {
            $result = $default_value;
        }
        return $result;
    }

    //Will be removed
    public static function getConfig($key, $default_value)
    {
        return FHtml::config($key, $default_value);
    }

    //Will be removed
    public static function configLayout($key, $default_value)
    {
        $cache = Yii::$app->cache;
        $timeout = 3600 * 24 * 30;
        //$cache->flush();

        $constant_key = FConstant::LAYOUT_CONFIGURATION;
        $layout_configuration = $cache->getOrSet($constant_key, function ($cache) use ($constant_key) {
            $configure_setting = SystemSetting::getSettingValueByKey($constant_key);
            $value = $configure_setting[$constant_key];
            return $value;
        }, $timeout);

        if (strlen($layout_configuration) != 0) {
            $array = Json::decode($layout_configuration);
            if (is_array($array) && isset($array[$key])) {
                $result = $array[$key];
            } else {
                $result = $default_value;
            }
        } else {
            $result = $default_value;
        }
        return $result;
    }

    //Will be removed
    public static function configFrontendLayout($key, $default_value)
    {
        $cache = Yii::$app->cache;
        $timeout = 3600 * 24 * 30;
        //$cache->flush();

        $constant_key = FConstant::FRONTEND_LAYOUT_CONFIGURATION;
        $layout_configuration = $cache->getOrSet($constant_key, function ($cache) use ($constant_key) {
            $configure_setting = SystemSetting::getSettingValueByKey($constant_key);
            $value = $configure_setting[$constant_key];
            return $value;
        }, $timeout);

        if (strlen($layout_configuration) != 0) {
            $array = Json::decode($layout_configuration);
            if (is_array($array) && isset($array[$key])) {
                $result = $array[$key];
            } else {
                $result = $default_value;
            }
        } else {
            $result = $default_value;
        }
        return $result;
    }

    //Will be removed
    public static function getFrontendLayoutConfiguration($key)
    {
        $constant_key = FConstant::FRONTEND_LAYOUT_CONFIGURATION;
        $configure_setting = SystemSetting::getSettingValueByKey($constant_key);
        $layout_configuration = $configure_setting[$constant_key];
        if (strlen($layout_configuration) != 0) {
            $array = Json::decode($layout_configuration);
            if (is_array($array) && isset($array[$key])) {
                $result = $array[$key];
            } else {
                $result = '';
            }
        } else {
            $result = '';
        }
        return $result;
    }

    //Will be removed
    public static function setFrontendLayoutConfiguration($key, $value)
    {
        if (strlen($key) != 0 && strlen($value) != 0) {
            $constant_key = FConstant::FRONTEND_LAYOUT_CONFIGURATION;
            $configure_setting = SystemSetting::getSettingValueByKey($constant_key);
            $current = $configure_setting[$constant_key];
            $array = Json::decode($current);
            $array[$key] = $value;
            $result = Json::encode($array);

            SystemSetting::setSettingValueByKey($constant_key, $result);

            $cache = Yii::$app->cache;
            $cache->set($constant_key, $result, 3600 * 24 * 30);
        }
    }


}