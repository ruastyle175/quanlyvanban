<?php
/**
 * Created by PhpStorm.
 * User: radic
 * Date: 2/18/2019
 * Time: 9:51 AM
 */

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;


class SeedController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->db->createCommand()->truncateTable('user')->execute();
        $new_user = new User();
        $new_user->name = "Administrator";
        $new_user->username = "admin";
        $new_user->setPassword('123456');
        $new_user->generateAuthKey();
        $new_user->email = "admin@example.com";
        $new_user->role = User::ROLE_ADMIN;
        $new_user->status = User::STATUS_ACTIVE;
        $new_user->created_at = time();
        $new_user->save();
    }
}