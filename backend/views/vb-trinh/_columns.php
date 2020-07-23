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
        'attribute' => 'so_hieu',
        'hAlign' => 'left',
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
        'attribute' => 'thoigian_trinh',
        'filterType' => \kartik\grid\GridView::FILTER_DATETIME,
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-1 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'id_nguoi_nhan',
        'value' => function ($model) {
            return backend\models\VbTrinh::lookupLabel('m_nguoi_nhan', 'id', $model->id_nguoi_nhan, 'nguoi_nhan');
        },
        'filter' => backend\models\VbTrinh::lookupData('m_nguoi_nhan', 'id', 'nguoi_nhan'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => Yii::t('VbDen', 'Chọn người nhận')],
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'ghichu',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
//    [
//        'class' => 'kartik\grid\DataColumn',
//        'attribute' => 'created_at',
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//        'contentOptions' => ['class' => 'col-md-1 nowrap'],
//    ],
//    [
//        'class' => 'kartik\grid\DataColumn',
//        'attribute' => 'updated_at',
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//        'contentOptions' => ['class' => 'col-md-1 nowrap'],
//    ],
//    [
//        'class' => 'kartik\grid\BooleanColumn',
//        'attribute' => 'del_flg',
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//        'contentOptions' => ['class' => 'col-md-1 nowrap'],
//    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model) {
            return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('common', 'Xem'), 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => $this->params['displayType'], 'title' => Yii::t('common', 'Cập nhật'), 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('common', 'Xóa'),
            'data-confirm' => false,
            'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Confirmation',
            'data-confirm-message' => 'Bạn có chắc chắn muốn xóa?'
        ],
    ],
];