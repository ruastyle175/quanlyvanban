<?php

use backend\modules\system\models\SystemSetting;
use common\components\FConstant;

$company_name_setting = SystemSetting::getSettingValueByKey(FConstant::COMPANY_NAME);
?>
<div class="page-footer">

    <?php if ($this->params['layoutStyle'] == "boxed" && $this->params['footerStyle'] == "fixed") { ?>
    <?= '<div class="container">' ?>
    <?php } ?>

    <div class="page-footer-inner"> <?php echo date('Y', time()) ?>
        &copy; <?= $company_name_setting[FConstant::COMPANY_NAME] ?>
        <a href="javascript:" title="Our Website" target="_blank">Our Website</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>

    <?php if ($this->params['layoutStyle'] == "boxed" && $this->params['footerStyle'] == "fixed") { ?>
    <?= '</div>' ?>
    <?php } ?>

</div>
