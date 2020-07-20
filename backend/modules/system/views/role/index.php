<?php

use yii\bootstrap\Modal;
use kartik\grid\GridView;
use common\components\CrudAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\system\models\SystemRoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'System Role';

$this->params['breadcrumbs'][] = $this->title;

$this->params['toolBarActions'] = array(
    'linkButton' => array(),
    'button' => array(),
    'dropdown' => array(),
);
$this->params['mainIcon'] = 'fa fa-list';

CrudAsset::register($this);

?>
    <div class="system-role-index">
        <?php if ($this->params['displayPortlet']): ?>
        <div class="<?= $this->params['portletStyle'] ?>">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <span class="caption-subject bold uppercase"><i class="<?php echo $this->params['mainIcon'] ?>"></i> <?= $this->title ?></span>
                    <span class="caption-helper"><?= Yii::t('common', 'Index') ?></span>
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>
                    <a href="#" class="fullscreen"></a>
                </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body">
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div id="ajaxCrudDatatable">
                            <?= GridView::widget([
                                'id' => 'crud-datatable',
                                //'floatHeader' => true, // enable this will keep header when scroll but disable resizeable column feature
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'pjax' => true,
                                'pager' => [
                                    'firstPageLabel' => 'First',
                                    'lastPageLabel' => 'Last',
                                ],
                                'toolbar' => require(__DIR__ . '/_toolbar.php'),
                                'columns' => require(__DIR__ . '/_columns.php'),
                                'striped' => true,
                                'condensed' => true,
                                'responsive' => true,
                                'layout' => "{toolbar}\n{items}\n{summary}\n{pager}",
                                'panel' => false
                            ]) ?>
                        </div>
                    </div>
                </div>
                <?php if ($this->params['displayPortlet']): ?>
            </div>
        </div>
    <?php endif; ?>
    </div>
<?php Modal::begin([
    "id" => "ajaxCrubModal",
    "footer" => "",
]) ?>
<?php Modal::end(); ?>