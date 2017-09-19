<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutTransaction */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
  'modelClass' => 'Checkout Transaction',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="checkout-transaction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
