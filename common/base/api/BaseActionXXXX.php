<?php
/**
 * @link      http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license   http://www.yiiframework.com/license/
 */

namespace backend\actions;

use backend\modules\app\models\AppTokenAPI;
use common\components\FConstant;
use common\components\FHelper;
use common\components\FHtml;
use common\components\FApi;

/**
 * @property $is_secured      boolean
 * @property $fields_required boolean
 * @property $checkAccess     boolean
 * @property $user_id         integer
 * @property $model_fields    array
 * @property $output          array
 * @property $fields          array
 * @property $limit           integer
 * @property $offset          integer
 * @property $user_role       string
 */
class BaseAction extends \common\base\BaseAction
{
	const ACTION_LIST = 'list';
	protected $fields_required = false;
	public    $checkAccess;
	protected $model_fields;
	protected $output          = [];
	protected $user_role       = 'user';

	protected $action = 'list';

	public function beforeRun() {
		$this->action = FHelper::getRequestParam(['action', 'action_type'], 'list');

		return parent::beforeRun();
	}

	public function isAuthorized() {
		$error_code = 0;
		$token      = FHelper::getRequestParam('login_token', '');
		if ($this->is_secured) {
			if (strlen($token) != 0) {
				/* @var $login_token AppTokenAPI */
				$login_token = AppTokenAPI::find()->where(['token' => $token])->one();
				if (isset($login_token)) {
					if (isset ($login_token->user)) {
						$this->user_id   = $login_token->user->id;
						$this->user_role = $login_token->user->role;
					}
					else {
						$login_token->delete();
						$error_code = 221;
					}
				}
				else {
					$error_code = 205;
				}
			}
			else {
				$error_code = 204;
			}
		}
		else {
			//NOT REQUIRED LOGIN
			if (strlen($token) != 0) {
				/* @var $login_token AppTokenAPI */
				$login_token = AppTokenAPI::find()->where(['token' => $token])->one();
				if (isset($login_token)) {
					if (isset ($login_token->user)) {
						$this->user_id   = $login_token->user->id;
						$this->user_role = $login_token->user->role;
					}
					else {
						$login_token->delete();
					}
				}
			}
		}
		//Check fields
		if ($error_code == 0) {
			$error_code = $this->isExistedFields();
		}
		//Return error
		if ($error_code != 0) {
			$this->output = FApi::getOutputForAPI('', FConstant::ERROR, FApi::getErrorMsg($error_code), ['code' => $error_code]);
		}
	}

	public function isExistedFields() {
		$error_code   = 0;
		$fields       = $this->fields;
		$model_fields = $this->model_fields;
		if ($this->fields_required) {
			if (empty($fields)) {
				$error_code = 202;
			}
			elseif (empty($model_fields)) {
				$error_code = 203;
			}
			else {
				if (!empty(array_diff($fields, $model_fields))) {
					$error_code = 203;
				}
			}
		}
		else {
			if (!empty($fields) && !empty($model_fields)) {
				if (!empty(array_diff($fields, $model_fields))) {
					$error_code = 203;
				}
			}
		}

		return $error_code;
	}

	/**
	 * @return array
	 */
	public function run() {
		switch ($this->action) {
			case "list" :
				return $this->index();
				break;
			case FConstant::ACTION_CREATE :
				return $this->create();
				break;
			case FConstant::ACTION_EDIT :
				return $this->update();
				break;
			case FConstant::ACTION_DELETE:
				return $this->delete();
				break;
			case 'detail':
				return $this->detail();
				break;
			default;
		}
	}

	/**
	 * @return string
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * @param string $action
	 */
	public function setAction($action) {
		$this->action = $action;
	}

	/**
	 * @return array
	 */
	protected function index() {
		return $this->outputError();
	}

	/**
	 * @return array
	 */
	protected function create() {
		return $this->outputError();
	}

	/**
	 * @return array
	 */
	protected function update() {
		return $this->outputError();
	}

	/**
	 * @return array
	 */
	protected function delete() {
		return $this->outputError();
	}

	/**
	 * @return array
	 */
	protected function detail() {
		return $this->outputError();
	}

	/**
	 * @return array
	 */
	protected function outputError() {
		return FApi::getOutputForAPI(null, FConstant::ERROR, "Method not use", [
			'code'        => 401,
			'total'       => 0,
			'page_limit'  => 0,
			'page_offset' => 0,
			'time'        => FHtml::Now(),
			'object_type' => ''
		]);
	}
}
