<?php

use backend\components\widgets\detail\DetailView;
use bupy7\cropbox\CropboxWidget;
use kartik\file\FileInput;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $profile \backend\models\ProfileForm */
/* @var $model \backend\models\PasswordForm */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
$this->params['mainIcon'] = 'glyphicon glyphicon-cog';

?>

<div class="portlet light bordered">
    <div class="portlet-title tabbable-line">
        <div class="caption font-dark">
            <span class="caption-subject bold uppercase"><i
                        class="<?php echo $this->params['mainIcon'] ?>"></i> <?= $this->title ?></span>
            <span class="caption-helper">Update your profile</span>
        </div>
        <div class="tools">
            <a href="#" class="collapse"></a>
            <a class="fullscreen" href="#"></a>
        </div>
        <div class="actions">
        </div>
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_1_1" data-toggle="tab"><?= 'Update Profile' ?></a>
            </li>
            <li>
                <a href="#tab_1_2" data-toggle="tab"><?= 'Change Password' ?></a>
            </li>
        </ul>
    </div>
    <div class="portlet-body">
        <div class="portlet-body form">
            <div class="tab-content">
                <div class="tab-pane active row" id="tab_1_1">
                    <div class="form-body">
                        <div class="col-md-8">
                            <?php
                            $form = ActiveForm::begin([
                                'id' => 'profile-form',
                                'type' => ActiveForm::TYPE_HORIZONTAL,
                                'formConfig' => [
                                    'labelSpan' => 3,
                                    'deviceSize' => ActiveForm::SIZE_MEDIUM,
                                    'showErrors' => true],
                                'options' => [
                                    'class' => 'form-horizontal',
                                    'enctype' => 'multipart/form-data',
                                ],
                            ]) ?>
                            <?= $form->field($profile, 'name') ?>

                            <?= $form->field($profile, 'image_file')->widget(CropboxWidget::className(), [
                                'croppedDataAttribute' => 'image_file_crop',
                            ]);
                            ?>

                            <?php /*= $form->field($profile, 'image_file')->widget(FileInput::classname(),
                                [
                                    'options' => [
                                        'multiple' => false,
                                        'accept' => 'image/*'
                                    ],
                                    'pluginOptions' => [
                                        'previewFileType' => 'image',
                                        'showRemove' => false,
                                        'showUpload' => false
                                    ]
                                ]); */ ?>

                            <?= $form->field($profile, 'overview')->textarea(['rows' => '6']) ?>

                            <div class="form-actions">
                                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>
                        <div class="col-md-4">
                            <?= DetailView::widget(['model' => $user, 'preset' => 'core']) ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane row" id="tab_1_2">
                    <div class="form-body">
                        <div class="col-md-8">
                            <?php
                            $form2 = ActiveForm::begin([
                                'id' => 'profile-form',
                                'type' => ActiveForm::TYPE_HORIZONTAL,
                                'formConfig' => [
                                    'labelSpan' => 3,
                                    'deviceSize' => ActiveForm::SIZE_MEDIUM,
                                    'showErrors' => true],
                                'options' => [
                                    'class' => 'form-horizontal',
                                ],
                            ]) ?>
                            <?= $form2->field($model, 'currentPassword')->passwordInput() ?>
                            <?= $form2->field($model, 'newPassword')->passwordInput() ?>
                            <?= $form2->field($model, 'newPasswordRepeat')->passwordInput() ?>
                            <div class="form-actions">
                                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>
                        <div class="col-md-4">
                            <?= DetailView::widget(['model' => $user, 'preset' => 'core']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>