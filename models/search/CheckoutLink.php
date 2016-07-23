<?php

namespace c006\checkout\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use c006\checkout\models\CheckoutLink as CheckoutLinkModel;

/**
* CheckoutLink represents the model behind the search form about `c006\checkout\models\CheckoutLink`.
*/
class CheckoutLink extends CheckoutLinkModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['order_id', 'item_id', 'shipping_id'], 'integer'],
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
$query = CheckoutLinkModel::find();

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
            'order_id' => $this->order_id,
            'item_id' => $this->item_id,
            'shipping_id' => $this->shipping_id,
        ]);

return $dataProvider;
}
}
