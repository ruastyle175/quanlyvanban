<?php

/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */

use kartik\widgets\ActiveForm;
use yii\helpers\Html;


$this->title = 'Notification';
$this->params['breadcrumbs'][] = $this->title;
$this->params['mainIcon'] = 'glyphicon glyphicon-cloud-upload';
?>
<div class="portlet light bordered">
    <div class="portlet-title tabbable-line">
        <div class="caption font-dark">
            <span class="caption-subject bold uppercase"><i
                        class="<?php echo $this->params['mainIcon'] ?>"></i> <?= $this->title ?></span>
            <span class="caption-helper">Push notification to users</span>
        </div>
        <div class="tools">
            <a href="#" class="collapse"></a>
            <a class="fullscreen" href="#"></a>
        </div>
        <div class="actions">
        </div>
    </div>
    <div class="portlet-body">
        <div class="portlet-body form">
            <?php
            $form = ActiveForm::begin([
                'id' => 'settings-form',
                'type' => $this->params['activeFormType'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
                'options' => ['class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data',
                ],
            ]) ?>

            <div class="form-body">
                <?= $form->field($model, 'title') ?>
                <?= $form->field($model, 'message')->textarea(['rows' => 4]) ?>
                <?= $form->field($model, 'link') ?>
            </div>
            <div class="form-actions">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>