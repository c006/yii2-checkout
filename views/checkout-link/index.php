<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel c006\checkout\models\search\CheckoutLink */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Checkout Links');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-link-index">

    <h1><?= Html::encode($this->title) ?></h1>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a(Yii::t('app', 'Create Checkout Link'), ['create'], ['class' => 'btn btn-secondary']) ?>
    </p>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

                    'order_id',
            'item_id',
            'shipping_id',

        ['class' => 'yii\grid\ActionColumn'],
        ],
        ]); ?>
    
</div>
