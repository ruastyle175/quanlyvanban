<?php
/**
 * Created by PhpStorm.
 * User: Stephen PC
 * Date: 11/8/2017
 * Time: 3:51 PM
 */

use common\components\FHtml;
use common\components\FSetting;
use projectemplate\ptcrud\Helper;
use yii\widgets\DetailView;

/* @var $model_dir string */
/* @var $preset string */

$attributes = array();

$model_attributes = $model->attributes;

$image_fields = array(
    'thumbnail',
    'image',
    'icon',
    'logo',
    'avatar',
    'cover',
    'photo'
);

$date_fields = array(
    'created_at',
    'updated_at',
    'created_date',
    'modified_date',
);

$hidden_fields = array(
    'application_id',
    'id',
    'password*',
    'auth_key',
);


foreach ($model_attributes as $key => $value) {

    if (in_array($key, $image_fields)) {
        $attributes[] = [
            'attribute' => $key,
            'value' => FHtml::showImageThumbnail($value, 100, $model_dir),
            'format' => 'html',
        ];
        continue;
    }

    if ($key == "role") {
        $attributes[] = [
            'attribute' => $key,
            'value' => FSetting::getRoleLabel($value),
            'format' => 'html',
        ];
        continue;
    }

    if ($key == "type") {
        $attributes[] = [
            'attribute' => $key,
            'value' => FSetting::getTypeLabel($value),
            'format' => 'html',
        ];
        continue;
    }

    if ($key == "status") {
        $attributes[] = [
            'attribute' => $key,
            'value' => FSetting::getStatusLabel($value),
            'format' => 'html',
        ];
        continue;
    }

    if ($key == "color") {
        $attributes[] = [
            'attribute' => $key,
            'value' => FSetting::getColorLabel($value),
            'format' => 'html',
        ];
        continue;
    }

    if (in_array($key, $date_fields)) {
        $attributes[] = [
            'attribute' => $key,
            'value' => is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value,
            'format' => 'html',
        ];
        continue;
    }

    if ($preset == "full") {
        if (!Helper::checkHiddenField($key, $hidden_fields)) {
            $attributes[] = $key;
        }
    }

}
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => $attributes,
    'template' => "<tr><th class='col-md-4'>{label}</th><td>{value}</td></tr>"
]) ?>


