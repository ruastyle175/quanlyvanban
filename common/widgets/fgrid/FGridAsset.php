<?php
namespace common\widgets\fgrid;


use yii\web\AssetBundle;

class FGridAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/fgrid/assets';

    public $js = [
        'js/jquery.sortable.gridview.js',
    ];

    public $depends = [
        'yii\jui\JuiAsset',
    ];
}
