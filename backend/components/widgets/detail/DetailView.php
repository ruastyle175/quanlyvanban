<?php
/**
 * Created by PhpStorm.
 * User: Stephen PC
 * Date: 11/8/2017
 * Time: 3:40 PM
 */

namespace backend\components\widgets\detail;

use yii\base\Widget;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $model ActiveRecord */

/**
 * @property array $model
 * @property string $model_dir
 * @property string $preset
 *
 */
class DetailView extends Widget
{
    public $model;
    public $model_dir;
    public $preset;

    public function init()
    {
        parent::init();
        $model = $this->model;
        $this->model_dir = Inflector::camel2id(StringHelper::basename(get_class($model)));
    }

    public function run()
    {
        return $this->render('detail_view', ['model' => $this->model, 'model_dir' => $this->model_dir, 'preset' => $this->preset]);
    }
}

?>