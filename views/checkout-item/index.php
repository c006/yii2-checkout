<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel c006\checkout\models\search\CheckoutItem */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Checkout Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a(Yii::t('app', 'Create Checkout Item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'order_id',
            'product_id',
            'product_shipping_id',
            'quantity',
            // 'discount',
            // 'price',

        ['class' => 'yii\grid\ActionColumn'],
        ],
        ]); ?>
    
</div>
