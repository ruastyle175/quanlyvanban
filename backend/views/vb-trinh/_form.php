<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VbTrinh */
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
    $this->title = Yii::t('VbDen', 'Vb Trinh');
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
            'id' => 'vb-trinh-form',
            'type' => $this->params['activeFormType'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
            'staticOnly' => false, // check the Role here
            'readonly' => false, // check the Role here
            'options' => [
                //'class' => 'form-horizontal',
            ]
        ]); ?>

    <?= $form->field($model, 'so_hieu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noidung_vanban')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'thoigian_trinh')->textInput() ?>

    <?= $form->field($model, 'id_nguoi_nhan')->textInput() ?>

    <?= $form->field($model, 'ghichu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'del_flg')->textInput() ?>

    <?php ActiveForm::end(); ?>

<?php } else { ?>

    <div class="vb-trinh-form">
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
                    'id' => 'vb-trinh-form',
                    'type' => $this->params['activeFormType'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
                    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
                    'staticOnly' => false, // check the Role here
                    'readonly' => false, // check the Role here
                    'options' => [
                        //'class' => 'form-horizontal',
                    ]
                ]);
                ?>
                <div class="form">
                    <div class="form-body">
                        <?= $form->field($model, 'so_hieu')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'noidung_vanban')->widget(\common\components\CoconutEditor::className(), [
                            'options' => [
                                'rows' => 10,
                            ],
                            'preset' => 'full',
                        ]) ?>

                        <?= $form->field($model, 'thoigian_trinh')->widget(\kartik\widgets\DateTimePicker::classname(), [
                            'options' => ['placeholder' => Yii::t('VbDen', 'Select Thoigian Trinh')],
                            'pluginOptions' => [
                                'autoclose' => true
                            ]
                        ]) ?>

                        <?= $form->field($model, 'id_nguoi_nhan')->widget(\kartik\widgets\Select2::className(), [
                            'data' => backend\models\VbTrinh::lookupData('m_nguoi_nhan', 'id', 'nguoi_nhan'),
                            'options' => [
                                'multiple' => false,
                                'prompt' => Yii::t('VbDen', 'Select Id Nguoi Nhan')
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'tags' => true
                            ]
                        ]) ?>

                        <?= $form->field($model, 'ghichu')->textInput(['maxlength' => true]) ?>

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