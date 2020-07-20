<?php

namespace common\components;

use backend\modules\system\models\SystemSetting;
use Yii;
use yii\base\Exception;

class FInteractive
{
    const FIREBASE_TOPIC = 'GAME-VN';

    /**
     * @param $des
     * @param array $post_data
     */
    public static function async($des, $post_data = [])
    {
        if (filter_var($des, FILTER_VALIDATE_URL)) {
            $url = $des;
        } elseif (is_array($des)) {
            $url = Yii::$app->urlManager->createAbsoluteUrl($des);
        } else {
            $url = '';
        }

        ignore_user_abort(true); // CAUTION!  run over return
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // comment when test
        if (count($post_data) > 0) {
            curl_setopt($ch, CURLOPT_POST, count($post_data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1); // Skip receive return
        curl_exec($ch);
        curl_close($ch);
    }

    public static function pushAndroid($a_devices, $msg, $params = [])
    {
        $key_setting = SystemSetting::getSettingValueByKey(FConstant::GOOGLE_API_KEY);
        $api_key = $key_setting[FConstant::GOOGLE_API_KEY];

        //$url = 'https://android.googleapis.com/gcm/send';
        $url = 'https://fcm.googleapis.com/fcm/send';

        $loop = ceil(count($a_devices) / 1000);

        $msg = array('message' => $msg);

        if (!empty($params)) {
            $msg = array_merge($msg, $params);
        }

        for ($i = 1; $i <= $loop; $i++) {
            if (0 < count($a_devices) && count($a_devices) < 1000)
                $registrationID = $a_devices;
            else {
                $registrationID = array_slice($a_devices, 0, 1000);
                $a_devices = array_slice($a_devices, 1000, count($a_devices));
            }

            $fields = array
            (
                'registration_ids' => $registrationID,
                'data' => $msg
            );

            $headers = array(
                'Authorization: key=' . $api_key,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_exec($ch);
            curl_close($ch);
        }
    }

    public static function pushIosFcm($registrationIDs, $msg, $params = [])
    {
        $url = 'https://fcm.googleapis.com/fcm/send';


        $key_setting = SystemSetting::getSettingValueByKey(FConstant::GOOGLE_API_KEY);
        $api_key = $key_setting[FConstant::GOOGLE_API_KEY];

        $loop = ceil(count($registrationIDs) / 1000);

        for ($i = 1; $i <= $loop; $i++) {
            if (0 < count($registrationIDs) && count($registrationIDs) < 1000)
                $registrationID = $registrationIDs;
            else {
                $registrationID = array_slice($registrationIDs, 0, 1000);
                $registrationIDs = array_slice($registrationIDs, 1000, count($registrationIDs));
            }

            $notification = array(
                'title' => Yii::$app->name,
                'text' => $msg
            );
            if (!empty($params)) {
                if (isset($params['title'])) {
                    $title = strlen($params['title']) != 0 ? $params['title'] : '';
                    $notification['title'] = $title;
                    unset($params['title']);
                }
            }

            $arrayToSend = array('notification' => $notification, 'data' => $params, 'priority' => 'high');


            //Error: “registration_ids” field is not a JSON array (Firebase)

            //$arrayToSend = array('to' => $token, 'notification' => $notification, 'priority'=>'high'); //One token
            //$arrayToSend = array('registration_ids' => $array_of_token, 'notification' => $notification, 'priority'=>'high'); //Multiple tokens

            if (count($registrationID) == 1) {
                $arrayToSend['to'] = $registrationID[0];
            } else {
                $arrayToSend['registration_ids'] = array($registrationID);
            }
            //$arrayToSend['registration_ids'] = ['cGOjL1kn2k0:APA91bG31a3n7UaUjbIZzcPiydNJyTx0p9kD5RKSJevyFFPOH4mxVuXwp8Zh1GdcYYeiEDwvSXDCQtLFgiRuXKh8qQICvowqbahnJnJxkBX1zfLiwmPi0O2L12-c1IOzkaiCPAGJ8qnW'];


            //Field "data" must be a JSON array: [] => need to force object
            $json = json_encode($arrayToSend, JSON_FORCE_OBJECT);

            $headers = array(
                'Authorization: key=' . $api_key,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_exec($ch);
            curl_close($ch);
        }
    }

    public static function pushIosFcmTopic($registrationIDs, $msg, $params = [])
    {
        $url = 'https://fcm.googleapis.com/fcm/send';


        $key_setting = SystemSetting::getSettingValueByKey(FConstant::GOOGLE_API_KEY);
        $api_key = $key_setting[FConstant::GOOGLE_API_KEY];



        $notification = array
        (
            'body' => $msg,
            'title' => Yii::$app->name,
        );

        if (!empty($params)) {
            if (isset($params['title'])) {
                $title = strlen($params['title']) != 0 ? $params['title'] : '';
                $notification['title'] = $title;
                unset($params['title']);
            }
        }

        $fields = array
        (
            'to'  => '/topics/' . self::FIREBASE_TOPIC,
            'notification' => $notification,
            'data' => $params
        );

        //Field "data" must be a JSON array: [] => need to force object
        $json = json_encode($fields, JSON_FORCE_OBJECT);

        $headers = array(
            'Authorization: key=' . $api_key,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_exec($ch);
        curl_close($ch);

    }

    public static function pushIosX($i_devices, $message)
    {
        //Working well if all device token is right
        //if 1st right / 2nd wrong : Push on first
        //if 1st wrong / 2nd right : No push on both
        //Push will terminated if have any error

        $badge = 1;
        $sound = 'default';
        $development = true;//make it false if it is not in development mode
        $passphrase = 'My Application';//your passphrase

        $payload = array();
        $payload['aps'] = array(
            'alert' => $message,
            'badge' => intval($badge),
            'sound' => $sound
        );

        $payload = json_encode($payload);

        $apns_url = NULL;
        $apns_cert = NULL;
        $apns_port = 2195;

        $pem_setting = SystemSetting::getSettingValueByKey(FConstant::PEM_FILE);
        $pem = $pem_setting[FConstant::PEM_FILE];

        $pem_dir = 'pem';

        if ($development) {
            $apns_url = 'gateway.sandbox.push.apple.com';
            $apns_cert = dirname(Yii::$app->request->scriptFile) . '/' . UPLOAD_DIR . '/' . $pem_dir . '/' . $pem;
        } else {
            $apns_url = 'gateway.push.apple.com';
            $apns_cert = dirname(Yii::$app->request->scriptFile) . '/' . UPLOAD_DIR . '/' . $pem_dir . '/' . $pem;
        }

        $stream_context = stream_context_create();
        stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
        stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);

        $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
        foreach ($i_devices as $idevice) {
            $token = $idevice;
            $device_tokens = str_replace("<", "", $token);
            $device_tokens1 = str_replace(">", "", $device_tokens);
            $device_tokens2 = str_replace(' ', '', $device_tokens1);
            $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', $device_tokens2) . chr(0) . chr(strlen($payload)) . $payload;
            fwrite($apns, $apns_message);
        }
        //cause fatal errors
        //@socket_close($apns);
        @fclose($apns);

    }

    public static function pushIos($i_devices, $message, $type, $additional_data)
    {
        //working any case
        $badge = 1;
        $sound = 'default';
        $development = true;//make it false if it is not in development mode
        $passphrase = 'My Application';

        $payload = array();
        $payload['aps'] = array(
            'alert' => $message,
            'badge' => intval($badge),
            'sound' => $sound
        );
        $payload['notificationType'] = $type;
        $payload['additionalData'] = $additional_data;

        $payload = json_encode($payload);

        $apns_url = NULL;
        $apns_cert = NULL;
        $apns_port = 2195;

        $pem_setting = SystemSetting::getSettingValueByKey(FConstant::PEM_FILE);
        $pem = $pem_setting[FConstant::PEM_FILE];
        $pem_dir = 'pem';

        if (strlen($pem) > 0) {
            if ($development) {
                $apns_url = 'gateway.sandbox.push.apple.com';
                $apns_cert = dirname(Yii::$app->request->scriptFile) . '/' . UPLOAD_DIR . '/' . $pem_dir . '/' . $pem;
            } else {
                $apns_url = 'gateway.push.apple.com';
                $apns_cert = dirname(Yii::$app->request->scriptFile) . '/' . UPLOAD_DIR . '/' . $pem_dir . '/' . $pem;
            }
        }

        $stream_context = stream_context_create();
        stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
        stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);

        try {
            $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
        } catch (Exception $e) {
            var_dump($e);
            die('Can not connect to APNS');
        }

        $number = 0;

        foreach ($i_devices as $idevice) {
            $number += 1;
            $token = $idevice;
            $device_tokens = str_replace("<", "", $token);
            $device_tokens1 = str_replace(">", "", $device_tokens);
            $device_tokens2 = str_replace(' ', '', $device_tokens1);

            $expiry = time() + 30;

            $apns_message = chr(1) . pack("N", rand(1000, 9999)) . pack("N", $expiry) . pack("n", 32) . pack('H*', $device_tokens2) . pack("n", strlen($payload)) . $payload;
            $msgapns = fwrite($apns, $apns_message);

            usleep(2000);

            if (!$msgapns) {
                //@socket_close($apns);
                @fclose($apns);
            } else {
                $read = array($apns);
                $null = null;
                $changedStreams = stream_select($read, $null, $null, 0, 1000000);

                if ($changedStreams === false) {
                    //fail
                } elseif ($changedStreams > 0) {
                    $responseBinary = fread($apns, 6);
                    if ($responseBinary !== false || strlen($responseBinary) == 6) {
                        $response = unpack('Ccommand/Cstatus_code/Nidentifier', $responseBinary);
                        if ($response['status_code']) {
                            //echo $number . ' Fail!. ';
                            //fail
                            //@socket_close($apns);
                            @fclose($apns);
                            $stream_context = stream_context_create();
                            stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
                            stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);
                            $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
                            stream_set_blocking($apns, 0);
                        }
                    }
                } else {
                    echo $number . ' Success!. ';
                }
            }
        }
        //cause fatal errors
        //@socket_close($apns);
        @fclose($apns);
    }
}
