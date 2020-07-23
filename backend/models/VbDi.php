<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 *
 * @property string $file_dinhkem_file
 */
class VbDi extends VbDiBase
{
    public $file_dinhkem_file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nhom_vanban', 'so_hieu', 'id_loai_vanban'], 'required'],
            [['id_nhom_vanban', 'id_loai_vanban', 'id_nguoiki'], 'integer'],
            [['noidung_vanban'], 'string'],
            [['thoigian_banhanh', 'created_at', 'updated_at'], 'safe'],
            [['so_hieu', 'noi_nhan', 'file_dinhkem'], 'string', 'max' => 255],
            [['del_flg'], 'string', 'max' => 1],
            [['file_dinhkem_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, epub, doc, docx, xls, xlsx, jpg, png, gif, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('VbDen', 'ID'),
            'id_nhom_vanban' => Yii::t('VbDen', 'Nhóm văn bản'),
            'so_hieu' => Yii::t('VbDen', 'Số hiệu'),
            'id_loai_vanban' => Yii::t('VbDen', 'Loại văn bản'),
            'noidung_vanban' => Yii::t('VbDen', 'Nội dung'),
            'thoigian_banhanh' => Yii::t('VbDen', 'Thời gian ban hành'),
            'noi_nhan' => Yii::t('VbDen', 'Nơi nhận'),
            'id_nguoiki' => Yii::t('VbDen', 'Người kí'),
            'file_dinhkem' => Yii::t('VbDen', 'Văn bản đính kèm'),
            'created_at' => Yii::t('VbDen', 'Created At'),
            'updated_at' => Yii::t('VbDen', 'Updated At'),
            'del_flg' => Yii::t('VbDen', 'Đã xóa'),
            'file_dinhkem_file' => Yii::t('VbDen', 'Văn bản đính kèm'),
        ];
    }

    public static function lookupData($table_name, $key, $value)
    {
        $result = array();
        $objects = array();
        if ($table_name == "m_nhom_vb") {
            $objects = MNhomVb::find()->all();
        }
        if ($table_name == "m_loai_vb") {
            $objects = MLoaiVb::find()->all();
        }
        if ($table_name == "m_nguoi_ky") {
            $objects = MNguoiKy::find()->all();
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
        if ($table_name == "m_nhom_vb") {
            $object = MNhomVb::find()->where($condition)->one();
        }
        if ($table_name == "m_loai_vb") {
            $object = MLoaiVb::find()->where($condition)->one();
        }
        if ($table_name == "m_nguoi_ky") {
            $object = MNguoiKy::find()->where($condition)->one();
        }
        return isset($object) ? $object->{$needle} : "";
    }
}