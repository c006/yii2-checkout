<?php

namespace c006\checkout\models;

use Yii;

/**
 * This is the model class for table "checkout_item".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $product_shipping_id
 * @property integer $quantity
 * @property string $discount
 * @property string $price
 */
class CheckoutItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'quantity', 'discount', 'price'], 'required'],
            [['order_id', 'product_id', 'product_shipping_id', 'quantity'], 'integer'],
            [['discount', 'price'], 'number']
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
            'product_id' => Yii::t('app', 'Product ID'),
            'product_shipping_id' => Yii::t('app', 'Product Shipping ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'discount' => Yii::t('app', 'Discount'),
            'price' => Yii::t('app', 'Price'),
        ];
    }
}
