<?php

namespace backend\modules\system\actions;

use backend\modules\system\models\SystemSetting;
use common\base\api\Action;
use common\components\FApi;
use common\components\FConstant;

class SettingAction extends Action
{
    public function run()
    {

        $load = SystemSetting::getSettingValueByKey(
            [
                FConstant::ADMIN_EMAIL,
                FConstant::SUPPORT_EMAIL,
                FConstant::GOOGLE_API_KEY,
                FConstant::PEM_FILE,
                FConstant::COMPANY_NAME,
                FConstant::COMPANY_DESCRIPTION,
                FConstant::COMPANY_HOMEPAGE,

                FConstant::LINK_FACEBOOK,
                FConstant::HOTLINE,
                FConstant::HOTLINE_BRAND,
                FConstant::HOTLINE_APP,
                FConstant::LINK_TRY,
                FConstant::LINK_PLAY,
                FConstant::LINK_REGISTER,
                FConstant::LINK_LIVE_SUPPORT,
                FConstant::ENABLE_FAKE_DATA,
            ]
        );


        $data =  array(
            'admin_email' => $load[FConstant::ADMIN_EMAIL],
            'support_email' => $load[FConstant::SUPPORT_EMAIL],
            'link_facebook' => $load[FConstant::LINK_FACEBOOK],
            'hotline' => $load[FConstant::HOTLINE],
            'hotline_brand' => $load[FConstant::HOTLINE_BRAND],
            'hotline_app' => $load[FConstant::HOTLINE_APP],
            'link_try' => $load[FConstant::LINK_TRY],
            'link_play' => $load[FConstant::LINK_PLAY],
            'link_register' => $load[FConstant::LINK_REGISTER],
            'link_live_support' => $load[FConstant::LINK_LIVE_SUPPORT],
            'enable_fake_data' => $load[FConstant::ENABLE_FAKE_DATA],
        );

        return FApi::getOutputForAPI($data, FConstant::SUCCESS, 'OK', ['code' => 200]);

    }
}