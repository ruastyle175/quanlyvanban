<?php

namespace backend\actions;

use common\base\api\Action;
use common\components\FConstant;
use common\components\FFile;

class ViewFileAction extends Action
{
    public function run()
    {
        $f = isset($_REQUEST['f']) ? $_REQUEST['f'] : '';  //file name
        $d = isset($_REQUEST['d']) ? $_REQUEST['d'] : '';  //directory
        $s = isset($_REQUEST['s']) ? $_REQUEST['s'] : '';  //thumb
        $t = isset($_REQUEST['t']) ? $_REQUEST['t'] : '';  //image / file

        $file_name = $s . $f;
        if ($t == "image") {
            $default_file = FConstant::NO_IMAGE;
        } else {
            $default_file = "";
        }
        $file_path = FFile::getFilePath($file_name, $d, $default_file);
        if ($t == 'image') {
            $info = getimagesize($file_path);
            header("Content-type: {$info['mime']}");
        } else {
            $mime = mime_content_type($file_path);
            header("Content-type: {$mime}");
        }
        readfile($file_path);

    }
}
