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
//    [
//        'class' => 'kartik\grid\DataColumn',
//        'attribute' => 'role_id',
//        'hAlign' => 'center',
//        'vAlign' => 'middle',
//        'contentOptions' => ['class' => 'col-md-2 nowrap'],
//    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'module',
        'value' => function ($model) {
            /* @var $model \backend\modules\system\models\SystemRight*/
            return $model->showModuleName();
        },
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'obj',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'permission',
        'value' => function ($model) {
            /* @var $model \backend\modules\system\models\SystemRight*/
            return $model->showActivityName();
        },
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\BooleanColumn',
        'attribute' => 'is_active',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-1 nowrap'],
    ],
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