<?php

use yii\helpers\Url;
use common\components\FHtml;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
    ],
    //[
    //    'class' => 'kartik\grid\SerialColumn',
    //    'width' => '30px',
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'id',
        //'hAlign' => 'center',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'transaction_id',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'external_transaction_id',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'user_id',
        'value' => function ($model) {
            return backend\modules\app\models\AppTransaction::lookupLabel('app_user', 'id', $model->user_id, 'name');
        },
        'filter' => backend\modules\app\models\AppTransaction::lookupData('app_user', 'id', 'name'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => 'Select User'],
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'object_id',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'object_type',
        'value' => function ($model) {
            return backend\modules\app\models\AppTransaction::object_typeLabel($model->object_type);
        },
        'filter' => backend\modules\app\models\AppTransaction::object_typeArray(),
        'format' => 'html',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'currency',
        //'value' => function ($model) {
            //return backend\modules\app\models\AppTransaction::currencyLabel($model->currency);
        //},
        //'filter' => backend\modules\app\models\AppTransaction::currencyArray(),
        //'format' => 'html',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'amount',
        //'hAlign' => 'center',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'payment_method',
        //'value' => function ($model) {
            //return backend\modules\app\models\AppTransaction::payment_methodLabel($model->payment_method);
        //},
        //'filter' => backend\modules\app\models\AppTransaction::payment_methodArray(),
        //'format' => 'html',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'payment_gateway',
        //'value' => function ($model) {
            //return backend\modules\app\models\AppTransaction::payment_gatewayLabel($model->payment_gateway);
        //},
        //'filter' => backend\modules\app\models\AppTransaction::payment_gatewayArray(),
        //'format' => 'html',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'note',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'time',
        //'hAlign' => 'center',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'type',
        //'value' => function ($model) {
            //return backend\modules\app\models\AppTransaction::typeLabel($model->type);
        //},
        //'filter' => backend\modules\app\models\AppTransaction::typeArray(),
        //'format' => 'html',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'status',
        //'value' => function ($model) {
            //return backend\modules\app\models\AppTransaction::statusLabel($model->status);
        //},
        //'filter' => backend\modules\app\models\AppTransaction::statusArray(),
        //'format' => 'html',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model) {
            return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('common', 'View'), 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => $this->params['displayType'], 'title' => Yii::t('common', 'Update'), 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('common', 'Delete'),
            'data-confirm' => false,
            'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Confirmation',
            'data-confirm-message' => 'Are you sure want to delete this item'
        ],
    ],
];