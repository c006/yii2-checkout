<?php

namespace c006\checkout\models;

use Yii;

/**
 * This is the model class for table "checkout_shipping".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $country
 */
class CheckoutShipping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_shipping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'first_name', 'last_name', 'address', 'city', 'state', 'postal_code', 'country'], 'required'],
            [['order_id'], 'integer'],
            [['first_name', 'last_name', 'address2'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 100],
            [['city', 'state'], 'string', 'max' => 60],
            [['postal_code'], 'string', 'max' => 13],
            [['country'], 'integer']
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
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'address' => Yii::t('app', 'Address'),
            'address2' => Yii::t('app', 'Address2'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'country' => Yii::t('app', 'Country'),
        ];
    }
}
