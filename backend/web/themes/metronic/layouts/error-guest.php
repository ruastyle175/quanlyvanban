<?php
/**
 * Created by PhpStorm.
 * User: Stephen PC
 * Date: 11/28/2017
 * Time: 2:49 PM
 */

use backend\assets\CustomAsset;
use yii\helpers\Html;

/* @var $content string */
/* @var $this \yii\web\View */
/* @var $user \common\models\User */

//Get base url
$asset = CustomAsset::register($this);
$baseUrl = $asset->baseUrl;
$user = Yii::$app->user->identity;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <!--[if IE 8]>
    <html lang="<?= Yii::$app->language ?>" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]>
    <html lang="<?= Yii::$app->language ?>" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="<?= Yii::$app->language ?>">
    <!--<![endif]-->
    <head>
        <link rel="shortcut icon" href="<?php echo $baseUrl . '/' . UPLOAD_DIR . '/' . WWW_DIR . '/favicon.ico' ?>">
        <title><?= Yii::$app->name ?> - <?= Html::encode($this->title) ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- END META -->

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/css/<?php echo($this->params['cssComponents']) ?>.min.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/global/css/<?php echo($this->params['cssPlugins']) ?>.min.css" id="style_plugins" rel="stylesheet" type="text/css"/>
        <!-- END THEME GLOBAL STYLES -->

        <link href="<?php echo($baseUrl) ?>/themes/metronic/assets/pages/css/error.min.css" rel="stylesheet" type="text/css"/>

        <?php $this->head() ?>
        <?= Html::csrfMetaTags() ?>
    </head>
    <body class="page-500-full-page">

    <?php $this->beginBody() ?>

    <div class="row">
        <div class="col-md-12 page-500">
            <div class=" details">
                <?= $content ?>
                <p>
                    <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Yii::$app->urlManager->createUrl(['/site/login']) ?>" class="btn red btn-outline"> Return  </a>
                    <br>
                </p>
            </div>
        </div>
    </div>


    <!--[if lt IE 9]>
    <?php $this->registerJsFile($baseUrl . "/themes/metronic/assets/global/plugins/respond.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]) ?>
    <?php $this->registerJsFile($baseUrl . "/themes/metronic/assets/global/plugins/excanvas.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]) ?>
    <![endif]-->

    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

    <?php //$this->registerJsFile($baseUrl . "/themes/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]) ?>

    <?php $this->registerJsFile($baseUrl . "/themes/metronic/assets/global/plugins/js.cookie.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]) ?>
    <?php $this->registerJsFile($baseUrl . "/themes/metronic/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]) ?>
    <?php $this->registerJsFile($baseUrl . "/themes/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]) ?>
    <?php $this->registerJsFile($baseUrl . "/themes/metronic/assets/global/plugins/jquery.blockui.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]) ?>
    <?php $this->registerJsFile($baseUrl . "/themes/metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]) ?>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <?php $this->registerJsFile($baseUrl . "/themes/metronic/assets/global/scripts/app.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]) ?>
    <!-- END THEME GLOBAL SCRIPTS -->

    <!-- CUSTOM  SCRIPTS -->
    <?php $this->registerJsFile($baseUrl . "/themes/metronic/assets/custom/scripts/custom.js", ['depends' => [\yii\web\JqueryAsset::className()]]) ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>