<?php

/* @var $this yii\web\View */
/* @var $model backend\modules\system\models\SystemRight */
/* @var $role_id integer */

?>
<div class="system-right-create">
    <?= $this->render('_form', [
        'model' => $model,
        'role_id' => $role_id
    ]) ?>
</div>