<?php

namespace backend\modules\app\models;


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
class AppTransactionBase extends \yii\db\ActiveRecord
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

    public $tableName = 'app_transaction';
    public $uploadFolder = 'app-transaction';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_transaction';
    }

}