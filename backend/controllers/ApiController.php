<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\controllers;

use common\base\api\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * ActiveController implements a common set of actions for supporting RESTful access to ActiveRecord.
 *
 * The class of the ActiveRecord should be specified via [[modelClass]], which must implement [[\yii\db\ActiveRecordInterface]].
 * By default, the following actions are supported:
 *
 * - `index`: list of models
 * - `view`: return the details of a model
 * - `create`: create a new model
 * - `update`: update an existing model
 * - `delete`: delete an existing model
 * - `options`: return the allowed HTTP methods
 *
 * You may disable some of these actions by overriding [[actions()]] and unsetting the corresponding actions.
 *
 * To add a new action, either override [[actions()]] by appending a new action class or write a new action method.
 * Make sure you also override [[verbs()]] to properly declare what HTTP methods are allowed by the new action.
 *
 * You should usually override [[checkAccess()]] to check whether the current user has the privilege to perform
 * the specified action against the specified model.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ApiController extends Controller
{
    public $defaultAction = 'index';

    public $enableCsrfValidation = false;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'category' => ['class' => 'backend\actions\CategoryAction', 'checkAccess' => [$this, 'checkAccess']],
            'file' => ['class' => 'backend\actions\ViewFileAction', 'checkAccess' => [$this, 'checkAccess']],
            'sendEmail' => ['class' => 'backend\actions\SendEmailAction', 'checkAccess' => [$this, 'checkAccess']],
            'error-code' => ['class' => 'backend\actions\ErrorCodeAction', 'checkAccess' => [$this, 'checkAccess']],
            'test' => ['class' => 'backend\actions\TestAction', 'checkAccess' => [$this, 'checkAccess']],
        ];
    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            //'index' => ['GET', 'HEAD'],
            //'view' => ['GET', 'HEAD'],
            //'create' => ['POST'],
            //'update' => ['PUT', 'PATCH'],
            //'delete' => ['DELETE'],
        ];
    }

    /**
     * Checks the privilege of the current user.
     *
     * This method should be overridden to check whether the current user has the privilege
     * to run the specified action against the specified data model.
     * If the user does not have access, a [[ForbiddenHttpException]] should be thrown.
     *
     * @param string $action the ID of the action to be executed
     * @param object $model the model to be accessed. If null, it means no specific model is being accessed.
     * @param array $params additional parameters
     * @throws ForbiddenHttpException if the user does not have access
     */
    public function checkAccess()
    {
        // need to be modified for security
    }
}
