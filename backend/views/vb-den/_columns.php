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
        'attribute' => 'id_donvi_gui',
        'value' => function ($model) {
            return backend\models\VbDen::lookupLabel('m_don_vi_gui', 'id', $model->id_donvi_gui, 'ten_don_vi');
        },
        'filter' => backend\models\VbDen::lookupData('m_don_vi_gui', 'id', 'ten_don_vi'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => Yii::t('VbDen', 'Chọn đơn vị gửi')],
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
            return backend\models\VbDen::lookupLabel('m_loai_vb', 'id', $model->id_loai_vanban, 'loai_vb');
        },
        'filter' => backend\models\VbDen::lookupData('m_loai_vb', 'id', 'loai_vb'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => Yii::t('VbDen', 'Chọn loại văn bản')],
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
        'filterType' => \kartik\grid\GridView::FILTER_DATETIME,
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-1 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'thoigian_nhan',
        'filterType' => \kartik\grid\GridView::FILTER_DATETIME,
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-1 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'id_lanh_dao',
        'value' => function ($model) {
            return backend\models\VbDen::lookupLabel('m_lanh_dao', 'id', $model->id_lanh_dao, 'ten_lanh_dao');
        },
        'filter' => backend\models\VbDen::lookupData('m_lanh_dao', 'id', 'ten_lanh_dao'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => Yii::t('VbDen', 'Chọn lãnh đạo')],
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'id_can_bo',
        'value' => function ($model) {
            return backend\models\VbDen::lookupLabel('m_can_bo', 'id', $model->id_can_bo, 'ten_can_bo');
        },
        'filter' => backend\models\VbDen::lookupData('m_can_bo', 'id', 'ten_can_bo'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => Yii::t('VbDen', 'Chọn cán bộ')],
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-0 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'thoigian_hoanthanh',
        'filterType' => \kartik\grid\GridView::FILTER_DATETIME,
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-0 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'id_trang_thai',
        'value' => function ($model) {
            return backend\models\VbDen::lookupLabel('m_trang_thai', 'id', $model->id_trang_thai, 'trang_thai');
        },
        'filter' => backend\models\VbDen::lookupData('m_trang_thai', 'id', 'trang_thai'),
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filterWidgetOptions' => ['pluginOptions' => ['allowClear' => true]],
        'filterInputOptions' => ['placeholder' => Yii::t('VbDen', 'Chọn trạng thái')],
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-0 nowrap'],
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