<?php

use backend\assets\CustomAsset;
use bupy7\cropbox\CropboxWidget;
use common\components\FHtml;
use common\components\FFile;
use kartik\file\FileInput;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $profile \backend\models\ProfileForm */
/* @var $model \backend\models\PasswordForm */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
$this->params['mainIcon'] = 'glyphicon glyphicon-cog';
//Get base url
$asset = CustomAsset::register($this);
$baseUrl = $asset->baseUrl;
$user = Yii::$app->user->identity;
/* @var \common\models\User $user */
?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo($baseUrl) ?>/themes/metronic/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?= FFile::getImageUrl($user->image, 'user') ?>" class="img-responsive" alt="user-avatar"></div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?= $user->name ?> </div>
                    <div class="profile-usertitle-job"> <?= \common\models\User::showRoleLabel($user->role) ?> </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <?php /*
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                    <button type="button" class="btn btn-circle red btn-sm">Message</button>
                </div>
                */ ?>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <table id="profile-preview" class="table table-striped table-bordered detail-view">
                        <tbody>
                        <tr>
                            <th class="col-md-4">Status</th>
                            <td>
                                <?= \common\components\FSetting::getStatusLabel($user->status) ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="col-md-4">Created At</th>
                            <td><?= FHtml::showDateTime($user->created_at) ?></td>
                        </tr>
                        <tr>
                            <th class="col-md-4">Updated At</th>
                            <td><?= FHtml::showDateTime($user->updated_at) ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <?php /*
                    <ul class="nav">
                        <li>
                            <a href="page_user_profile_1.html">
                                <i class="icon-home"></i> Overview </a>
                        </li>
                        <li>
                            <a href="page_user_profile_1_account.html">
                                <i class="icon-settings"></i> Account Settings </a>
                        </li>
                        <li class="active">
                            <a href="page_user_profile_1_help.html">
                                <i class="icon-info"></i> Help </a>
                        </li>
                    </ul>
                    */ ?>
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->
            <!-- PORTLET MAIN -->

            <div class="portlet light ">
                <!-- STAT -->
                <?php /*
                <div class="row list-separated profile-stat">
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 37 </div>
                        <div class="uppercase profile-stat-text"> Projects </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 51 </div>
                        <div class="uppercase profile-stat-text"> Tasks </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="uppercase profile-stat-title"> 61 </div>
                        <div class="uppercase profile-stat-text"> Uploads </div>
                    </div>
                </div>
                */ ?>
                <!-- END STAT -->

                <div>
                    <h4 class="profile-desc-title">About <?= $user->name ?></h4>
                    <span class="profile-desc-text"><?= $user->overview ?></span>
                    <?php /*
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-globe"></i>
                        <a href="http://www.keenthemes.com">www.keenthemes.com</a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-twitter"></i>
                        <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                    </div>
                    <div class="margin-top-20 profile-desc-link">
                        <i class="fa fa-facebook"></i>
                        <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                    </div>
                    */ ?>
                </div>
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption font-dark">
                                <span class="caption-subject bold uppercase"><i class="<?php echo $this->params['mainIcon'] ?>"></i> <?= $this->title ?></span>
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
                                            <div class="col-md-12">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane row" id="tab_1_2">
                                        <div class="form-body">
                                            <div class="col-md-12">
                                                <?php
                                                $form2 = ActiveForm::begin([
                                                    'id' => 'change-password-form',
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
