<?php

namespace backend\models;

use common\base\api\ActiveRecord;
use common\components\FApi;
use common\components\FFile;
use Yii;

/**
 * @property integer $id
 * @property integer $id_nhom_vanban
 * @property string $so_hieu
 * @property integer $id_loai_vanban
 * @property string $noidung_vanban
 * @property string $thoigian_banhanh
 * @property string $noi_nhan
 * @property integer $id_nguoiki
 * @property string $file_dinhkem
 * @property string $created_at
 * @property string $updated_at
 * @property integer $del_flg
 */
class VbDiAPI extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vb_di';
    }

    public function fields()
    {
        $fields = parent::fields(); // TODO: Change the autogenerated stub
        $folder = FFile::getUploadFolderName($this::tableName());
        $file_dinhkem = FApi::getFileUrlForAPI($this->file_dinhkem, $folder);
        $this->file_dinhkem = $file_dinhkem;
        return $fields;
    }

    public function apiFields()
    {
        //$fields = parent::apiFields(); // TODO: Change the autogenerated stub
        $fields = [
            'id',
            'id_nhom_vanban',
            'so_hieu',
            'id_loai_vanban',
            'noidung_vanban',
            'thoigian_banhanh',
            'noi_nhan',
            'id_nguoiki',
            'file_dinhkem',
            'created_at',
            'updated_at',
            'del_flg'
        ];
        return $fields;
    }

    public function afterDelete()
    {
        //$id = $this->id;
        $uploadFolder = Yii::getAlias('@' . UPLOAD_DIR);
        $folder = FFile::getUploadFolderName($this::tableName());
        $file_dinhkem_old = $this->file_dinhkem;
        if (strlen($file_dinhkem_old) > 0) {
            if (is_file($uploadFolder . '/' . $folder . '/' . $file_dinhkem_old)) {
                unlink($uploadFolder . '/' . $folder . '/' . $file_dinhkem_old);
            }
        }
        parent::afterDelete(); // TODO: Change the autogenerated stub
    }
}