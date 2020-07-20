<?php

namespace backend\modules\system\models;

use common\components\FConstant;
use common\components\FHtml;
use yii\base\Model;
use Yii;

/**
 *
 * @property integer $id
 * @property string $admin_email
 * @property string $support_email
 * @property string $api_key
 * @property string $map_api_key
 * @property string $pem
 * @property string $company_name
 * @property string $company_description
 * @property string $company_homepage
 * @property string $access_control_mode
 * @property string $frontend_theme
 *
 *
 */
class SettingForm extends Model
{
    //application
    public $admin_email;
    public $support_email;
    public $api_key;
    public $map_api_key;
    public $pem;
    public $company_name;
    public $company_description;
    public $company_homepage;
    public $access_control_mode;

    //frontend
    public $frontend_theme;


    /**
     * @return array validation rules for model attributes.
     */

    public function rules()
    {
        return [
            [['admin_email', 'frontend_theme'], 'string', 'max' => 300],
            [[
                'api_key',
                'map_api_key',
                'company_name',
                'company_homepage',
                'support_email',
                'access_control_mode'
            ], 'string', 'max' => 300],
            [['company_description'], 'string'],
            ['pem', 'file', 'extensions' => ['pem'], 'skipOnEmpty' => true, 'minSize' => 1],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'admin_email' => Yii::t('common', 'Admin Email'),
            'api_key' => Yii::t('common', 'Google API Key'),
            'map_api_key' => Yii::t('common', 'Google Map API Key'),
            'pem' => Yii::t('common', 'Pem File'),
            'company_name' => Yii::t('common', 'Company Name'),
            'company_description' => Yii::t('common', 'Company Description'),
            'company_homepage' => Yii::t('common', 'Company Homepage'),
            'support_email' => Yii::t('common', 'Support Email'),
            'access_control_mode' => Yii::t('common', 'Access Control Mode'),

            'fronted_theme' => Yii::t('common', 'Frontend Theme'),
        );
    }

    /**
     * Load data for model SettingForm
     */

    public function loadModel()
    {
        //$model = new Setting();

        $load = SystemSetting::getSettingValueByKey(
            [
                FConstant::ADMIN_EMAIL,
                FConstant::SUPPORT_EMAIL,
                FConstant::GOOGLE_API_KEY,
                FConstant::GOOGLE_MAP_API_KEY,
                FConstant::PEM_FILE,
                FConstant::COMPANY_NAME,
                FConstant::COMPANY_DESCRIPTION,
                FConstant::COMPANY_HOMEPAGE,
            ]
        );

        $mode = FConstant::GLOBAL_ACCESS_CONTROL_MODE;

        if ($mode == FConstant::MODE_ROLE_BAC) {
            $old_mode = 'self::MODE_ROLE_BAC';
        } else {
            $old_mode = 'self::MODE_RIGHT_BAC';
        }

        $this->access_control_mode =  $old_mode;

        $this->admin_email = $load[FConstant::ADMIN_EMAIL];
        $this->support_email = $load[FConstant::SUPPORT_EMAIL];
        $this->api_key = $load[FConstant::GOOGLE_API_KEY];
        $this->map_api_key = $load[FConstant::GOOGLE_MAP_API_KEY];
        $this->pem = $load[FConstant::PEM_FILE];
        $this->company_name = $load[FConstant::COMPANY_NAME];
        $this->company_description = $load[FConstant::COMPANY_DESCRIPTION];
        $this->company_homepage = $load[FConstant::COMPANY_HOMEPAGE];

        $this->frontend_theme = FHtml::getFrontendLayoutConfiguration('frontendTheme');

    }


    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function save()
    {
        $isSave = FALSE;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new SystemSetting();

            $model->setSettingValueByKey(FConstant::ADMIN_EMAIL, $this->admin_email);
            $model->setSettingValueByKey(FConstant::SUPPORT_EMAIL, $this->support_email);
            $model->setSettingValueByKey(FConstant::GOOGLE_API_KEY, $this->api_key);
            $model->setSettingValueByKey(FConstant::GOOGLE_MAP_API_KEY, $this->map_api_key);
            $model->setSettingValueByKey(FConstant::PEM_FILE, $this->pem);
            $model->setSettingValueByKey(FConstant::COMPANY_NAME, $this->company_name);
            $model->setSettingValueByKey(FConstant::COMPANY_DESCRIPTION, $this->company_description);
            $model->setSettingValueByKey(FConstant::COMPANY_HOMEPAGE, $this->company_homepage);

            FHtml::setFrontendLayoutConfiguration('frontendTheme', $this->frontend_theme);
            
            $transaction->commit();

            //Modify constant file
            $basePath = Yii::getAlias('@' . SITE);
            $constant_file = $basePath . DS . COMMON . DS . 'components' . DS . 'FConstant.php';

            $mode = FConstant::GLOBAL_ACCESS_CONTROL_MODE;

            $new_mode = $this->access_control_mode;

            if ($mode == FConstant::MODE_ROLE_BAC) {
                $old_mode = 'self::MODE_ROLE_BAC';
            } else {
                $old_mode = 'self::MODE_RIGHT_BAC';
            }

            if ($new_mode != $old_mode) {
                file_put_contents($constant_file, str_replace($old_mode, $new_mode, file_get_contents($constant_file)));
            }

            $isSave = true;

        } catch (\Exception $e) {
            $transaction->rollback();
        }

        if (!$isSave) {
            return false;
        }
        return true;
    }
}