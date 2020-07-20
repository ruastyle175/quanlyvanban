<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 */
class VbTrinh extends VbTrinhBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['noidung_vanban'], 'string'],
            [['thoigian_trinh', 'created_at', 'updated_at'], 'safe'],
            [['id_nguoi_nhan'], 'integer'],
            [['so_hieu', 'ghichu'], 'string', 'max' => 255],
            [['del_flg'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('VbDen', 'ID'),
            'so_hieu' => Yii::t('VbDen', 'So Hieu'),
            'noidung_vanban' => Yii::t('VbDen', 'Noidung Vanban'),
            'thoigian_trinh' => Yii::t('VbDen', 'Thoigian Trinh'),
            'id_nguoi_nhan' => Yii::t('VbDen', 'Id Nguoi Nhan'),
            'ghichu' => Yii::t('VbDen', 'Ghichu'),
            'created_at' => Yii::t('VbDen', 'Created At'),
            'updated_at' => Yii::t('VbDen', 'Updated At'),
            'del_flg' => Yii::t('VbDen', 'Del Flg'),
        ];
    }

    public static function lookupData($table_name, $key, $value)
    {
        $result = array();
        $objects = array();
        if ($table_name == "m_nguoi_nhan") {
            $objects = MNguoiNhan::find()->all();
        }
        if (count($objects) != 0) {
            $result = ArrayHelper::map($objects, $key, $value);
        }
        return $result;
    }

    public static function lookupLabel($table_name, $lookup_key, $lookup_value, $needle)
    {
        if (is_numeric($lookup_value)) {
            $condition = "$lookup_key = $lookup_value";
        } else {
            $condition = "$lookup_key = '$lookup_value'";
        }
        if ($table_name == "m_nguoi_nhan") {
            $object = MNguoiNhan::find()->where($condition)->one();
        }
        return isset($object) ? $object->{$needle} : "";
    }
}