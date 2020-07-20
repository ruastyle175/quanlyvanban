<?php

namespace common\widgets\chart;

use DateInterval;
use DatePeriod;
use DateTime;
use yii\base\Widget;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\web\JsExpression;

class Chart extends Widget
{
    public $data = array();

    public function run()
    {
        return $this->render('chart',
            array('data' => $this->data)
        );
    }

    /**
     * @param $all_items | $result of query group by field
     * @param array $options | colors array predefined
     * @param string $field | field we use for count
     * @param boolean $year | string $year | boolean
     * @param boolean $month | string $month | 08
     * @param boolean $date | string $date | 25
     * @param boolean $filter_type | string $filter_type | 25 | yearly/monthly/daily
     * @param string $time_field | datetime format in db
     * @param boolean $important | string $important | important field value
     * @return array
     */
    public static function getPieData($all_items, $options, $field = 'status', $time_field, $filter_type = false, $year = false, $month = false, $date = false, $important = false)
    {
        $current_month = date('m', time());
        $current_year = date('Y', time());
        $current_date = date('d', time());

        if (!is_array($all_items)) {
            /* @var ActiveQuery $all_items */
            if ($important) {
                $all_items->orderBy("`$field` = '$important' DESC");
            }

            $date = $date ? $date : $current_date;
            $month = $month ? $month : $current_month;
            $year = $year ? $year : $current_year;

            if($filter_type == "daily") {
                $all_items->where("DATE($time_field) = $date AND MONTH($time_field) = $month AND YEAR($time_field) = $year");
            } elseif($filter_type == "monthly") {
                $all_items->where("MONTH($time_field) = $month AND YEAR($time_field) = $year");
            } elseif($filter_type == 'yearly') {
                $all_items->where("YEAR($time_field) = $year");
            }
            $all_items = $all_items
                ->select(['COUNT(*) AS total', $field])
                ->groupBy([$field])
                ->asArray()
                ->all();
        }

        $item_count = null;
        $pie_data = array();
        /* @var array $all_items */
        $total = array_sum(array_column($all_items, 'total'));
        $values = array_column($options, 'value');
        $colors = array_column($options, 'color');
        $titles = array_column($options, 'title');

        $pieces_exist = array();

        foreach ($all_items as $pos => $item) {
            $key = $item[$field];
            $pieces_exist[] = $key;
            $item_count = $item['total'];
            $item_data = [
                'name' => $titles[$pos],
                'y' => $item_count / $total
            ];

            if (count($colors) != 0) {
                $item_data['color'] = new JsExpression("getColor['$key']");
            }

            if (isset($important) && $important == $key) {
                $item_data = array_merge($item_data, ['sliced' => true, 'selected' => true]);
            }
            $pie_data [] = $item_data;
        }

        $not_appear = array_diff($values, $pieces_exist);

        foreach ($not_appear as $invisible) {
            $invisible_data = ['name' => ucwords($invisible), 'y' => null];
            if (count($colors) != 0) {
                $invisible_data['color'] = new JsExpression("getColor['$invisible']");
            }
            $pie_data[] = $invisible_data;
        }

        return $pie_data;
    }

    public static function getAreaData($query, $field, $time_field, $filter_type, $year = false, $month = false, $date = false, $condition = [])
    {
        /* @var ActiveQuery $query */
        $connection = \Yii::$app->db;
        $offset = date('P');
        $connection->createCommand("SET time_zone = '$offset'")->execute();

        $current_month = date('m', time());
        $current_year = date('Y', time());
        $current_date = date('d', time());

        $date = $date ? $date : $current_date;
        $month = $month ? $month : $current_month;
        $year = $year ? $year : $current_year;

        $condition = array_merge($condition, ["FROM_UNIXTIME(`$time_field`, '%Y')" => $year]);
        if($filter_type == "monthly") {
            $condition = array_merge($condition, ["FROM_UNIXTIME(`$time_field`, '%m')" => $month]);
        } elseif($filter_type == "daily") {
            $condition = array_merge($condition, ["FROM_UNIXTIME(`$time_field`, '%d')" => $date]);
        }

        $all_items = $query
            ->select(["sum($field) as total", "time"])
            ->where($condition)
            ->groupBy( new Expression("FROM_UNIXTIME(`$time_field`, '%Y-%m-%d')"))
            ->asArray()
            ->all();

        $area_data = array();
        /* @var array $search */

        foreach ($all_items as $item) {
            if(is_numeric($item['time'])) {
                $time = $item['time'];
            } else {
                $time = strtotime($item['time']);
            }
            $area_data[] = [$time * 1000, floatval($item['total'])
            ];
        }
        return $area_data;
    }

    public static function getSplineData($query, $field, $time_field, $year, $condition = [])
    {

//symbols
//default
//https://github.com/highcharts/highcharts/tree/master/samples/graphics
//custom
//http://jsfiddle.net/gh/get/library/pure/highcharts/highcharts/tree/master/samples/highcharts/plotoptions/series-marker-symbol/

//THIS CASE NO ALIAS
//SELECT month_number, COALESCE(SUM(amount), 0) as total
//FROM all_month
//LEFT JOIN app_user_transaction ON month_number = FROM_UNIXTIME(time, '%m')
//WHERE FROM_UNIXTIME(`time`, '%Y') = 2017 AND `status` = 'approved'
//GROUP BY month_number
//array_map('floatval', array_column($yearly_pending, 'total'))

        /*$yearly_approved = Yii::$app->db->createCommand("
            SELECT FROM_UNIXTIME(`time`, '%m') as month_number, COALESCE(SUM(amount), 0) as total
        FROM app_user_transaction
        WHERE FROM_UNIXTIME(`time`, '%Y') = $year AND `status` = 'approved'
        GROUP BY month_number
        ")->queryAll();*/

        $current_year = date('Y', time());
        $year = $year ? $year : $current_year;
        /* @var ActiveQuery $query */

        $input = $query->select(["sum($field) as total", "FROM_UNIXTIME(`$time_field`, '%m') as month_number"])
            ->where($condition)
            ->groupBy('month_number')
            //->groupBy(new \yii\db\Expression('FROM_UNIXTIME(`$time_field`, "%m")'))
            ->asArray()
            ->all();

        $months = Chart::getMonths();

        $i = 0;
        $max = 0;
        $max_amount_month = '';
        $output = array();

        foreach ($input as $monthly_data) {
            $month = $monthly_data['month_number'];
            if ($monthly_data['total'] > $max) {
                $max = $monthly_data['total'];
                $max_amount_month = $month;
            }
            $output[$month] = floatval($monthly_data['total']);
            $i++;
        }

        $output[$max_amount_month] = [
            'y' => floatval($max),
            'marker' => [
                'symbol' => 'url(https://www.highcharts.com/samples/graphics/sun.png)'
            ]
        ];

        $check_hollow = array_diff($months, array_keys($output));
        if($check_hollow != 0) {
            foreach ($check_hollow as $hollow) {
                $output[$hollow] = 0;
            }
        }
        ksort($output, SORT_NUMERIC);
        return array_values($output);
    }

    public static function getMonths()
    {
        return ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
    }

    public static function getDates($year = false) {
        if(!$year) {
            $year = date('Y', time());
        }

        $begin = new DateTime('2013-02-01');
        $end = new DateTime('2013-02-13');

        $date_range = new DatePeriod($begin, new DateInterval('P1D'), $end);

        $dates = array();
        /* @var $date DateTime*/
        foreach($date_range as $date){
           $dates[] = $date->format("Y-m-d");
        }

        return $dates;
    }
}

?>