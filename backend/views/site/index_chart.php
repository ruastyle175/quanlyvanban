<?php
/*set_time_limit(0);
$status = ['approved', 'pending'];
for ($i = 0; $i < 1000; $i++) {
    $faker = Faker\Factory::create();
    $transaction = new \backend\models\AppUserTransaction();
    $transaction->transaction_id = $faker->uuid;
    $transaction->user_id = rand(1,9999);
    $transaction->amount = $faker->randomFloat(99, 10000, 99999);
    $transaction->time = (string)$faker->dateTimeBetween('2017-01-01', '2017-12-31')->getTimestamp();
    $transaction->type = 'paypal';
    $transaction->status = $status[array_rand($status)];
    $transaction->save();
}
die;*/

/* @var $this yii\web\View */

use backend\modules\app\models\AppTransaction;
use common\widgets\chart\Chart;

$this->title = 'Index';
$this->params['breadcrumbs'][] = $this->title;
$this->params['toolBarActions'] = [
    'linkButton' => [
        [
            'htmlOptions' => [
                'href' => 'http://google.com',
                'class' => 'btn btn-info'
            ],
            'icon' => 'fa fa-globe',
            'label' => 'Google'
        ],
        [
            'htmlOptions' => [
                'href' => 'http://facebook.com',
                'class' => 'btn btn-warning'
            ],
            'icon' => 'fa fa-globe',
            'label' => 'Facebook'
        ],
    ],
    'button' => [
        [
            'htmlOptions' => [
                'onclick' => 'javascript:;',
                'class' => 'btn btn-success'
            ],
            'icon' => 'fa fa-globe',
            'label' => 'Facebook'
        ],
    ],
    'dropdown' => [
        [
            'label' => 'Facebook',
            'htmlOptions' => [
                'href' => 'http://facebook.com',
            ],
        ],
        [
            'label' => 'divider'
        ],
        [
            'label' => 'Facebook',
            'htmlOptions' => [
                'href' => 'http://facebook.com',
            ],
        ]
    ],
];
//PIE DATA
/*$all_tasks_by_status = Task::find()
    ->select(['COUNT(*) AS total', 'status'])
    ->where('MONTH(created_date) = ' . date('m', time()))
    ->groupBy(['status'])
    ->asArray()
    ->all();*/

$month = date('m', time());
$year = date('Y', time());
$date = date('d', time());

$all_tasks_by_status = \frontend\models\Auth::find();

$options = array();

$pie_options = array(
    array(
        'value' => 'facebook',
        'title' => 'Facebook',
        'color' => '#7cb5ec',
    ),
    array(
        'value' => 'google',
        'title' => 'Google+',
        'color' => '#90ed7d',
    ),
    array(
        'value' => 'twitter',
        'title' => 'Twitter',
        'color' => '#e4d354',
    ),
    array(
        'value' => 'github',
        'title' => 'Github',
        'color' => '#f15c80',
    ),
    array(
        'value' => 'normal',
        'title' => 'Normal',
        'color' => '#434348',
    ),
);

$pie_data = Chart::getPieData($all_tasks_by_status, $pie_options, 'source', false, false, false, false, false,'facebook');
//TIMELINE/AREA DATA
$area_options = array(
    'color' => 'gradient' //gradient / basic
);

$area_search = AppUserTransaction::find();
$area_data_1 = Chart::getAreaData($area_search, 'amount', 'time', 'yearly', '2017', false, false, ['status' => 'approved']);
$area_data_2 = Chart::getAreaData($area_search, 'amount', 'time', 'yearly', '2017', false, false, ['status' => 'pending']);

//SPLINE DATA
//APPROVED
$spline_search = AppUserTransaction::find();
$result_array_approved = Chart::getSplineData($spline_search, 'amount','time', '2017', ['status' => 'approved']);
$result_array_pending = Chart::getSplineData($spline_search, 'amount','time', '2017', ['status' => 'pending']);

$data = array(
    //PIE
    array(
        'portletTitle' => 'User Statistic',
        'type' => 'pie',
        'title' => "Frontend User Participant",
        'scripts' => [
            'modules/exporting',
        ],
        'enableLabel' => true,
        'series' => [
            [
                'name' => 'Brands',
                'data' => $pie_data
            ]
        ],
        'options' => $pie_options
    ),

    //TIMELINE/AREA
    array(
        'portletTitle' => "Monthly Transaction Statistic",
        'type' => 'area',
        'title' => 'Transaction amount over time ' . date("F") . ", " . date("Y"),
        'scripts' => [
            'modules/exporting',
            //'themes/grid-light',
            //'themes/dark-unica',
            //'themes/sand-signika',
        ],
        'xAxis' => [
            'type' => 'datetime'
        ],
        'yAxis' => [
            'title' => [
                'text' => 'TRANSACTION'
            ]
        ],
        'series' => [
            [
                'type' => 'area',
                'name' => 'Approved',
                'data' => $area_data_1
            ],
            [
                'type' => 'area',
                'name' => 'Pending',
                'data' => $area_data_2
            ]
        ],
        'options' => $area_options
    ),

    //SPLINE
    array(
        'portletTitle' => '2017 Transaction Statistic',
        'type' => 'spline',
        'title' => 'Monthly Total Transaction',
        'subtitle' => 'Source: Database',
        'scripts' => [
            'modules/exporting',
        ],
        'xAxis' => [
            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        ],
        'yAxis' => [
            'title' => [
                'text' => 'TRANSACTION TOTAL'
            ],
            /*'labels' => [
                'formatter' => new JsExpression("function () {
                        return this.value + '$';
                }")
            ],*/
        ],
        'series' => [
            [
                'name' => 'Approved Transaction',
                'marker' => [
                    'symbol' => 'square'
                ],
                'data' => $result_array_approved
            ],
            [
                'name' => 'Pending Transaction',
                'marker' => [
                    'symbol' => 'diamond'
                ],
                'data' => $result_array_pending
            ]
        ],
        'options' => $options
    )
);

?>
<div class="site-index">
    <?= Chart::widget(['data' => $data]) ?>
    <?php /*
    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
 */ ?>
</div>
