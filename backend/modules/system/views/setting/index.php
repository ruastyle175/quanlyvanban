<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Settings';
$this->params['breadcrumbs'][] = 'Settings';
$this->params['mainIcon'] = 'glyphicon glyphicon-cog';

/* @var $model \backend\modules\system\models\SettingForm */
?>

<div class="portlet light bordered">
    <div class="portlet-title tabbable-line">
        <div class="caption font-dark">
            <span class="caption-subject bold uppercase"><i class="<?php echo $this->params['mainIcon'] ?>"></i> <?= $this->title ?></span>
            <span class="caption-helper">Update your settings</span>
        </div>
        <div class="tools">
            <a href="#" class="collapse"></a>
            <a class="fullscreen" href="#"></a>
        </div>
        <div class="actions">
        </div>
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_1_1" data-toggle="tab"><?= 'System Settings' ?></a>
            </li>
            <li>
                <a href="#tab_1_2" data-toggle="tab"><?= 'Application Settings' ?></a>
            </li>
            <?php /*
            <li>
                <a href="#tab_1_3" data-toggle="tab"><?= 'Frontend Settings' ?></a>
            </li>
            */ ?>
        </ul>
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
                <div class="tab-content">
                    <div class="tab-pane active row" id="tab_1_1">
                        <div class="col-md-12">

                            <?= $form->field($model, 'admin_email') ?>
                            <?= $form->field($model, 'support_email') ?>
                            <?= $form->field($model, 'api_key') ?>
                            <?= $form->field($model, 'map_api_key') ?>
                            <?php //= $form->field($model, 'pem')->fileInput()->hint('Old pem: ' . $model->pem) ?>

                            <?= $form->field($model, 'access_control_mode')->dropDownList([
                                'self::MODE_ROLE_BAC' => 'Role Base Access Control',
                                'self::MODE_RIGHT_BAC' => 'Right Base Access Control',
                            ]) ?>
                        </div>
                    </div>
                    <div class="tab-pane row" id="tab_1_2">
                        <div class="col-md-12">
                            <?= $form->field($model, 'company_name') ?>
                            <?= $form->field($model, 'company_description') ?>
                            <?= $form->field($model, 'company_homepage') ?>
                        </div>
                    </div>
                    <?php /*
                    <div class="tab-pane row" id="tab_1_3">
                        <div class="col-md-12">
                            <?= $form->field($model, 'frontend_theme')->dropDownList([
                                \common\components\FConstant::FRONTEND_THEME_AHA => 'A-ha Shop',
                                \common\components\FConstant::FRONTEND_THEME_ZORKA => 'Zorka Fashion'
                            ]) ?>
                        </div>
                    </div>
                    */ ?>
                </div>
            </div>
            <div class="form-actions">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>