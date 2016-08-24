<?php

namespace c006\checkout\models;

use Yii;

/**
 * This is the model class for table "checkout_coupon".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $coupon_id
 * @property string $code
 * @property string $amount
 *
 * @property CheckoutOrder $order
 * @property Coupon $coupon
 */
class CheckoutCoupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'coupon_id', 'code', 'amount'], 'required'],
            [['order_id', 'coupon_id'], 'integer'],
            [['amount'], 'number'],
            [['code'], 'string', 'max' => 45],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => CheckoutOrder::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['coupon_id'], 'exist', 'skipOnError' => true, 'targetClass' => \c006\coupon\models\Coupon::className(), 'targetAttribute' => ['coupon_id' => 'id']],
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
            'coupon_id' => Yii::t('app', 'Coupon ID'),
            'code' => Yii::t('app', 'Code'),
            'amount' => Yii::t('app', 'Amount'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(CheckoutOrder::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupon()
    {
        return $this->hasOne(Coupon::className(), ['id' => 'coupon_id']);
    }
}
