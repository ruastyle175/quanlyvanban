<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VbDi */
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
    $this->title = Yii::t('VbDen', 'Vb Di');
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
            'id' => 'vb-di-form',
            'type' => $this->params['activeFormType'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
            'staticOnly' => false, // check the Role here
            'readonly' => false, // check the Role here
            'options' => [
                //'class' => 'form-horizontal',
            ]
        ]); ?>

    <?= $form->field($model, 'id_nhom_vanban')->textInput() ?>

    <?= $form->field($model, 'so_hieu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_loai_vanban')->textInput() ?>

    <?= $form->field($model, 'noidung_vanban')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'thoigian_banhanh')->textInput() ?>

    <?= $form->field($model, 'noi_nhan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_nguoiki')->textInput() ?>

    <?= $form->field($model, 'file_dinhkem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'del_flg')->textInput() ?>

    <?php ActiveForm::end(); ?>

<?php } else { ?>

    <div class="vb-di-form">
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
                    'id' => 'vb-di-form',
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
                        <?= $form->field($model, 'id_nhom_vanban')->widget(\kartik\widgets\Select2::className(), [
                            'data' => backend\models\VbDi::lookupData('m_nhom_vb', 'id', 'nhom_vb'),
                            'options' => [
                                'multiple' => false,
                                'prompt' => Yii::t('VbDen', 'Select Id Nhom Vanban')
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'tags' => true
                            ]
                        ]) ?>

                        <?= $form->field($model, 'so_hieu')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'id_loai_vanban')->widget(\kartik\widgets\Select2::className(), [
                            'data' => backend\models\VbDi::lookupData('m_loai_vb', 'id', 'loai_vb'),
                            'options' => [
                                'multiple' => false,
                                'prompt' => Yii::t('VbDen', 'Select Id Loai Vanban')
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'tags' => true
                            ]
                        ]) ?>

                        <?= $form->field($model, 'noidung_vanban')->widget(\common\components\CoconutEditor::className(), [
                            'options' => [
                                'rows' => 10,
                            ],
                            'preset' => 'full',
                        ]) ?>

                        <?= $form->field($model, 'thoigian_banhanh')->widget(\kartik\widgets\DateTimePicker::classname(), [
                            'options' => ['placeholder' => Yii::t('VbDen', 'Select Thoigian Banhanh')],
                            'pluginOptions' => [
                                'autoclose' => true
                            ]
                        ]) ?>

                        <?= $form->field($model, 'noi_nhan')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'id_nguoiki')->widget(\kartik\widgets\Select2::className(), [
                            'data' => backend\models\VbDi::lookupData('m_nguoi_ky', 'id', 'nguoi_ky'),
                            'options' => [
                                'multiple' => false,
                                'prompt' => Yii::t('VbDen', 'Select Id Nguoiki')
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'tags' => true
                            ]
                        ]) ?>

                        <?= $form->field($model, 'file_dinhkem_file')->widget(\kartik\file\FileInput::className(), [
                            'options' => [
                                'multiple' => false,
                                'accept' => '*'
                            ],
                            'pluginOptions' => [
                                'previewFileType' => 'any',
                                'showRemove' => false,
                                'showUpload' => false
                            ]
                        ]) ?>

                        <?= $form->field($model, 'del_flg')->widget(\kartik\checkbox\CheckboxX::classname(), ['options' => ['value' => $model->isNewRecord ? 1 : $model->del_flg], 'pluginOptions' => ['theme' => 'krajee-flatblue', 'size' => 'lg', 'threeState' => false]]) ?>

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