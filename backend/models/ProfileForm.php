<?php

namespace backend\models;

use yii\base\Model;

/**
 * @property string $name
 * @property string $overview
 * @property string $image_file
 * @property string $image_file_crop
 */
class ProfileForm extends Model
{

    public $name;
    public $overview;
    public $image_file;
    public $image_file_crop;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['overview'], 'string', 'max' => 2000],
            [['image_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, gif, png, jpeg'],
            [['image_file_crop'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'overview' => 'Overview',
            'image_file' => 'Image File',
        ];
    }
}