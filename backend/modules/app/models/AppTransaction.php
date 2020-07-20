<?php

namespace backend\modules\app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 */
class AppTransaction extends AppTransactionBase
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_id', 'external_transaction_id', 'user_id'], 'required'],
            [['user_id', 'object_id'], 'integer'],
            [['amount'], 'number'],
            [['transaction_id', 'external_transaction_id'], 'string', 'max' => 255],
            [['object_type', 'currency', 'payment_method', 'type', 'status'], 'string', 'max' => 100],
            [['payment_gateway'], 'string', 'max' => 200],
            [['note'], 'string', 'max' => 2000],
            [['time'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_id' => 'Transaction ID',
            'external_transaction_id' => 'External Transaction ID',
            'user_id' => 'User ID',
            'object_id' => 'Object ID',
            'object_type' => 'Object Type',
            'currency' => 'Currency',
            'amount' => 'Amount',
            'payment_method' => 'Payment Method',
            'payment_gateway' => 'Payment Gateway',
            'note' => 'Note',
            'time' => 'Time',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }

    public static function object_typeArray()
    {
        return array(
            AppTransactionBase::OBJECT_TYPE_ORDER => 'Order',
            AppTransactionBase::OBJECT_TYPE_USER => 'User',
        );
    }

    public static function object_typeLabel($key)
    {
        $str = array(
            AppTransactionBase::OBJECT_TYPE_ORDER => '<span class="label label-sm label-info">' . 'Order' . '</span>',
            AppTransactionBase::OBJECT_TYPE_USER => '<span class="label label-sm label-info">' . 'User' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function currencyArray()
    {
        return array(
            AppTransactionBase::CURRENCY_USD => 'Usd',
            AppTransactionBase::CURRENCY_VND => 'Vnd',
        );
    }

    public static function currencyLabel($key)
    {
        $str = array(
            AppTransactionBase::CURRENCY_USD => '<span class="label label-sm label-info">' . 'Usd' . '</span>',
            AppTransactionBase::CURRENCY_VND => '<span class="label label-sm label-info">' . 'Vnd' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function payment_methodArray()
    {
        return array(
            AppTransactionBase::PAYMENT_METHOD_POINT => 'Point',
            AppTransactionBase::PAYMENT_METHOD_ONLINE => 'Online',
        );
    }

    public static function payment_methodLabel($key)
    {
        $str = array(
            AppTransactionBase::PAYMENT_METHOD_POINT => '<span class="label label-sm label-info">' . 'Point' . '</span>',
            AppTransactionBase::PAYMENT_METHOD_ONLINE => '<span class="label label-sm label-info">' . 'Online' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function payment_gatewayArray()
    {
        return array(
            AppTransactionBase::PAYMENT_GATEWAY_PAYPAL => 'Paypal',
            AppTransactionBase::PAYMENT_GATEWAY_SYSTEM => 'System',
        );
    }

    public static function payment_gatewayLabel($key)
    {
        $str = array(
            AppTransactionBase::PAYMENT_GATEWAY_PAYPAL => '<span class="label label-sm label-info">' . 'Paypal' . '</span>',
            AppTransactionBase::PAYMENT_GATEWAY_SYSTEM => '<span class="label label-sm label-info">' . 'System' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function typeArray()
    {
        return array(
            AppTransactionBase::TYPE_BUY => 'Buy',
            AppTransactionBase::TYPE_CHARGE => 'Charge',
            AppTransactionBase::TYPE_DEPOSIT => 'Deposit',
        );
    }

    public static function typeLabel($key)
    {
        $str = array(
            AppTransactionBase::TYPE_BUY => '<span class="label label-sm label-info">' . 'Buy' . '</span>',
            AppTransactionBase::TYPE_CHARGE => '<span class="label label-sm label-info">' . 'Charge' . '</span>',
            AppTransactionBase::TYPE_DEPOSIT => '<span class="label label-sm label-info">' . 'Deposit' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function statusArray()
    {
        return array(
            AppTransactionBase::STATUS_FAIL => 'Fail',
            AppTransactionBase::STATUS_DONE => 'Done',
            AppTransactionBase::STATUS_PENDING => 'Pending',
        );
    }

    public static function statusLabel($key)
    {
        $str = array(
            AppTransactionBase::STATUS_FAIL => '<span class="label label-sm label-info">' . 'Fail' . '</span>',
            AppTransactionBase::STATUS_DONE => '<span class="label label-sm label-info">' . 'Done' . '</span>',
            AppTransactionBase::STATUS_PENDING => '<span class="label label-sm label-info">' . 'Pending' . '</span>',
        );
        return isset($str[$key]) ? $str[$key] : '';
    }

    public static function lookupData($table_name, $key, $value)
    {
        $result = array();
        $objects = array();
        if ($table_name == "app_user") {
            $objects = AppUser::find()->all();
        }
        if (count($objects) != 0) {
            $result = ArrayHelper::map($objects, $key, $value);
        }
        return $result;
    }

    public static function lookupLabel($table_name, $lookup_key, $lookup_value, $needle)
    {
        if (is_numeric($lookup_value)) {
            $condition = "$lookup_key = $lookup_value";
        } else {
            $condition = "$lookup_key = '$lookup_value'";
        }
        if ($table_name == "app_user") {
            $object = AppUser::find()->where($condition)->one();
        }
        return isset($object) ? $object->{$needle} : "";
    }
}