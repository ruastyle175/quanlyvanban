<?php

namespace backend\modules\system\controllers;


/**
 * Default controller for the `api` module
 */
class ApiController extends \backend\controllers\ApiController
{
    /**
     * Renders the index view for the module
     * @return array
     *
     */

    public function actions()
    {
        return [
            'setting' => ['class' => 'backend\modules\system\actions\SettingAction', 'checkAccess' => [$this, 'checkAccess']],
        ];
    }
}
