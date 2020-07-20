<?php

use common\components\FConstant;
use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;

/* @var $this yii\web\View */
/* @var $model common\models\User */
?>
<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'User';
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
    <div class="user-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'username',
                'name',
                [
                    'attribute' => 'image',
                    'value' => FHtml::showImage($model->image, 300, 'user'),
                    'format' => 'html',
                ],
                [
                    'attribute' => 'overview',
                    'format' => 'html',
                ],
                //'auth_key',
                //'password_hash',
                //'password_reset_token',
                'email:email',
                [
                    'attribute' => 'role',
                    'value' => common\models\User::roleLabel($model->role),
                    'format' => 'html',
                    'visible' => FConstant::GLOBAL_ACCESS_CONTROL_MODE == FConstant::MODE_ROLE_BAC,
                ],
                [
                    'label' => 'Role',
                    'value' => common\models\User::roleLabels($model),
                    'format' => 'html',
                    'visible' => FConstant::GLOBAL_ACCESS_CONTROL_MODE == FConstant::MODE_RIGHT_BAC,
                ],
                [
                    'attribute' => 'status',
                    'value' => common\models\User::statusLabel($model->status),
                    'format' => 'html',
                ],
                'created_at',
                'updated_at',
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
                            'username',
                            'name',
                            [
                                'attribute' => 'image',
                                'value' => FHtml::showImage($model->image, 500, 'user'),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'overview',
                                'format' => 'html',
                            ],
                            'auth_key',
                            'password_hash',
                            'password_reset_token',
                            'email:email',
                            [
                                'attribute' => 'role',
                                'value' => common\models\User::roleLabel($model->role),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'status',
                                'value' => common\models\User::statusLabel($model->status),
                                'format' => 'html',
                            ],
                            'created_at',
                            'updated_at',
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