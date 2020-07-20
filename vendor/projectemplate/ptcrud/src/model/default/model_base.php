<?php
/**
 * This is the template for generating the model class of a specified table.
 */

use projectemplate\ptcrud\Helper;
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

$folder_name = Inflector::camel2id(StringHelper::basename($generator->modelClass));

$file_names = array();

foreach ($tableSchema->columns as $column) :
    if (!empty($column->comment)) {
        $check_keyword = Helper::keyword($column->comment);
        if ($check_keyword !== false) {
            $keyword = $check_keyword;
            if ($keyword == Helper::FILE_KEYWORD) {
                $data = Helper::fileDataFromDbComment($column->comment, $keyword);
                if (is_array($data) && !empty($data)) {
                    $file_names [] = $column->name;
                }
            }
        }
    }
endforeach;

//content here
echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

<?php if (count($file_names)!=0) : ?>
use Yii;
<?php endif; ?>

/**
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
<?php if (count($file_names)!=0) : ?>
 *
 * @property string $uploadFolder
 * @property string $tableName
<?php endif; ?>
 */
class <?= $className ?>Base extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
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

    public $tableName = '<?= $generator->generateTableName($tableName) ?>';
    public $uploadFolder = '<?= $folder_name ?>';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '<?= $generator->generateTableName($tableName) ?>';
    }

<?php if (count($file_names) != 0) : ?>
    public function afterDelete()
    {
        //$id = $this->id;
        $applicationUploadFolder = Yii::getAlias('@' . UPLOAD_DIR);
<?php foreach ($file_names as $field) : ?>
        $<?= $field ?>_old = $this-><?= $field ?>;
        if (strlen($<?= $field ?>_old) > 0) {
            if (is_file($applicationUploadFolder . '/' . $this->uploadFolder . '/' . $<?= $field ?>_old)) {
                unlink($applicationUploadFolder . '/' . $this->uploadFolder . '/' . $<?= $field ?>_old);
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