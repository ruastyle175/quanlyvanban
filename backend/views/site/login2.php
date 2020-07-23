<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => [
        'class' => 'login-form'
    ]]); ?>

    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Yêu cầu nhập tài khoản và mật khẩu. </span>
    </div>

    <?= $form->field($model, 'username', ['template' => "{label}\n<label class=\"control-label visible-ie8 visible-ie9\">Tài khoản</label>\n<div class=\"input-icon\"><i class=\"fa fa-user\"></i>\n{input}\n</div>\n{hint}\n{error}"])
        ->textInput([
            'autofocus' => true,
            'placeholder' => 'Tài khoản',
            'class' => 'form-control placeholder-no-fix',
            'autocomplete' => 'off'
        ])
        ->label(false)
    ?>

    <?= $form->field($model, 'password', ['template' => "{label}\n<label class=\"control-label visible-ie8 visible-ie9\">Mật khẩu</label>\n<div class=\"input-icon\"><i class=\"fa fa-lock\"></i>\n{input}\n</div>\n{hint}\n{error}"])
        ->passwordInput([
            'autofocus' => true,
            'placeholder' => 'Mật khẩu',
            'class' => 'form-control placeholder-no-fix',
            'autocomplete' => 'off'
        ])
        ->label(false)
    ?>

    <div class="form-actions">
        <?= $form->field($model, 'rememberMe', ['template' => "<label class=\"rememberme mt-checkbox mt-checkbox-outline\">\n{input}\nLưu tài khoản<span></span></label>\n{error}", 'options' => ['class' => 'col-xs-8']])->checkbox([], false) ?>
        <?= Html::submitButton('Đăng nhập', ['class' => 'btn green pull-right', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <!-- END LOGIN FORM -->
</div>
