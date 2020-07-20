<?php

namespace backend\modules\app\actions;

use backend\modules\app\models\AppUserAPI;
use common\base\api\Action;
use common\components\FConstant;
use common\components\FApi;
use Imagine\Image\Box;
use Yii;
use yii\imagine\Image;

class UpdateProfileAction extends Action
{
    public $is_secured = true;

    public function run()
    {
        if (($re = $this->isAuthorized())!== true)
            return $re;

        $user_id = $this->user_id;

        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
        $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
        $gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
        $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
        $dob = isset($_REQUEST['dob']) ? $_REQUEST['dob'] : '';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';

        $file_path = Yii::getAlias('@' . UPLOAD_DIR) . '/' . 'app-user' . '/';

        $check = AppUserAPI::findOne($user_id);
        if (isset($check)) {

            $oldAvatar = $check->avatar;
            $upload = false;
            $now = time();
            $imageName = '';

            if(isset($_FILES['avatar'])){
                $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $imageName = $now . 'avatar.'. $ext;

                $image_path = $file_path . $imageName;
                $upload = move_uploaded_file($_FILES['avatar']['tmp_name'], $image_path);

                if($upload){
                    $check->avatar = $imageName;
                    Image::getImagine()->open($image_path)
                        ->thumbnail(new Box(300, 300))
                        ->save($file_path . 'thumb' . $imageName , ['quality' => 100]);
                }
            }
            if (strlen($password) != 0) {
                $check->setPassword($password);
            }
            if (strlen($name) != 0) {
                $check->name = $name;
            }
            if (strlen($description) != 0) {
                $check->description = $description;
            }
            if (strlen($gender) != 0) {
                $check->gender = $gender;
            }
            if (strlen($phone) != 0) {
                $check->phone = $phone;
            }
            if (strlen($dob) != 0) {
                $check->dob = $dob;
            }
            if (strlen($address) != 0) {
                $check->address = $address;
            }

            $check->modified_date = date('Y-m-d H:i:s', $now);

            if ($check->save()) {

                if($upload){
                    if (is_file($file_path . '/' . $oldAvatar)) {
                        unlink($file_path . '/' . $oldAvatar);
                    }
                    if (is_file($file_path . '/thumb' . $oldAvatar)) {
                        unlink($file_path . '/thumb' . $oldAvatar);
                    }
                }

                $check = AppUserAPI::findOne($user_id);
                
                $data = $check;


                return FApi::getOutputForAPI($data, FConstant::SUCCESS, 'OK', ['code'=> 200]);

            } else {
                if(isset($_FILES['avatar'])) {
                    if ($upload && strlen($imageName)!=0) {
                        if (is_file($file_path . '/' . $imageName)) {
                            unlink($file_path . '/' . $imageName);
                        }
                        if (is_file($file_path . '/thumb' . $imageName)) {
                            unlink($file_path . '/thumb' . $imageName);
                        }
                    }
                }

                return FApi::getOutputForAPI('', FConstant::ERROR, 'FAIL', ['code'=> 201]);
            }
        } else {
            return FApi::getOutputForAPI('', FConstant::ERROR, FConstant::USER_NOT_FOUND, ['code'=> 221]);
        }
    }
}
