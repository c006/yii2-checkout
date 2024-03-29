<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutLink */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-link-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'order_id' => $model->order_id, 'item_id' => $model->item_id, 'shipping_id' => $model->shipping_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'order_id' => $model->order_id, 'item_id' => $model->item_id, 'shipping_id' => $model->shipping_id], [
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
                'order_id',
            'item_id',
            'shipping_id',
    ],
    ]) ?>

</div>
