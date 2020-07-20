<?php
use backend\assets\CustomAsset;
use backend\components\widgets\pageToolbar\PageToolbar;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
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
    <!-- BEGIN HEAD -->
    <head>
        <?= $this->render('head.php', ['baseUrl' => $baseUrl]) ?>
        <?= Html::csrfMetaTags() ?>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="<?= $this->params['bodyClass'] ?>">

    <?php $this->beginBody() ?>

    <!-- BEGIN HEADER -->
    <?= $this->render('header.php', ['user' => $user, 'baseUrl' => $baseUrl]) ?>
    <!-- END HEADER -->

    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->

    <?php if ($this->params['layoutStyle'] == "boxed") { ?>
    <?= '<div class="container">' ?>
    <?php } ?>

        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <?php if(!empty($user)) { ?>
                <?= $this->render('menu.php') ?>
                <?php } ?>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <?php
                    if ($this->params['displayPageContentHeader'] == true) { ?>
                        <!-- BEGIN PAGE HEADER-->

                        <!-- BEGIN THEME PANEL -->
                        <?php if(!empty($user) && \common\models\User::isAdmin($user->role)) { ?>
                        <?= $this->render('layout-option.php') ?>
                        <?php } ?>
                        <!-- END THEME PANEL -->

                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => ['class' => 'breadcrumb']
                        ]) ?>
                        <div class="pt-toolbar">
                            <?php if (isset($this->params['toolBarActions'])): ?>
                                <?= PageToolbar::widget(['toolBarActions' => isset($this->params['toolBarActions']) ? $this->params['toolBarActions'] : []]); ?>
                            <?php endif ?>
                        </div>

                        <!-- END PAGE HEADER-->
                    <?php } ?>
                    <?= Alert::widget() ?>
                    <!-- BEGIN PAGE CONTENT INNER -->
                    <?= $content ?>
                    <!-- END PAGE CONTENT INNER -->
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->

    <?php if ($this->params['layoutStyle'] == "boxed" && $this->params['footerStyle'] == "fixed") { ?>
    <?= '</div>' ?>
    <?php } ?>
        <!-- BEGIN FOOTER -->
        <?= $this->render('footer.php') ?>
        <!-- END FOOTER -->
    <?php if ($this->params['layoutStyle'] == "boxed" && $this->params['footerStyle'] == "default") { ?>
    <?= '</div>' ?>
    <?php } ?>

    <script>
        var GlobalsAssetsPath = '<?php echo Yii::getAlias('@web') . '/themes/metronic/assets/' ?>';
        var LayoutSettingUrl = '<?= Yii::$app->urlManager->createAbsoluteUrl(['system/setting/layout-configuration']); ?>';
        var HeaderStyle = '<?= $this->params['headerStyle'] ?>';
//        var SidebarMode = '<?//= $this->params['sidebarMode'] ?>//';
        var FooterStyle = '<?= $this->params['footerStyle'] ?>';
    </script>

    <?= $this->render('foot.php', ['baseUrl' => $baseUrl]) ?>

    <?php $this->endBody() ?>
    </body>
    <!-- END BODY -->
    </html>
<?php $this->endPage() ?>