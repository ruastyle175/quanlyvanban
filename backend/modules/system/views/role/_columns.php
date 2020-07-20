<?php

use yii\helpers\Html;
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
        'attribute' => 'name',
        'hAlign' => 'left',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-5 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'color',
        'value' => function ($model) {
            return FHtml::showColor($model->color);
        },
        'format' => 'html',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    //[
        //'class' => 'kartik\grid\DataColumn',
        //'attribute' => 'description',
        //'hAlign' => 'left',
        //'vAlign' => 'middle',
        //'contentOptions' => ['class' => 'col-md-0 nowrap'],
    //],
    [
        'class' => 'kartik\grid\BooleanColumn',
        'attribute' => 'is_active',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'rights',
        'format' => 'raw',
        'value' => function($model)
        {
            return '<a class="btn btn-xs btn-info" data-pjax ="0" href="'.Yii::$app->urlManager->createUrl(['system/right/index','role_id' => $model->id]).'">'.count($model->rights).'</span></a>';
        },
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'contentOptions' => ['class' => 'col-md-2 nowrap'],
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model) {
            return Url::to([$action, 'id' => $model->id]);
        },
        'template' => '{right}{view}{update}{delete}',
        'buttons' => [
            'right' => function($url, $model, $key) {     // render your custom button
                return Html::a(
                    '<span class="fa fa-key"</span>',
                    ['right/index', 'role_id' => $model->id],
                    [
                        'title' => 'Manage rights',
                        //'data-confirm' => 'This item will move to trash, Do you want to continue?',
                        //'data-method'=>'post',
                        'data-pjax' => 0,
                    ]
                );
                //return Html::a('Click me', ['site/index'], ['class' => 'btn btn-success btn-xs', 'data-pjax' => 0]);
            }
        ],
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