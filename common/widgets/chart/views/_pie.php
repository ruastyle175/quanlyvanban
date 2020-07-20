<?php
/**
 * Created by PhpStorm.
 * User: Stephen PC
 * Date: 12/15/2017
 * Time: 1:07 PM
 */

/* @var $this yii\web\View */
/* @var $item array */
/* @var $options array */

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

?>
<?php
/*
$this->registerJs("
console.log(Highcharts.getOptions().colors);
Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});
");
*/
$has_colors = array_column($options, 'color');
$color_js = array();

if(count($has_colors) != 0) {

    $colors = array();

    foreach($options as $option) {
        $value = $option['value'];
        if(isset($option['color']) && count ($option['color']) != 0) {
            $colors[$value] = $option['color'];
        } else {
            $colors[$value] = "#434348";
        }
    }


    $colors_objects = json_encode($colors);

    $this->registerJs(" 

var colors = $colors_objects;

var colors_values = Object.values(colors);

var customColor = Highcharts.map(colors_values, function (color) {
                return {
                    radialGradient: {
                        cx: 0.5,
                        cy: 0.3,
                        r: 0.7
                    },
                    stops: [
                        [0, color],
                        [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                    ]
                };
        });

getColor = [];        
var i = 0;   
Object.keys(colors).forEach(function eachKey(key) { 
    getColor[key] = customColor[i];
    i++;
});
");

} else {
    $color_js = new JsExpression(
        "Highcharts.map(Highcharts.getOptions().colors, function (color) {
                return {
                    radialGradient: {
                        cx: 0.5,
                        cy: 0.3,
                        r: 0.7
                    },
                    stops: [
                        [0, color],
                        [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                    ]
                };
        })");
}


?>



<?= Highcharts::widget([
    'scripts' => $item['scripts'],
    'options' => [
        'chart' => [
            'type' => 'pie',
            'plotBackgroundColor' => null,
            'plotBorderWidth' => null,
            'plotShadow' => false,

        ],
        'title' => [
            'text' => $item['title']
        ],
        'tooltip' => [
            'pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>'
        ],
        'plotOptions' => [
            'pie' => [
                'allowPointSelect' => true,
                'cusor' => 'pointer',
                'dataLabels' => [
                    'enabled' => $item['enableLabel'],
                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                    'style' => [
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.contrastTextColor)') || 'black'
                    ],
                    'connectorColor' => 'silver'
                ],
                'showInLegend' => true
            ]
        ],
        'colors' => $color_js,
        'series' => $item['series']
    ]
]); ?>


