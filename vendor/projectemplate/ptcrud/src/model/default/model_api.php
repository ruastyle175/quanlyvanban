<?php
/**
 * This is the template for generating the model class of a specified table.
 */

use projectemplate\ptcrud\Helper;
use common\components\FHtml;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $queryClassName string query class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

//$folder_name = Inflector::camel2id(StringHelper::basename($generator->modelClass));

$all_fields = array();
foreach ($labels as $name => $label) {
    $all_fields[] = $name;
}

$image_fields = array();
$attachment_fields = array();
$file_fields =array();
foreach ($tableSchema->columns as $column) :
    if (!empty($column->comment)) {
        $check_keyword = Helper::keyword($column->comment);
        if ($check_keyword !== false) {
            $keyword = $check_keyword;
            if ($keyword == Helper::FILE_KEYWORD) {
                $data = Helper::fileDataFromDbComment($column->comment, $keyword);
                if (is_array($data) && !empty($data)) {
                    $file_fields[] = $column->name;
                    $type = $data['type'];
                    if ($type == 'image') {
                        $image_fields[] = $column->name;
                    }
                    if ($type == 'attachment') {
                        $attachment_fields[] = $column->name;
                    }
                }
            }
        }
    }
endforeach;


echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

use common\base\api\ActiveRecord;
<?php if (!empty($file_fields)) { ?>
use common\components\FApi;
use common\components\FFile;
use Yii;
<?php } ?>

/**
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
 */
class <?= $className ?>API extends ActiveRecord
{
<?php foreach ($tableSchema->columns as $column) :
    if (!empty($column->comment)) {
        $check_keyword = Helper::keyword($column->comment);
        if ($check_keyword !== false) {
            $keyword = $check_keyword;
            if ($keyword == Helper::DROPDOWN_KEYWORD) {
                $comment_data = Helper::dropdownDataFromDbComment($column->comment, $keyword);
                if (count($comment_data) != 0) {
                    $type = $comment_data['type'];
                    foreach ($comment_data['data'] as $key => $value) {
                        $constant = $value;
                        if($type == Helper::SIMPLE){
                            $constantValue = $value;
                        } else{
                            $constantValue = $key;
                        }
                        $constantValue = "'" . $constantValue . "'";
                        $constantKey = Helper::constantKey($column->name, $constant); ?>
    const <?= $constantKey ." = $constantValue;\n" ?>
<?php
                    }
                }
            }
            if ($keyword == Helper::DROPDOWN_NUMERIC_KEYWORD) {
                $comment_data = Helper::dropdownNumericDataFromDbComment($column->comment, $keyword);
                if (count($comment_data) != 0) {
                    foreach ($comment_data['data'] as $item) {
                        $constant = $item['name'];
                        $constantValue = $item['value'];
                        $constantValue = (double)$constantValue;
                        $constantKey = Helper::constantKey($column->name, $constant); ?>
    const <?= $constantKey ." = $constantValue;\n" ?>
<?php
                    }
                }
            }
        }
    }
endforeach; ?>

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '<?= $generator->generateTableName($tableName) ?>';
    }

    public function fields()
    {
        $fields = parent::fields(); // TODO: Change the autogenerated stub
<?php if (!empty($file_fields)) { ?>
        $folder = FFile::getUploadFolderName($this::tableName());
<?php foreach ($file_fields as $file_field) { ?>
<?php if (in_array($file_field, $image_fields)) { ?>
        $<?= $file_field ?> = FApi::getImageUrlForAPI($this-><?= $file_field ?>, $folder);
        $this-><?= $file_field ?> = $<?= $file_field ?>;
<?php } else { ?>
        $<?= $file_field ?> = FApi::getFileUrlForAPI($this-><?= $file_field ?>, $folder);
        $this-><?= $file_field ?> = $<?= $file_field ?>;
<?php } ?>
<?php } ?>
<?php } ?>
        return $fields;
    }

    public function apiFields()
    {
        //$fields = parent::apiFields(); // TODO: Change the autogenerated stub
        $fields = [
<?php
$hidden_fields = Helper::hiddenApiFields();
$display_fields = array();
foreach ($all_fields as $single_field) {
    if (!Helper::checkHiddenField($single_field, $hidden_fields)) {
        $display_fields[] = $single_field;
    }
}
$len = count($display_fields);
$i = 1;
foreach ($display_fields as $field) {
    if ($i == $len) {
        $following = "\n";
    } else {
        $following = ",\n";
    }
?>
            <?=  "'$field'" . $following; ?>
<?php
$i++;
}
?>
        ];
        return $fields;
    }

<?php if (count($file_fields) !=0 ) : ?>
    public function afterDelete()
    {
        //$id = $this->id;
        $uploadFolder = Yii::getAlias('@' . UPLOAD_DIR);
        $folder = FFile::getUploadFolderName($this::tableName());
<?php foreach ($file_fields as $field) : ?>
        $<?= $field ?>_old = $this-><?= $field ?>;
        if (strlen($<?= $field ?>_old) > 0) {
            if (is_file($uploadFolder . '/' . $folder . '/' . $<?= $field ?>_old)) {
                unlink($uploadFolder . '/' . $folder . '/' . $<?= $field ?>_old);
            }
        }
<?php endforeach; ?>
        parent::afterDelete(); // TODO: Change the autogenerated stub
    }
<?php endif ?>
<?php if ($generator->db !== 'db'): ?>

    /**
    * @return \yii\db\Connection the database connection used by this AR class.
    */
    public static function getDb()
    {
        return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>
}