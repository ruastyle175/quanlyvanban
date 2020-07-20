<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;

/* @var $this yii\web\View */
/* @var $model backend\modules\app\models\AppTransaction */
?>
<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'App Transaction';
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
    $this->params['breadcrumbs'][] = Yii::t('common', 'View');
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
    $this->params['mainIcon'] = 'fa fa-list';
} ?>
<?php if (Yii::$app->request->isAjax) { ?>
    <div class="app-transaction-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'transaction_id',
                'external_transaction_id',
                [
                    'attribute' => 'user_id',
                    'value' => backend\modules\app\models\AppTransaction::lookupLabel('app_user', 'id', $model->user_id, 'name'),
                ],
                'object_id',
                [
                    'attribute' => 'object_type',
                    'value' => backend\modules\app\models\AppTransaction::object_typeLabel($model->object_type),
                    'format' => 'html',
                ],
                [
                    'attribute' => 'currency',
                    'value' => backend\modules\app\models\AppTransaction::currencyLabel($model->currency),
                    'format' => 'html',
                ],
                'amount',
                [
                    'attribute' => 'payment_method',
                    'value' => backend\modules\app\models\AppTransaction::payment_methodLabel($model->payment_method),
                    'format' => 'html',
                ],
                [
                    'attribute' => 'payment_gateway',
                    'value' => backend\modules\app\models\AppTransaction::payment_gatewayLabel($model->payment_gateway),
                    'format' => 'html',
                ],
                [
                    'attribute' => 'note',
                    'format' => 'html',
                ],
                'time',
                [
                    'attribute' => 'type',
                    'value' => backend\modules\app\models\AppTransaction::typeLabel($model->type),
                    'format' => 'html',
                ],
                [
                    'attribute' => 'status',
                    'value' => backend\modules\app\models\AppTransaction::statusLabel($model->status),
                    'format' => 'html',
                ],
            ],
        ]) ?>
    </div>
<?php } else { ?>
    <div class="<?= $this->params['portletStyle'] ?>">
        <div class="portlet-title">
            <div class="caption font-dark">
                <span class="caption-subject bold uppercase"><i class="<?php echo $this->params['mainIcon'] ?>"></i> <?= $this->title ?></span>
                <span class="caption-helper"><?= Yii::t('common', 'View') ?></span>
            </div>
            <div class="tools">
                <a href="#" class="collapse"></a>
                <a href="#" class="fullscreen"></a>
            </div>
            <div class="actions">
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'transaction_id',
                            'external_transaction_id',
                            [
                                'attribute' => 'user_id',
                                'value' => backend\modules\app\models\AppTransaction::lookupLabel('app_user', 'id', $model->user_id, 'name'),
                            ],
                            'object_id',
                            [
                                'attribute' => 'object_type',
                                'value' => backend\modules\app\models\AppTransaction::object_typeLabel($model->object_type),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'currency',
                                'value' => backend\modules\app\models\AppTransaction::currencyLabel($model->currency),
                                'format' => 'html',
                            ],
                            'amount',
                            [
                                'attribute' => 'payment_method',
                                'value' => backend\modules\app\models\AppTransaction::payment_methodLabel($model->payment_method),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'payment_gateway',
                                'value' => backend\modules\app\models\AppTransaction::payment_gatewayLabel($model->payment_gateway),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'note',
                                'format' => 'html',
                            ],
                            'time',
                            [
                                'attribute' => 'type',
                                'value' => backend\modules\app\models\AppTransaction::typeLabel($model->type),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'status',
                                'value' => backend\modules\app\models\AppTransaction::statusLabel($model->status),
                                'format' => 'html',
                            ],
                        ],
                    ]) ?>
                    <p>
                        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item ?',
                                'method' => 'post',
                            ],
                        ]) ?>
                        <?= Html::a(Yii::t('common', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>