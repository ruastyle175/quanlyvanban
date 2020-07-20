<?php
/**
 * Created by PhpStorm.
 * User: Stephen PC
 * Date: 12/11/2017
 * Time: 10:52 AM
 */

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $item array */

?>

    <!--SPLINE-->
<?= Highcharts::widget([
    'scripts' => $item['scripts'],
    'options' => [
        'chart' => [
            'type' => 'spline'
        ],
        'title' => [
            'text' => $item['title']
        ],
        'subtitle' => [
            'text' => $item['subtitle']
        ],
        'xAxis' => $item['xAxis'],
        'yAxis' => $item['yAxis'],
        'tooltip' => [
            'crosshairs' => true,
            'shared' => true
        ],
        'plotOptions' => [
            'spline' => [
                'marker' => [
                    'radius' => 4,
                    'lineColor' => '#666666',
                    'lineWidth' => 1
                ]
            ]
        ],
        'series' => $item['series']
    ]
]); ?>