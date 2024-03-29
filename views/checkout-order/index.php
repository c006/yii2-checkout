<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel c006\checkout\models\search\CheckoutOrder */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Checkout Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a(Yii::t('app', 'Create Checkout Order'), ['create'], ['class' => 'btn btn-secondary']) ?>
    </p>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'session_id',
            'user_id',
            'subtotal',
            'shipping',
            // 'tax',
            // 'total',

        ['class' => 'yii\grid\ActionColumn'],
        ],
        ]); ?>
    
</div>
