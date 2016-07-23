<?php

namespace c006\checkout\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use c006\checkout\models\CheckoutOrder as CheckoutOrderModel;

/**
* CheckoutOrder represents the model behind the search form about `c006\checkout\models\CheckoutOrder`.
*/
class CheckoutOrder extends CheckoutOrderModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'user_id'], 'integer'],
            [['session_id'], 'safe'],
            [['subtotal', 'shipping', 'tax', 'total'], 'number'],
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
$query = CheckoutOrderModel::find();

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
            'user_id' => $this->user_id,
            'subtotal' => $this->subtotal,
            'shipping' => $this->shipping,
            'tax' => $this->tax,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id]);

return $dataProvider;
}
}
