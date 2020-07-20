<?php

namespace backend\modules\system\controllers;

use backend\controllers\BackendController;
use backend\modules\system\models\SystemSetting;
use backend\modules\system\models\SettingForm;
use common\components\AccessRule;
use common\components\FConstant;
use common\components\FHelper;
use backend\models\ProfileForm;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\imagine\Image;
use yii\web\UploadedFile;
use backend\models\PasswordForm;
use common\models\User;


class SettingController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => [
                    'index',
                    'profile',
                    //'test'
                ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionTest()
    {

        $basePath = Yii::getAlias('@' . SITE);
        $constant_file = $basePath . DS . COMMON . DS . 'components' . DS . 'FConstant.php';


        $mode = FConstant::GLOBAL_ACCESS_CONTROL_MODE;

        $new_mode = 'self::MODE_RIGHT_BAC';

        if ($mode == FConstant::MODE_ROLE_BAC) {
            $old_mode = 'self::MODE_ROLE_BAC';
        } else {
            $old_mode = 'self::MODE_RIGHT_BAC';
        }

        if ($new_mode != $old_mode) {
            file_put_contents($constant_file, str_replace($old_mode, $new_mode, file_get_contents($constant_file)));
        }

    }

    public function actionIndex()
    {
        $model = new SettingForm();
        $model->loadModel();
        $oldPem = $model->pem;

        if (isset($_POST['SettingForm'])) {
            $model->attributes = $_POST['SettingForm'];
            $uploadedFile = UploadedFile::getInstance($model, 'pem');

            if ($model->validate()) {

                if ($uploadedFile && $uploadedFile->size > 0) {
                    $name_file = time() . '.' . $uploadedFile->extension;
                    $model->pem = $name_file;
                } else
                    $model->pem = $oldPem;

                if ($uploadedFile && $uploadedFile->size > 0) {
                    $uploadFolder = $this->uploadFolder . DIRECTORY_SEPARATOR . 'pem';

                    if (!file_exists($uploadFolder)) {
                        mkdir($uploadFolder, 0777, true);
                    }
                    $uploadedFile->saveAs($uploadFolder . DIRECTORY_SEPARATOR . $model->pem);  // image
                    $oldPath = $uploadFolder . DIRECTORY_SEPARATOR . $oldPem;
                    if (file_exists($oldPath) && is_file($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $model->save();
            }
        }

        return $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionLayoutConfiguration()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $key = FHelper::getRequestParam('key', '');
            $value = FHelper::getRequestParam('value', '');

            if (strlen($key) != 0 && strlen($value) != 0) {
                $constant_key = FConstant::LAYOUT_CONFIGURATION;
                $current = SystemSetting::getSettingValueByKey($constant_key);
                $array = Json::decode($current[$constant_key]);
                $array[$key] = $value;
                $result = Json::encode($array);

                SystemSetting::setSettingValueByKey($constant_key, $result);

                $cache = Yii::$app->cache;
                $cache->set($constant_key, $result, 3600 * 24 * 30);
            }
        }
    }

    public function actionResetLayoutConfiguration()
    {
        $constant_key = FConstant::LAYOUT_CONFIGURATION;

        $current = SystemSetting::getSettingValueByKey($constant_key);
        $array = Json::decode($current[$constant_key]);

        $array['mainColor'] = 'default';
        $array['themeStyle'] = 'md';
        $array['layoutStyle'] = 'fluid';
        $array['headerStyle'] = 'default';
        $array['topMenuDropdownStyle'] = 'light';
        $array['sidebarMode'] = 'default';
        $array['sidebarMenu'] = 'accordion';
        $array['sidebarStyle'] = 'default';
        $array['sidebarPosition'] = 'left';
        $array['footerStyle'] = 'default';

        $result = Json::encode($array);
        SystemSetting::setSettingValueByKey($constant_key, $result);

        $cache = Yii::$app->cache;
        $cache->set($constant_key, $result, 3600 * 24 * 30);

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionProfile()
    {
        $model = new PasswordForm();
        $profile = new ProfileForm();

        /* @var $current_user User */
        /* @var $user User */

        $current_user = Yii::$app->user->identity;
        $image_old = $current_user->image;

        //load data
        $profile->name = $current_user->name;
        $profile->overview = $current_user->overview;

        $user = User::find()->where(['username' => $current_user->username])->one();
        $time_string = time();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if (strlen($model->newPassword) != 0) {
                    $reset_token = md5($time_string);
                    $user->password_reset_token = $reset_token;
                    $user->setPassword($model->newPassword);
                    $user->generateAuthKey();
                }
                if ($user->save()) {
                    Yii::$app->getSession()->setFlash('success', Yii::t('common', 'Password changed'));
                } else {
                    Yii::$app->getSession()->setFlash('error', Yii::t('common', 'Password is not changed'));
                }
            }
        }

        if ($profile->load(Yii::$app->request->post())) {
            $user->name = $profile->name;
            $user->overview = $profile->overview;

            $image_file = UploadedFile::getInstance($profile, 'image_file');
            $cropInfo = Json::decode($profile->image_file_crop)[0];
            if ($image_file) {
                // Crop data is posted on json format
                //"sWidth":896,
                //"sHeight":896,
                //"x":212,
                //"y":215,
                //"dWidth":415,
                //"dHeight":415,
                //"ratio":0.4628863524470625,
                //"width":200,"height":200,
                //"image":base64 encoded

                $image_pre = $time_string . rand(0, 1000) . '_user_image';
                $image_name = $image_pre . '.' . $image_file->extension;

                if (count($cropInfo) != 0) {
                    $newWidth = $cropInfo['dWidth'];
                    $newHeight = $cropInfo['dHeight'];
                    $x = $cropInfo['x'];
                    $y = $cropInfo['y'];
                    //Thumb Name
                    $thumb_name = $image_pre . $newWidth . 'x' . $newHeight . '.' . $image_file->extension;
                    $user->image = $thumb_name;
                }

                //normal upload
                //$user->image = $time_string . rand(0, 1000) . '_user_image.' . $image_file->extension;
            }


            if ($user->save()) {
                //Reload identity immediately when profile is updated (avoid delay)
                Yii::$app->user->switchIdentity($user);
                if ($image_file) {
                    if (isset($image_old) && !filter_var($image_old, FILTER_VALIDATE_URL)) {
                        if (is_file($this->uploadFolder . '/user/' . $image_old)) {
                            unlink($this->uploadFolder . '/user/' . $image_old);
                        }
                    }
                    $image_path = $this->uploadFolder . '/user/' . $user->image;

                    //saving thumbnail
                    if (count($cropInfo) != 0) {
                        $image = Image::getImagine()->open($image_file->tempName);
                        $newSizeThumb = new Box($cropInfo['dWidth'], $cropInfo['dHeight']);
                        $cropSizeThumb = new Box(200, 200); //frame size of crop
                        $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);
                        $image->resize($newSizeThumb)
                            ->crop($cropPointThumb, $cropSizeThumb)
                            ->save($image_path, ['quality' => 100]);
                    }
                    //saving original or normal upload
                    //$image_file->saveAs($image_path);
                }


                Yii::$app->getSession()->setFlash('success', Yii::t('common', 'Profile is updated'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('common', 'Fail to update profile'));
            }
        }

        return $this->render('profile', [
            'model' => $model,
            'profile' => $profile,
            'user' => $user
        ]);
    }
}
