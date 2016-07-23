<?php

namespace c006\checkout\models;

use Yii;

/**
 * This is the model class for table "checkout_link".
 *
 * @property integer $order_id
 * @property integer $item_id
 * @property integer $shipping_id
 */
class CheckoutLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'item_id', 'shipping_id'], 'required'],
            [['order_id', 'item_id', 'shipping_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'shipping_id' => Yii::t('app', 'Shipping ID'),
        ];
    }
}
