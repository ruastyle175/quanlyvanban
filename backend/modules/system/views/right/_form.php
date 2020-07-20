<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\system\models\SystemRight */
/* @var $form yii\widgets\ActiveForm */
/* @var $role_id integer */

$model->role_id = $model->isNewRecord ? $role_id : $model->role_id;
$role = \backend\modules\system\models\SystemRole::findOne($model->role_id);


$module_selection = array();
$modules = \backend\modules\system\System::rightModules();
$modules_array = array();
$obj_array = array();

foreach ($modules as $module) {
    $modules_array[$module['module']] = $module['module_title'];
    foreach ($module['obj'] as $obj) {
        $obj_array[$module['module_title']][$obj] = $obj;
    }
}

?>

<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'System Right';
    $this->params['breadcrumbs'][] = ['label' => "System Role: " . $role->name, 'url' => ['role/view', 'id' => $model->role_id]];
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'role_id' => $model->role_id]];
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
            'id' => 'system-right-form',
            'type' => $this->params['activeFormType'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
            'staticOnly' => false, // check the Role here
            'readonly' => false, // check the Role here
            'options' => [
                //'class' => 'form-horizontal',
            ]
        ]); ?>

    <?= $form->field($model, 'role_id')->textInput() ?>

    <?= $form->field($model, 'module')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permission')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?php ActiveForm::end(); ?>

<?php } else { ?>

    <div class="system-right-form">
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
                    'id' => 'system-right-form',
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

                        <?= $form->field($model, 'role_id')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'module')->dropDownList($modules_array, ['prompt' => 'Select module']) ?>

                        <?= $form->field($model, 'obj')->dropDownList($obj_array, ['prompt' => 'Select object']) ?>

                        <?= $form->field($model, 'permission')->dropDownList(\common\components\FAccessControl::allActivities(), ['prompt' => 'Select right']) ?>

                        <?= $form->field($model, 'is_active')->widget(\kartik\checkbox\CheckboxX::classname(), ['options' => ['value' => $model->isNewRecord ? 1 : $model->is_active], 'pluginOptions' => ['theme' => 'krajee-flatblue', 'size' => 'lg', 'threeState' => false]]) ?>

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
                            <?= Html::a(Yii::t('common', 'Cancel'), ['index', 'role_id' => $model->role_id], ['class' => 'btn btn-default']) ?>
                        <?php } else { ?>
                            <?= Html::a(Yii::t('common', 'Cancel'), ['index', 'role_id' => $model->role_id], ['class' => 'btn btn-default']) ?>
                        <?php } ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php } ?>