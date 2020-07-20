<?php
namespace backend\components\widgets\pageToolbar;
use yii\base\Widget;

class PageToolbar extends Widget
{
    public $toolBarActions = array();

    public function run()
    {
        return $this->render('pageToolbar',
            array('toolBarActions' => $this->toolBarActions)
        );
    }
}

?>