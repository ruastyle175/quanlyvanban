<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;

/* @var $this yii\web\View */
/* @var $model backend\modules\app\models\AppUser */
?>
<?php if (!Yii::$app->request->isAjax) {
    $this->title = 'App User';
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
    <div class="app-user-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'avatar',
                    'value' => FHtml::showImage($model->avatar, 300, 'app-user'),
                    'format' => 'html',
                ],
                'name',
                'username',
                'email:email',
                'password',
                'auth_id',
                'auth_key',
                'password_hash',
                'password_reset_token',
                [
                    'attribute' => 'description',
                    'format' => 'html',
                ],
                [
                    'attribute' => 'content',
                    'format' => 'html',
                ],
                [
                    'attribute' => 'gender',
                    'value' => backend\modules\app\models\AppUser::genderLabel($model->gender),
                    'format' => 'html',
                ],
                'dob',
                'phone',
                'address',
                'city',
                'state',
                [
                    'attribute' => 'country',
                    'value' => backend\modules\app\models\AppUser::lookupLabel('system_country', 'country_name', $model->country, 'country_name'),
                ],
                'role',
                [
                    'attribute' => 'type',
                    'value' => backend\modules\app\models\AppUser::typeLabel($model->type),
                    'format' => 'html',
                ],
                [
                    'attribute' => 'status',
                    'value' => backend\modules\app\models\AppUser::statusLabel($model->status),
                    'format' => 'html',
                ],
                [
                    'attribute' => 'is_online',
                    'value' => FHtml::showIsActiveLabel($model->is_online),
                    'format' => 'html',
                ],
                [
                    'attribute' => 'is_active',
                    'value' => FHtml::showIsActiveLabel($model->is_active),
                    'format' => 'html',
                ],

                'latitude',
                'longitude',
                'weight',
                'height',
                'balance',
                'rate',
                'rate_count',
                'last_login',
                'last_activity',

                'created_date',
                'modified_date',
            ],
        ]) ?>
    </div>
<?php } else { ?>
    <div class="<?= $this->params['portletStyle'] ?>">
        <div class="portlet-title">
            <div class="caption font-dark">
                <span class="caption-subject bold uppercase"><i
                            class="<?php echo $this->params['mainIcon'] ?>"></i> <?= $this->title ?></span>
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
                                'attribute' => 'avatar',
                                'value' => FHtml::showImage($model->avatar, 500, 'app-user'),
                                'format' => 'html',
                            ],
                            'name',
                            'username',
                            'email:email',
                            'password',
                            'auth_id',
                            'auth_key',
                            'password_hash',
                            'password_reset_token',
                            [
                                'attribute' => 'description',
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'content',
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'gender',
                                'value' => backend\modules\app\models\AppUser::genderLabel($model->gender),
                                'format' => 'html',
                            ],
                            'dob',
                            'phone',
                            'address',
                            'city',
                            'state',
                            [
                                'attribute' => 'country',
                                'value' => backend\modules\app\models\AppUser::lookupLabel('system_country', 'country_name', $model->country, 'country_name'),
                            ],
                            'role',
                            [
                                'attribute' => 'type',
                                'value' => backend\modules\app\models\AppUser::typeLabel($model->type),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'status',
                                'value' => backend\modules\app\models\AppUser::statusLabel($model->status),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'is_online',
                                'value' => FHtml::showIsActiveLabel($model->is_online),
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'is_active',
                                'value' => FHtml::showIsActiveLabel($model->is_active),
                                'format' => 'html',
                            ],
                            'created_date',
                            'modified_date',
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