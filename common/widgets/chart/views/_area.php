<?php
/**
 * Created by PhpStorm.
 * User: Stephen PC
 * Date: 12/11/2017
 * Time: 10:39 AM
 */
/* @var $this yii\web\View */
/* @var $item array */
/* @var $options array */

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

$data = array();
$i = 0;
foreach($item['series'] as $series) {
    if($options['color'] == 'gradient') {
        $series['fillColor'] = [
            'linearGradient' => [
                'x1' => 0,
                'y1' => 0,
                'x2' => 0,
                'y2' => 1
            ],
            'stops' => [
                [0, new JsExpression("Highcharts.getOptions().colors[$i]")],
                [1, new JsExpression("Highcharts.Color(Highcharts.getOptions().colors[$i]).setOpacity(0).get('rgba')")]
            ]
        ];
    }
    $i++;

    $data[] = $series;
}

/*$this->registerJs("
    Highcharts.setOptions({
        global: {
            timezone: 'Europe/Berlin'
        }
    });
");*/

?>

<!--TIMELINE // AREA-->
<?= Highcharts::widget([
    'scripts' => $item['scripts'],
    'options' => [
        'chart' => [
            'zoomType' => 'x'
        ],
        'title' => [
            'text' => $item['title']
        ],
        'subtitle' => [
            'text' => new JsExpression("document.ontouchstart === undefined ? 'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'")
        ],
        /*'time' => [
            'timezone' => 'America/Los_Angeles'
        ],*/
        'xAxis' => $item['xAxis'],
        'yAxis' => $item['yAxis'],
        'plotOptions' => [
            'area' => [
                /*'fillColor' => [
                    'linearGradient' => [
                        'x1' => 0,
                        'y1' => 0,
                        'x2' => 0,
                        'y2' => 1
                    ],
                    'stops' => [
                        [0, new JsExpression('Highcharts.getOptions().colors[0]')],
                        [1, new JsExpression("Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')")]
                    ]
                ],*/
                'marker' => [
                    'radius' => 2
                ],
                'lineWidth' => 1,
                'states' => [
                    'hover' => [
                        'lineWidth' => 1
                    ]
                ],
                'threshold' => null
            ]
        ],
        'series' => $data
    ]
]); ?>


