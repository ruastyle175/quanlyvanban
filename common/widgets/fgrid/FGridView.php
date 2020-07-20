<?php
namespace common\widgets\fgrid;

use kartik\grid\GridView;
use yii\helpers\Url;

/**
 * Customized version of Yii2 GridView widget.
 * New features:
 * sortable: Depend on himiklab\sortablegrid
 */

class FGridView extends GridView
{
    /** @var string|array Sort action */
    public $sortableAction = ['sort'];

    public function init()
    {
        parent::init();
        $this->sortableAction = Url::to($this->sortableAction);
    }

    public function run()
    {
        $this->registerWidget();
        parent::run();
    }

    protected function registerWidget()
    {
        $view = $this->getView();
        $view->registerJs("jQuery('#{$this->options['id']}').SortableGridView('{$this->sortableAction}');");
        FGridAsset::register($view);
    }
}
