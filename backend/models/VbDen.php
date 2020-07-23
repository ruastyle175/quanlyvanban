<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 */
class VbDen extends VbDenBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_donvi_gui', 'so_hieu', 'id_loai_vanban', 'id_trang_thai'], 'required'],
            [['id_donvi_gui', 'id_loai_vanban', 'id_lanh_dao', 'id_can_bo', 'id_trang_thai'], 'integer'],
            [['noidung_vanban'], 'string'],
            [['thoigian_banhanh', 'thoigian_nhan', 'thoigian_hoanthanh', 'created_at', 'updated_at'], 'safe'],
            [['so_hieu'], 'string', 'max' => 255],
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
            'id_donvi_gui' => Yii::t('VbDen', 'Đơn vị gửi'),
            'so_hieu' => Yii::t('VbDen', 'Số hiệu'),
            'id_loai_vanban' => Yii::t('VbDen', 'Loại văn bản'),
            'noidung_vanban' => Yii::t('VbDen', 'Nội dung'),
            'thoigian_banhanh' => Yii::t('VbDen', 'Thời gian ban hành'),
            'thoigian_nhan' => Yii::t('VbDen', 'Thời gian nhận'),
            'id_lanh_dao' => Yii::t('VbDen', 'Lãnh đạo'),
            'id_can_bo' => Yii::t('VbDen', 'Cán bộ'),
            'thoigian_hoanthanh' => Yii::t('VbDen', 'Thời gian hoàn thành'),
            'id_trang_thai' => Yii::t('VbDen', 'Trạng thái'),
            'created_at' => Yii::t('VbDen', 'Created At'),
            'updated_at' => Yii::t('VbDen', 'Updated At'),
            'del_flg' => Yii::t('VbDen', 'Đã xóa'),
        ];
    }

    public static function lookupData($table_name, $key, $value)
    {
        $result = array();
        $objects = array();
        if ($table_name == "m_don_vi_gui") {
            $objects = MDonViGui::find()->all();
        }
        if ($table_name == "m_loai_vb") {
            $objects = MLoaiVb::find()->all();
        }
        if ($table_name == "m_lanh_dao") {
            $objects = MLanhDao::find()->all();
        }
        if ($table_name == "m_can_bo") {
            $objects = MCanBo::find()->all();
        }
        if ($table_name == "m_trang_thai") {
            $objects = MTrangThai::find()->all();
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
        if ($table_name == "m_don_vi_gui") {
            $object = MDonViGui::find()->where($condition)->one();
        }
        if ($table_name == "m_loai_vb") {
            $object = MLoaiVb::find()->where($condition)->one();
        }
        if ($table_name == "m_lanh_dao") {
            $object = MLanhDao::find()->where($condition)->one();
        }
        if ($table_name == "m_can_bo") {
            $object = MCanBo::find()->where($condition)->one();
        }
        if ($table_name == "m_trang_thai") {
            $object = MTrangThai::find()->where($condition)->one();
        }
        return isset($object) ? $object->{$needle} : "";
    }
}