<?php

/**/

use yii\helpers\Html;
use kartik\dropdown\DropdownX;
use common\components\FHtml;

$bulkActionButton = '<div class="dropdown pull-left" style="margin-left: 3px"><button class="btn btn-default" data-toggle="dropdown">' . Yii::t('common', 'Actions') . '</button>' .
    DropdownX::widget([
        'items' => \yii\helpers\ArrayHelper::merge(
            [FHtml::buildBulkActionsMenu(FHtml::CHANGE_TYPE, Yii::t('common', 'Set') . ' ' . Yii::t('common', 'Is Active'), 'system_right', 'is_active')],
            ['<li class="divider"></li>'],
            //[FHtml::buildBulkActionsMenu(FHtml::CLEAR_TYPE, ucwords(FHtml::CLEAR_TYPE) . ' ' . Yii::t('common', 'Amount'), false, 'amount')],
            //[FHtml::buildBulkActionsMenu(FHtml::FILL_TYPE, ucwords(FHtml::FILL_TYPE) . ' ' . Yii::t('common', 'Amount'), false, 'amount')],
            ['<li class="divider"></li>'],
            [FHtml::buildBulkDeleteMenu()]
        )
    ])
    . '</div>';

return [
    [
        'content' =>
            Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create', 'role_id' => $role_id],
                [
                    'role' => $this->params['displayType'],
                    'data-pjax' => $this->params['isAjax'] == true ? 1 : 0,
                    'title' => Yii::t('common', 'Create'),
                    'class' => 'btn btn-success',
                    'style' => 'float:left;'
                ]) .

            '{export}' .
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => Yii::t('common', 'Reset Grid')]) .
            '{toggleData}' .
            $bulkActionButton .
            Html::a('<i class="fa fa-arrow-left"></i>Back', ['role/index'],
                [
                    'role' => $this->params['displayType'],
                    'data-pjax' => $this->params['isAjax'] == true ? 1 : 0,
                    'title' => Yii::t('common', 'Back'),
                    'class' => 'btn btn-warning',
                    'style' => 'float:left; margin-left: 3px'
                ])
        ,
        'options' => ['class' => 'text-right kv-panel-before']
    ],
];