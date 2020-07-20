<?php
/* @var $baseUrl string*/

use common\components\FFile;

/* @var $user \common\models\User */
?>
<div class="<?= $this->params['headerClass'] ?>">
    <!-- BEGIN HEADER INNER -->
    <div class="<?= $this->params['headerInnerClass'] ?>">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?php echo Yii::$app->urlManager->createUrl(['/site/index']) ?>">
                <img src="<?php echo $baseUrl ?>/themes/metronic/assets/layouts/layout/img/logo.png" alt="logo"
                     class="logo-default">
            </a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <?php if(!empty($user)) { ?>
                <li class="dropdown dropdown-user dropdown-dark">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="<?= FFile::getImageUrl($user->image, 'user') ?>">
                        <span class="username username-hide-mobile"><?= $user->name ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li><a href="<?php echo Yii::$app->urlManager->createUrl(['system/setting/profile']) ?>"><i class="icon-user"></i> Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo Yii::$app->urlManager->createUrl(['/site/logout']) ?>" data-method="post"><i class="icon-key"></i> Log Out </a></li>
                    </ul>
                </li>
                <?php } ?>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>