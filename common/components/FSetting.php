<?php

namespace common\components;

use common\models\User;
use Yii;

class FSetting
{
    //move to each model / module?
    public static function getActionOptions($table, $field)
    {
        $result = array(
            'icon' => "glyphicon glyphicon-file",
            'child' => array(),
        );
        if ($table == 'app_user') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }
        if ($table == 'testtool') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }
        if ($table == 'object_category') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }

        if ($table == 'blog_post') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }
        if ($table == 'blog_post') {
            if ($field == 'is_featured') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }

        if ($table == 'blog_comment') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }

        if ($table == 'book') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }

        if ($table == 'book') {
            if ($field == 'is_feature') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }

        if ($table == 'content-chapter') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }

        if ($table == 'content-comment') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }

        if ($table == 'game') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-check";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
            if ($field == 'is_fake') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }

        if ($table == 'game_menu') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-check";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
            if ($field == 'is_fake') {
                $result['icon'] = "glyphicon glyphicon-file";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }

        if ($table == 'game_banner') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-check";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
            if ($field == 'type') {
                $result['icon'] = "glyphicon glyphicon-check";
                $result['child'] = array(
                    'vertical' => 'Vertical',
                    'horizontal' => 'Horizontal'
                );
            }
        }

        if ($table == 'sample') {
            if ($field == 'is_active') {
                $result['icon'] = "glyphicon glyphicon-check";
                $result['child'] = array(
                    1 => 'Active',
                    0 => 'Inactive'
                );
            }
        }

        return $result;
    }

    public static function getStatusLabel($status)
    {
        $key = $status;
        $display = ucwords($key);
        $str = array(
            FConstant::LABEL_ACTIVE => '<span class="label label-sm label-success">' . Yii::t('common', $display) . '</span>',
            FConstant::LABEL_INACTIVE => '<span class="label label-sm label-default">' . Yii::t('common', $display) . '</span>',
            FConstant::LABEL_NEW => '<span class="label label-sm label-success">' . Yii::t('common', $display) . '</span>',
            FConstant::LABEL_NORMAL => '<span class="label label-sm label-default">' . Yii::t('common', $display) . '</span>',
            FConstant::LABEL_PREMIUM => '<span class="label label-sm label-warning">' . Yii::t('common', $display) . '</span>',
            FConstant::LABEL_OLD => '<span class="label label-sm label-default">' . Yii::t('common', $display) . '</span>',
            User::STATUS_ACTIVE => '<span class="label label-sm label-success">' . Yii::t('common', 'Active') . '</span>',
            User::STATUS_DELETED => '<span class="label label-sm label-danger">' . Yii::t('common', 'Inactive') . '</span>',
        );
        $default = '<span class="label label-sm label-info">' . Yii::t('common', $key) . '</span>';
        return isset($str[$key]) ? $str[$key] : $default;
    }

    public static function getTypeLabel($status)
    {
        $key = $status;
        $display = ucwords($key);
        $str = array(
            FConstant::LABEL_ACTIVE => '<span class="label label-sm label-success">' . Yii::t('common', $display) . '</span>',
        );
        $default = '<span class="label label-sm label-info">' . Yii::t('common', $key) . '</span>';
        return isset($str[$key]) ? $str[$key] : $default;
    }

    public static function getRoleLabel($status)
    {
        $key = $status;
        $str = array(
            User::ROLE_MODERATOR => '<span class="label label-sm label-warning">' . Yii::t('common', 'Moderator') . '</span>',
            User::ROLE_ADMIN => '<span class="label label-sm label-danger">' . Yii::t('common', 'Admin') . '</span>',
            User::ROLE_USER => '<span class="label label-sm label-info">' . Yii::t('common', 'User') . '</span>',
        );

        $default = '<span class="label label-sm label-info">' . Yii::t('common', $key) . '</span>';
        return isset($str[$key]) ? $str[$key] : $default;
    }

    public static function getColorLabel($color)
    {
        return '<span class="label label-sm" style="background: ' . $color . '">' . $color . '</span>';
    }
}