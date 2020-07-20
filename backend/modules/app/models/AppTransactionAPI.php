<?php

namespace backend\modules\app\models;

use common\base\api\ActiveRecord;

/**
 * @property integer $id
 * @property string $transaction_id
 * @property string $external_transaction_id
 * @property integer $user_id
 * @property integer $object_id
 * @property string $object_type
 * @property string $currency
 * @property double $amount
 * @property string $payment_method
 * @property string $payment_gateway
 * @property string $note
 * @property string $time
 * @property string $type
 * @property string $status
 */
class AppTransactionAPI extends ActiveRecord
{
    const OBJECT_TYPE_ORDER = 'order';
    const OBJECT_TYPE_USER = 'user';
    const CURRENCY_USD = 'usd';
    const CURRENCY_VND = 'vnd';
    const PAYMENT_METHOD_POINT = 'point';
    const PAYMENT_METHOD_ONLINE = 'online';
    const PAYMENT_GATEWAY_PAYPAL = 'paypal';
    const PAYMENT_GATEWAY_SYSTEM = 'system';
    const TYPE_BUY = 'buy';
    const TYPE_CHARGE = 'charge';
    const TYPE_DEPOSIT = 'deposit';
    const STATUS_FAIL = 'fail';
    const STATUS_DONE = 'done';
    const STATUS_PENDING = 'pending';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_transaction';
    }

    public function fields()
    {
        $fields = parent::fields(); // TODO: Change the autogenerated stub
        return $fields;
    }

    public function apiFields()
    {
        //$fields = parent::apiFields(); // TODO: Change the autogenerated stub
        $fields = [
            'id',
            'transaction_id',
            'external_transaction_id',
            'user_id',
            'object_id',
            'object_type',
            'currency',
            'amount',
            'payment_method',
            'payment_gateway',
            'note',
            'time',
            'type',
            'status'
        ];
        return $fields;
    }

}