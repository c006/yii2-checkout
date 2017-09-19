<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutLink */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
  'modelClass' => 'Checkout Link',
]) . ' ' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_id, 'url' => ['view', 'order_id' => $model->order_id, 'item_id' => $model->item_id, 'shipping_id' => $model->shipping_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="checkout-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
