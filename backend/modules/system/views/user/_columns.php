<?php

use common\components\FConstant;
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
        'attribute' => 'image',
        'value' => function ($model) {
            return FHtml::showImageThumbnail($model->image, false, 'user');
        },
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-1 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'username',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'name',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'overview',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'auth_key',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'password_hash',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'password_reset_token',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
//    [
//        'class' => 'kartik\grid\DataColumn',
//        'attribute' => 'email',
//        'hAlign' => 'left',
//        'vAlign' => 'middle',
//        'contentOptions' => ['class' => 'col-md-2 nowrap'],
//    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'role',
        'value' => function ($model) {
            return common\models\User::roleLabel($model->role);
        },
        'filter' => common\models\User::roleArray(),
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'visible' => FConstant::GLOBAL_ACCESS_CONTROL_MODE == FConstant::MODE_ROLE_BAC,
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'label' => 'Role',
        'attribute' => 'role_id',
        'value' => function ($model) {
            return common\models\User::roleLabels($model);
        },
        'filter' => common\models\User::lookupData('system_role', 'id', 'name'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => 'Select role'],
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'visible' => FConstant::GLOBAL_ACCESS_CONTROL_MODE == FConstant::MODE_RIGHT_BAC,
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'status',
        'value' => function ($model) {
            return common\models\User::statusLabel($model->status);
        },
        'filter' => common\models\User::statusArray(),
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'created_at',
        //'hAlign' => 'center',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'updated_at',
        //'hAlign' => 'center',
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