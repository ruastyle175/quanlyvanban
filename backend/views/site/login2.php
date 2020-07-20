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
    <h3 class="form-title">Login to your account</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Enter any username and password. </span>
    </div>

    <?= $form->field($model, 'username', ['template' => "{label}\n<label class=\"control-label visible-ie8 visible-ie9\">Username</label>\n<div class=\"input-icon\"><i class=\"fa fa-user\"></i>\n{input}\n</div>\n{hint}\n{error}"])
        ->textInput([
            'autofocus' => true,
            'placeholder' => 'Username',
            'class' => 'form-control placeholder-no-fix',
            'autocomplete' => 'off'
        ])
        ->label(false)
    ?>

    <?= $form->field($model, 'password', ['template' => "{label}\n<label class=\"control-label visible-ie8 visible-ie9\">Password</label>\n<div class=\"input-icon\"><i class=\"fa fa-lock\"></i>\n{input}\n</div>\n{hint}\n{error}"])
        ->passwordInput([
            'autofocus' => true,
            'placeholder' => 'Password',
            'class' => 'form-control placeholder-no-fix',
            'autocomplete' => 'off'
        ])
        ->label(false)
    ?>

    <div class="form-actions">
        <?= $form->field($model, 'rememberMe', ['template' => "<label class=\"rememberme mt-checkbox mt-checkbox-outline\">\n{input}\nRemember Me<span></span></label>\n{error}", 'options' => ['class' => 'col-xs-8']])->checkbox([], false) ?>
        <?= Html::submitButton('Login', ['class' => 'btn green pull-right', 'name' => 'login-button']) ?>
    </div>
    <div class="forget-password">
        <h4>Forgot your password ?</h4>
        <p> No worries, click
            <a href="<?= Yii::$app->urlManager->createUrl(['/site/request-password-reset']) ?>" id="forget-password">
                here </a> to reset your password. </p>
    </div>
    <?php ActiveForm::end(); ?>

    <!-- END LOGIN FORM -->
</div>
