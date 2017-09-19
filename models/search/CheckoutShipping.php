<?php

namespace c006\checkout\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use c006\checkout\models\CheckoutShipping as CheckoutShippingModel;

/**
* CheckoutShipping represents the model behind the search form about `c006\checkout\models\CheckoutShipping`.
*/
class CheckoutShipping extends CheckoutShippingModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'order_id'], 'integer'],
            [['first_name', 'last_name', 'address', 'address2', 'city', 'state', 'postal_code', 'country'], 'safe'],
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
$query = CheckoutShippingModel::find();

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
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code])
            ->andFilterWhere(['like', 'country', $this->country]);

return $dataProvider;
}
}
