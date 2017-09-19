<?php

namespace c006\checkout\models;

use Yii;

/**
 * This is the model class for table "checkout_transaction".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $transaction_id
 * @property integer $transaction_type_id
 * @property integer $auth
 * @property string $fee
 * @property string $amount
 * @property string $description
 * @property integer $timestamp
 */
class CheckoutTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'transaction_type_id', 'amount', 'timestamp'], 'required'],
            [['order_id', 'transaction_type_id', 'timestamp'], 'integer'],
            [['fee', 'amount'], 'number'],
            [['transaction_id'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'transaction_type_id' => Yii::t('app', 'Transaction Type'),
            'auth' => Yii::t('app', 'Auth Code'),
            'fee' => Yii::t('app', 'Fee'),
            'amount' => Yii::t('app', 'Amount'),
            'description' => Yii::t('app', 'Description'),
            'timestamp' => Yii::t('app', 'Timestamp'),
        ];
    }
}
