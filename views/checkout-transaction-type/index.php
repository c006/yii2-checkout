<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel c006\checkout\models\search\CheckoutTransactionType */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Checkout Transaction Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-transaction-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a(Yii::t('app', 'Create Checkout Transaction Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'name',

        ['class' => 'yii\grid\ActionColumn'],
        ],
        ]); ?>
    
</div>
