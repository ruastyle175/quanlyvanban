<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use projectemplate\ptcrud\Helper;

/* @var $this yii\web\View */
/* @var $generator projectemplate\ptcrud\generators\Generator */

/* @var $model \yii\db\ActiveRecord */

$model = new $generator->modelClass();
$model_id = Inflector::camel2id(StringHelper::basename($generator->modelClass));

$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

$has_editor = false;
$has_file = false;
$has_coordinate = false;
$has_color = false;
$latitude_field = 'latitude';
$latitude_default = 33.76144988940147;
$longitude_field = 'longitude';
$longitude_default = -118.19708156585693;
$color_fields = array('color');
$init_coordinate_picker = false;

$tableSchema = $generator->tableSchema;
$columnsNames = $generator->getColumnNames();

foreach ($tableSchema->columns as $column) :
    if($column->type == "text" || ($column->type == "string" && $column->size >= 500)){
        $has_editor = true;
    }
    $keyword = Helper::keyword($column->comment);
    if ($keyword !== false) {
        if ($keyword == Helper::FILE_KEYWORD) {
            $has_file = true;
        }
        if ($keyword == Helper::COLOR_KEYWORD) {
            $has_color = true;
            $color_fields[] = $column->name;
        }
        if ($keyword == Helper::COORDINATE_KEYWORD) {
            $has_coordinate = true;
            $data = Helper::coordinateDataFromDbComment($column->comment, $keyword);
            if (is_array($data) && !empty($data)) {
                $type = $data['type'];
                if ($type == 'latitude') {
                    $latitude_field = $column->name;
                    if (isset($data['default'])) {
                        $latitude_default = $data['default'];
                    }
                }
                if ($type == 'longitude') {
                    $longitude_field = $column->name;
                    if (isset($data['default'])) {
                        $longitude_default = $data['default'];
                    }
                }
            }
        }
    }
endforeach;

$autoSetFields = Helper::autoSetFields();
$hiddenFields = Helper::hiddenFields();
$urlParams = $generator->generateUrlParams();

//use kartik\switchinput\SwitchInput;

echo "<?php\n"; ?>

use yii\helpers\Html;
use kartik\form\ActiveForm;
<?php if ($has_coordinate) : ?>
use backend\modules\system\models\SystemSetting;
use common\components\FConstant;
<?php endif; ?>

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */

<?php if($has_editor): ?>
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
<?php endif; ?>
<?php if($has_coordinate): ?>
$key_setting = SystemSetting::getSettingValueByKey(FConstant::GOOGLE_MAP_API_KEY);
$map_api_key = $key_setting[FConstant::GOOGLE_MAP_API_KEY];
<?php endif; ?>
?>

<?= "<?php" ?> if (!Yii::$app->request->isAjax) {
    $this->title = <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
    $this->params['breadcrumbs'][] = ($model->isNewRecord) ? Yii::t('common', 'Create') : Yii::t('common', 'Update');
    $this->params['mainIcon'] = 'fa fa-list';
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
}<?= " ?>" ?>

<?= '<?php if (Yii::$app->request->isAjax) { ?>' . "\n" ?>

    <?= "<?php " ?>$form = ActiveForm::begin(<?= "\n" ?>
        [
            'id' => '<?= $model_id ?>-form',
            'type' => $this->params['activeFormType'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
            'staticOnly' => false, // check the Role here
            'readonly' => false, // check the Role here
            'options' => [
                //'class' => 'form-horizontal',
            ]
        ]); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
    <?= '<?php ' ?>ActiveForm::end(); ?><?= "\n" ?>

<?= '<?php } else { ?>' . "\n" ?>

    <div class="<?= $model_id ?>-form">
        <div class="<?= "<?=" ?> $this->params['portletStyle'] <?= "?>" ?>">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <span class="caption-subject bold uppercase"><i class="<?= "<?php " ?>echo $this->params['mainIcon'] <?= "?>" ?>"></i> <?= "<?= " ?>$this->title <?= "?>" ?></span>
                    <span class="caption-helper"><?= "<?=" ?> ($model->isNewRecord) ? Yii::t('common', 'Create') : Yii::t('common', 'Update') <?= "?>" ?></span>
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>
                    <a href="#" class="fullscreen"></a>
                </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body form">
                <?= "<?php " ?>$form = ActiveForm::begin([
                    'id' => '<?= $model_id ?>-form',
                    'type' => $this->params['activeFormType'],//ActiveForm::TYPE_HORIZONTAL,ActiveForm::TYPE_VERTICAL,ActiveForm::TYPE_INLINE
                    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM, 'showErrors' => true],
                    'staticOnly' => false, // check the Role here
                    'readonly' => false, // check the Role here
                    'options' => [
                        //'class' => 'form-horizontal',
<?php if ($has_file) : ?>
                        <?= "'enctype' => 'multipart/form-data'\n" ?>
<?php endif; ?>
                    ]
                ]);
                <?= "?>" ?><?= "\n" ?>
                <div class="form">
                    <div class="form-body">
<?php foreach ($generator->getColumnNames() as $attribute) : ?>
<?php if($attribute == $latitude_field) { ?>
                        <?= "<?= " ?>$form->field($model, 'map')->widget('\pigolab\locationpicker\CoordinatesPicker', [
                            'key' => $map_api_key,
                            'valueTemplate' => '{latitude},{longitude}',
                            'options' => [
                                'style' => 'height: 400px',
                            ],
                            'enableSearchBox' => true,
                            'searchBoxOptions' => [
                                'style' => 'width: 300px;',
                            ],
                            'enableMapTypeControl' => false,
                            'clientOptions' => [
                                'location' => [
                                    'latitude' => $model->isNewRecord ? <?= $latitude_default ?> : $model-><?= $latitude_field ?>,
                                    'longitude' => $model->isNewRecord ? <?= $longitude_default ?> : $model-><?= $longitude_field ?>,
                                ],
                                'radius' => 0,
                                'inputBinding' => [
                                    'latitudeInput' => new \yii\web\JsExpression("$('#<?= $model_id ?>-<?= $latitude_field ?>')"),
                                    'longitudeInput' => new \yii\web\JsExpression("$('#<?= $model_id ?>-<?= $longitude_field ?>')"),
                                    //'locationNameInput' => new \yii\web\JsExpression("$('#<?= $model_id ?>-address')")
                                ]
                            ]
                        ]); <?= "?>\n\n" ?>
<?php } ?>
<?php if(in_array($attribute, $color_fields)) { ?>
                        <?= "<?php " ?>$this->registerCss(".spectrum-group .input-group-addon { padding: 0; }"); <?= "?>\n" ?>
<?php } ?>
<?php if(in_array($attribute, $safeAttributes) && !in_array($attribute, $autoSetFields)) : ?>
<?php if(Helper::checkHiddenField($attribute, $hiddenFields)) { ?>
                        <?= "<?php /*= " ?><?= $generator->generateActiveFieldAdvanced($attribute) ?> <?= "*/ ?>\n\n" ?>
<?php } else {?>
                        <?= "<?= " ?><?= $generator->generateActiveFieldAdvanced($attribute) ?> <?= "?>\n\n" ?>
<?php } ?>
<?php  endif; ?>
<?php  endforeach; ?>
                    </div>
                    <div class="form-actions">
                        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <?= "<?php " ?>if (!$model->isNewRecord) { <?= "?>\n" ?>
                            <?= "<?= " ?>Html::a(Yii::t('common', 'Delete'), ['delete', <?= $urlParams ?>], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]); ?>
                            <?= "<?= " ?>Html::a(Yii::t('common', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                        <?= "<?php } else { ?>\n" ?>
                            <?= "<?= " ?>Html::a(Yii::t('common', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                        <?= "<?php } ?>\n" ?>
                    </div>
                </div>
             <?= "   <?php " ?>ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?= '<?php } ?>' ?>
