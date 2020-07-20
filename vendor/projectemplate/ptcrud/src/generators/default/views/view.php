<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use projectemplate\ptcrud\Helper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$modelClass = StringHelper::basename($generator->modelClass);

$folder_name = Inflector::camel2id($modelClass);
$lower_name = str_replace('-','_',$folder_name);
$tableSchema = $generator->getTableSchema();

$lookup = array();
$dropdown = array();
$editor = array();
$color = array();
$image = array();

foreach ($tableSchema->columns as $column) :
    if($column->type == "text" || ($column->type == "string" && $column->size >= 500)){
        $editor[] = $column->name;
    }
    if (!empty($column->comment)) {
        $keyword = Helper::keyword($column->comment);
        if ($keyword !== false) {
            if ($keyword == Helper::DROPDOWN_KEYWORD || $keyword == Helper::DROPDOWN_NUMERIC_KEYWORD) {
                $dropdown[] = $column->name;
            }
            if ($keyword == Helper::LOOKUP_KEYWORD){
                $lookup[$column->name] = Helper::lookupDataFromDbComment($column->comment, $keyword);
            }
            if ($keyword == Helper::COLOR_KEYWORD) {
                $has_color = true;
                $color[] = $column->name;
            }
            if ($keyword == Helper::FILE_KEYWORD) {
                $data = Helper::fileDataFromDbComment($column->comment, $keyword);
                if (is_array($data) && !empty($data)) {
                    $type = $data['type'];
                    if ($type == 'image') {
                        $image[] = $column->name;
                    }
                }
            }
        }
    }
endforeach;
    
echo "<?php\n";
?>

use yii\widgets\DetailView;
use yii\helpers\Html;
use common\components\FHtml;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
?>
<?= "<?php" ?> if (!Yii::$app->request->isAjax) {
    $this->title = <?= $generator->generateString(Inflector::camel2words($modelClass)) ?>;
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => 'index'];
    $this->params['breadcrumbs'][] = Yii::t('common', 'View');
    $this->params['toolBarActions'] = array(
        'linkButton' => array(),
        'button' => array(),
        'dropdown' => array(),
    );
    $this->params['mainIcon'] = 'fa fa-list';
}<?= " ?>\n" ?>
<?= '<?php if (Yii::$app->request->isAjax) { ?>' . "\n" ?>
    <div class="<?= Inflector::camel2id($modelClass) ?>-view">
        <?= "<?= " ?>DetailView::widget([
            'model' => $model,
            'attributes' => [
<?php
    if (($tableSchema = $generator->getTableSchema()) === false) {
        foreach ($generator->getColumnNames() as $name) {
            echo "           '" . $name . "',\n";
        }
    } else {
        foreach ($generator->getTableSchema()->columns as $column) {
            $name = $column->name;
            $format = $generator->generateColumnFormat($column);
            //image
            if(in_array($name, $image)) {
                echo "                " . "[" . "\n";
                echo "                    " . "'attribute' => '".$name."'," . "\n";
                echo "                    " . "'value' => FHtml::showImage(\$model->".$name.", 300, '". $folder_name ."')". ",\n";
                echo "                    " . "'format' => 'html'". ",\n";
                echo "                " . "]" . ",\n";
            }
            //color
            elseif (in_array($name, $color)) {
                echo "                " . "[" . "\n";
                echo "                    " . "'attribute' => '".$name."'," . "\n";
                echo "                    " . "'value' => FHtml::showColor(\$model->".$name.")". ",\n";
                echo "                    " . "'format' => 'html'". ",\n";
                echo "                " . "]" . ",\n";
            }
            else{
                //boolean
                if($column->dbType == 'tinyint(1)')
                {
                    echo "                " . "[" . "\n";
                    echo "                    " . "'attribute' => '".$name."'," . "\n";
                    echo "                    " . "'value' => FHtml::showIsActiveLabel(\$model->".$name.")". ",\n";
                    echo "                    " . "'format' => 'html'". ",\n";
                    echo "                " . "]" . ",\n";
                }
                else{
                    //html editor
                    if(in_array($name, $editor)){
                        echo "                " . "[" . "\n";
                        echo "                    " . "'attribute' => '".$column->name."'," . "\n";
                        echo "                    " . "'format' => 'html'". ",\n";
                        echo "                " . "]" . ",\n";
                    }
                    //lookup
                    elseif(array_key_exists($name, $lookup)){
                        if(count($lookup[$name]) > 0){
                            echo "                " . "[" . "\n";
                            echo "                    " . "'attribute' => '".$column->name."'," . "\n";
                            echo "                    " . "'value' => ".ltrim($generator->modelClass,'\\')."::lookupLabel('".$lookup[$name]['table']."', '".$lookup[$name]['key']."', \$model->". $name .", '".$lookup[$name]['value']."')". ",\n";
                            echo "                " . "]" . ",\n";
                        }else{
                            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        }
                    }
                    //dropdown
                    elseif (in_array($name, $dropdown)){
                        echo "                " . "[" . "\n";
                        echo "                    " . "'attribute' => '".$column->name."'," . "\n";
                        echo "                    " . "'value' => ".ltrim($generator->modelClass,'\\')."::". $name ."Label(\$model->". $name .")". ",\n";
                        echo "                    " . "'format' => 'html'". ",\n";
                        echo "                " . "]" . ",\n";
                    }
                    //others
                    else {
                        echo "                '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                    }
                }
            }
        }
    }
?>
            ],
        ]) ?>
    </div>
<?= '<?php } else { ?>' . "\n" ?>
    <div class="<?= "<?=" ?> $this->params['portletStyle'] <?= "?>" ?>">
        <div class="portlet-title">
            <div class="caption font-dark">
                <span class="caption-subject bold uppercase"><i class="<?= "<?php " ?>echo $this->params['mainIcon'] <?= "?>" ?>"></i> <?= "<?= " ?>$this->title<?= " ?>" ?></span>
                <span class="caption-helper"><?= "<?= " ?>Yii::t('common', 'View') <?= "?>" ?></span>
            </div>
            <div class="tools">
                <a href="#" class="collapse"></a>
                <a href="#" class="fullscreen"></a>
            </div>
            <div class="actions">
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12">
                    <?= "<?= " ?>DetailView::widget([
                        'model' => $model,
                        'attributes' => [
<?php if (($tableSchema = $generator->getTableSchema()) === false) {
                            foreach ($generator->getColumnNames() as $name) {
                                echo "            '" . $name . "',\n";
                            }
                        } else {
                            foreach ($generator->getTableSchema()->columns as $column) {
                                $format = $generator->generateColumnFormat($column);
                                $name = $column->name;
                                //image
                                if (in_array($name, $image)) {
                                    echo "                            " . "[" . "\n";
                                    echo "                                " . "'attribute' => '" . $name . "'," . "\n";
                                    echo "                                " . "'value' => FHtml::showImage(\$model->" . $name . ", 500, '" . $folder_name . "')" . ",\n";
                                    echo "                                " . "'format' => 'html'" . ",\n";
                                    echo "                            " . "]" . ",\n";
                                }
                                //color
                                elseif (in_array($name, $color)) {
                                    echo "                            " . "[" . "\n";
                                    echo "                                " . "'attribute' => '" . $name . "'," . "\n";
                                    echo "                                " . "'value' => FHtml::showColor(\$model->" . $name . ")" . ",\n";
                                    echo "                                " . "'format' => 'html'" . ",\n";
                                    echo "                            " . "]" . ",\n";
                                }
                                else {
                                    //boolean
                                    if ($column->dbType == 'tinyint(1)') {
                                        echo "                            " . "[" . "\n";
                                        echo "                                " . "'attribute' => '" . $name . "'," . "\n";
                                        echo "                                " . "'value' => FHtml::showIsActiveLabel(\$model->" . $name . ")" . ",\n";
                                        echo "                                " . "'format' => 'html'" . ",\n";
                                        echo "                            " . "]" . ",\n";
                                    } else {
                                        //html editor
                                        if(in_array($name, $editor)){
                                            echo "                            " . "[" . "\n";
                                            echo "                                " . "'attribute' => '".$column->name."'," . "\n";
                                            echo "                                " . "'format' => 'html'". ",\n";
                                            echo "                            " . "]" . ",\n";
                                        }
                                        //lookup
                                        elseif(array_key_exists($name, $lookup)){
                                            if(count($lookup[$name]) > 0){
                                                echo "                            " . "[" . "\n";
                                                echo "                                " . "'attribute' => '".$column->name."'," . "\n";
                                                echo "                                " . "'value' => ".ltrim($generator->modelClass,'\\')."::lookupLabel('".$lookup[$name]['table']."', '".$lookup[$name]['key']."', \$model->". $name .", '".$lookup[$name]['value']."')". ",\n";
                                                echo "                            " . "]" . ",\n";
                                            }else{
                                                echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                            }
                                        }
                                        //dropdown
                                        elseif (in_array($name, $dropdown)){
                                            echo "                            " . "[" . "\n";
                                            echo "                                " . "'attribute' => '".$column->name."'," . "\n";
                                            echo "                                " . "'value' => ".ltrim($generator->modelClass,'\\')."::". $name ."Label(\$model->". $name .")". ",\n";
                                            echo "                                " . "'format' => 'html'". ",\n";
                                            echo "                            " . "]" . ",\n";
                                        }
                                        //others
                                        else {
                                            echo "                            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                        }
                                    }
                                }
                            }
                        } ?>
                        ],
                    ]) ?>
                    <p>
                        <?= "<?= " ?>Html::a(Yii::t('common', 'Update'), ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
                        <?= "<?= " ?>Html::a(Yii::t('common', 'Delete'), ['delete', <?= $urlParams ?>], ['class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item ?',
                                'method' => 'post',
                            ],
                        ]) ?>
                        <?= "<?= " ?>Html::a(Yii::t('common', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?= '<?php } ?>' ?>