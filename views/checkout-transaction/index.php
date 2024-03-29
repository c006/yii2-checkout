<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel c006\checkout\models\search\CheckoutTransaction */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Checkout Transactions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a(Yii::t('app', 'Create Checkout Transaction'), ['create'], ['class' => 'btn btn-secondary']) ?>
    </p>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'order_id',
            'transaction_id',
            'transaction_type_id',
            'fee',
            // 'amount',
            // 'description',
            // 'timestamp:datetime',

        ['class' => 'yii\grid\ActionColumn'],
        ],
        ]); ?>
    
</div>
