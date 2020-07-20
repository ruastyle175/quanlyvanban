<?php

namespace backend\modules\app\models;

use yii\base\Model;

class NotificationForm extends Model
{
    public $message;
    public $title;
    public $link;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            [['message', 'title'], 'required'],
            [['message', 'title', 'link'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'message' => 'Message',
            'title' => 'Title',
            'link' => 'Link'
        );
    }
}