<?php
/* @var $data array */
/* @var $this \yii\web\View */
/* @var $options array */
foreach ($data as $item) {
    $type = $item['type'];
    $options = $item['options'];
    $title = isset($item['portletTitle']) ? $item['portletTitle'] : 'Chart Title';
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green bold uppercase"><?= $title ?></span>
                    </div>
                    <div class="tools">
                        <a href="#" class="collapse"></a>
                        <a href="#" class="fullscreen"></a>
                    </div>
                    <div class="actions">
                        <?php /*
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-cloud-upload"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-wrench"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-trash"></i>
                        </a>
                        */ ?>
                    </div>
                </div>
                <div class="portlet-body">
                    <div>
                        <?= $this->render("_$type", ['item' => $item, 'options' => $options]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>