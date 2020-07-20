<?php

use common\components\FConstant;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$kcfOptions = array_merge(\iutbay\yii2kcfinder\KCFinder::$kcfDefaultOptions, [
    'uploadURL' => Yii::getAlias('@web') . '/upload/editor',
    'access' => [
        'files' => [
            'upload' => true,
            'delete' => false,
            'copy' => false,
            'move' => false,
            'rename' => false,
        ],
        'dirs' => [
            'create' => true,
            'delete' => false,
            'rename' => false,
        ],
    ],
]);
Yii::$app->session->set('KCFINDER', $kcfOptions);
?>

<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'User';
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
    $this->params['breadcrumbs'][] = ($model->isNewRecord) ? Yii::t('common', 'Create') : Yii::t('common', 'Update');
    $this->params['mainIcon'] = 'fa fa-list';
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
} ?>
<?php if (Yii::$app->request->isAjax) { ?>

    <?php $form = ActiveForm::begin(
        [
            'id' => 'user-form',
            'type' => $this->params['activeFormType'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
            'staticOnly' => false, // check the Role here
            'readonly' => false, // check the Role here
            'options' => [
                //'class' => 'form-horizontal',
            ]
        ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overview')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?php ActiveForm::end(); ?>

<?php } else { ?>

    <div class="user-form">
        <div class="<?= $this->params['portletStyle'] ?>">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <span class="caption-subject bold uppercase"><i class="<?php echo $this->params['mainIcon'] ?>"></i> <?= $this->title ?></span>
                    <span class="caption-helper"><?= ($model->isNewRecord) ? Yii::t('common', 'Create') : Yii::t('common', 'Update') ?></span>
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>
                    <a href="#" class="fullscreen"></a>
                </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body form">
                <?php $form = ActiveForm::begin([
                    'id' => 'user-form',
                    'type' => $this->params['activeFormType'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
                    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
                    'staticOnly' => false, // check the Role here
                    'readonly' => false, // check the Role here
                    'options' => [
                        //'class' => 'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ]
                ]);
                ?>
                <div class="form">
                    <div class="form-body">
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'image_file')->widget(\kartik\file\FileInput::className(), [
                            'options' => [
                                'multiple' => false,
                                'accept' => 'image/*'
                            ],
                            'pluginOptions' => [
                                'previewFileType' => 'image',
                                'showRemove' => false,
                                'showUpload' => false
                            ]
                        ]) ?>

                        <?= $form->field($model, 'overview')->widget(\common\components\CoconutEditor::className(), [
                            'options' => [
                                'rows' => 10,
                            ],
                            'preset' => 'full',
                        ]) ?>

                        <?= $form->field($model, 'new_password')->textInput(['maxlength' => true, 'placeholder' => $model->isNewRecord ? "" : "Leave this blank if you dont want to change password"]) ?>

                        <?php /*= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) */ ?>

                        <?php /*= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) */ ?>

                        <?php /*= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) */ ?>

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                        <?php if (FConstant::GLOBAL_ACCESS_CONTROL_MODE == FConstant::MODE_ROLE_BAC) { ?>
                        <?= $form->field($model, 'role')->dropDownList(common\models\User::roleArray(), ['prompt' => 'Select Role']) ?>
                        <?php } else { ?>
                        <?= $form->field($model, 'roles_selected')->widget(\kartik\widgets\Select2::className(), [
                            'data' => \common\models\User::lookupData('system_role', 'id', 'name'),
                            'options' => [
                                'multiple' => true,
                                'prompt' => 'Select Roles'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'tags' => true
                            ]
                        ]) ?>
                        <?php } ?>
                        <?= $form->field($model, 'status')->dropDownList(common\models\User::statusArray(), ['prompt' => 'Select Status']) ?>

                    </div>
                    <div class="form-actions">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <?php if (!$model->isNewRecord) { ?>
                            <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]); ?>
                            <?= Html::a(Yii::t('common', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                        <?php } else { ?>
                            <?= Html::a(Yii::t('common', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                        <?php } ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php } ?>