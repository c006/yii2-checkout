<?php

namespace c006\checkout\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use c006\checkout\models\CheckoutItem as CheckoutItemModel;

/**
* CheckoutItem represents the model behind the search form about `c006\checkout\models\CheckoutItem`.
*/
class CheckoutItem extends CheckoutItemModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'order_id', 'product_id', 'product_shipping_id', 'quantity'], 'integer'],
            [['discount', 'price'], 'number'],
];
}

/**
* @inheritdoc
*/
public function scenarios()
{
// bypass scenarios() implementation in the parent class
return Model::scenarios();
}

/**
* Creates data provider instance with search query applied
*
* @param array $params
*
* @return ActiveDataProvider
*/
public function search($params)
{
$query = CheckoutItemModel::find();

$dataProvider = new ActiveDataProvider([
'query' => $query,
]);

$this->load($params);

if (!$this->validate()) {
// uncomment the following line if you do not want to return any records when validation fails
// $query->where('0=1');
return $dataProvider;
}

$query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'product_shipping_id' => $this->product_shipping_id,
            'quantity' => $this->quantity,
            'discount' => $this->discount,
            'price' => $this->price,
        ]);

return $dataProvider;
}
}
