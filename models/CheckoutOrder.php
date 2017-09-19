<?php

namespace c006\checkout\models;

use Yii;

/**
 * This is the model class for table "checkout_order".
 *
 * @property integer $id
 * @property string $session_id
 * @property integer $user_id
 * @property string $subtotal
 * @property string $shipping
 * @property string $tax
 * @property float $total
 */
class CheckoutOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkout_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['session_id', 'subtotal', 'shipping', 'tax', 'total'], 'required'],
            [['user_id'], 'integer'],
            [['subtotal', 'shipping', 'tax', 'total'], 'number'],
            [['session_id'], 'string', 'max' => 26]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'session_id' => Yii::t('app', 'Session ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'subtotal' => Yii::t('app', 'Subtotal'),
            'shipping' => Yii::t('app', 'Shipping'),
            'tax' => Yii::t('app', 'Tax'),
            'total' => Yii::t('app', 'Total'),
        ];
    }
}
