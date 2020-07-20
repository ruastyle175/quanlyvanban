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
        'attribute' => 'id_nhom_vanban',
        'value' => function ($model) {
            return backend\models\VbDi::lookupLabel('m_nhom_vb', 'id', $model->id_nhom_vanban, 'nhom_vb');
        },
        'filter' => backend\models\VbDi::lookupData('m_nhom_vb', 'id', 'nhom_vb'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => Yii::t('VbDen', 'Select Id Nhom Vanban')],
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'so_hieu',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'id_loai_vanban',
        'value' => function ($model) {
            return backend\models\VbDi::lookupLabel('m_loai_vb', 'id', $model->id_loai_vanban, 'loai_vb');
        },
        'filter' => backend\models\VbDi::lookupData('m_loai_vb', 'id', 'loai_vb'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => Yii::t('VbDen', 'Select Id Loai Vanban')],
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'noidung_vanban',
        //'hAlign' => 'center',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'thoigian_banhanh',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-1 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'noi_nhan',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'id_nguoiki',
        'value' => function ($model) {
            return backend\models\VbDi::lookupLabel('m_nguoi_ky', 'id', $model->id_nguoiki, 'nguoi_ky');
        },
        'filter' => backend\models\VbDi::lookupData('m_nguoi_ky', 'id', 'nguoi_ky'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => Yii::t('VbDen', 'Select Id Nguoiki')],
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'file_dinhkem',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
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
    //[
        //'class' => 'kartik\grid\BooleanColumn',
        //'attribute' => 'del_flg',
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