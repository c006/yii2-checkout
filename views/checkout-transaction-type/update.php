<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutTransactionType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
  'modelClass' => 'Checkout Transaction Type',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Transaction Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="checkout-transaction-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
