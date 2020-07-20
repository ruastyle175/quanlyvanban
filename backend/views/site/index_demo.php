<?php

use yii\web\JsExpression;
use yii\widgets\ActiveForm;

$model = new \backend\modules\content\models\ContentAPI();
?>

 <?php
            $form = ActiveForm::begin([
                'id' => 'settings-form',
            ]);

echo $form->field($model, 'coordinates')->widget('\pigolab\locationpicker\CoordinatesPicker' , [
    'key' => 'AIzaSyBGwy65kODuWegyS5NO87-d_rkrGAbBeX0' ,	// require , Put your google map api key
    'valueTemplate' => '{latitude},{longitude}' , // Optional , this is default result format
    'options' => [
        'style' => 'width: 100%; height: 400px',  // map canvas width and height
    ] ,
    'enableSearchBox' => true , // Optional , default is true
    'searchBoxOptions' => [ // searchBox html attributes
        'style' => 'width: 300px;', // Optional , default width and height defined in css coordinates-picker.css
    ],
    'searchBoxPosition' => new JsExpression('google.maps.ControlPosition.TOP_LEFT'), // optional , default is TOP_LEFT
    'mapOptions' => [
        // google map options
        // visit https://developers.google.com/maps/documentation/javascript/controls for other options
        'mapTypeControl' => true, // Enable Map Type Control
        'mapTypeControlOptions' => [
            'style'    => new JsExpression('google.maps.MapTypeControlStyle.HORIZONTAL_BAR'),
            'position' => new JsExpression('google.maps.ControlPosition.TOP_LEFT'),
        ],
        'streetViewControl' => true, // Enable Street View Control
    ],
    'clientOptions' => [
        // jquery-location-picker options
        'radius'    => 300,
        'addressFormat' => 'street_number',
    ]
]);
?>

<?php ActiveForm::end() ?>
