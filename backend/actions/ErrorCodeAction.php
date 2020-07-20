<?php

namespace backend\actions;

use common\base\api\Action;
use common\components\FConstant;
use common\components\FApi;

class ErrorCodeAction extends Action
{
    public function run()
    {
        $data = FApi::getErrorMsg('all');
        return FApi::getOutputForAPI($data, FConstant::SUCCESS, 'OK', ['code' => 200]);
    }
}

