<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        'method' => 'post',
        ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'session_id',
            'user_id',
            'subtotal',
            'shipping',
            'tax',
            'total',
    ],
    ]) ?>

</div>
