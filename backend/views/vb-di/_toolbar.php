<?php

use yii\helpers\Html;
use kartik\dropdown\DropdownX;
use common\components\FHtml;

$bulkActionButton = '<div class="dropdown pull-left" style="margin-left: 3px"><button class="btn btn-default" data-toggle="dropdown">' . Yii::t('common', 'Actions') . '</button>' .
    DropdownX::widget([
        'items' => \yii\helpers\ArrayHelper::merge(
            [FHtml::buildBulkActionsMenu(FHtml::CHANGE_TYPE, Yii::t('common', 'Set') . ' ' . Yii::t('common', 'Del Flg'), 'vb_di', 'del_flg')],
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
            Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
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
            $bulkActionButton,
        'options' => ['class' => 'text-right kv-panel-before']
    ],
];