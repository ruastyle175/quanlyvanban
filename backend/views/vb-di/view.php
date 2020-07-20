<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;

/* @var $this yii\web\View */
/* @var $model backend\models\VbDi */
?>
<?php if (!Yii::$app->request->isAjax) {
    $this->title = Yii::t('VbDen', 'Vb Di');
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
    <div class="vb-di-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'id_nhom_vanban',
                    'value' => backend\models\VbDi::lookupLabel('m_nhom_vb', 'id', $model->id_nhom_vanban, 'nhom_vb'),
                ],
                'so_hieu',
                [
                    'attribute' => 'id_loai_vanban',
                    'value' => backend\models\VbDi::lookupLabel('m_loai_vb', 'id', $model->id_loai_vanban, 'loai_vb'),
                ],
                [
                    'attribute' => 'noidung_vanban',
                    'format' => 'html',
                ],
                'thoigian_banhanh',
                'noi_nhan',
                [
                    'attribute' => 'id_nguoiki',
                    'value' => backend\models\VbDi::lookupLabel('m_nguoi_ky', 'id', $model->id_nguoiki, 'nguoi_ky'),
                ],
                'file_dinhkem',
                'created_at',
                'updated_at',
                [
                    'attribute' => 'del_flg',
                    'value' => FHtml::showIsActiveLabel($model->del_flg),
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
                            [
                                'attribute' => 'id_nhom_vanban',
                                'value' => backend\models\VbDi::lookupLabel('m_nhom_vb', 'id', $model->id_nhom_vanban, 'nhom_vb'),
                            ],
                            'so_hieu',
                            [
                                'attribute' => 'id_loai_vanban',
                                'value' => backend\models\VbDi::lookupLabel('m_loai_vb', 'id', $model->id_loai_vanban, 'loai_vb'),
                            ],
                            [
                                'attribute' => 'noidung_vanban',
                                'format' => 'html',
                            ],
                            'thoigian_banhanh',
                            'noi_nhan',
                            [
                                'attribute' => 'id_nguoiki',
                                'value' => backend\models\VbDi::lookupLabel('m_nguoi_ky', 'id', $model->id_nguoiki, 'nguoi_ky'),
                            ],
                            'file_dinhkem',
                            'created_at',
                            'updated_at',
                            [
                                'attribute' => 'del_flg',
                                'value' => FHtml::showIsActiveLabel($model->del_flg),
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