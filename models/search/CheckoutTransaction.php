<?php

namespace c006\checkout\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use c006\checkout\models\CheckoutTransaction as CheckoutTransactionModel;

/**
* CheckoutTransaction represents the model behind the search form about `c006\checkout\models\CheckoutTransaction`.
*/
class CheckoutTransaction extends CheckoutTransactionModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'order_id', 'transaction_type_id', 'timestamp'], 'integer'],
            [['transaction_id', 'description'], 'safe'],
            [['fee', 'amount'], 'number'],
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
$query = CheckoutTransactionModel::find();

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
            'transaction_type_id' => $this->transaction_type_id,
            'fee' => $this->fee,
            'amount' => $this->amount,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'transaction_id', $this->transaction_id])
            ->andFilterWhere(['like', 'description', $this->description]);

return $dataProvider;
}
}
