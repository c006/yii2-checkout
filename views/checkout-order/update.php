<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutOrder */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
  'modelClass' => 'Checkout Order',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="checkout-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
