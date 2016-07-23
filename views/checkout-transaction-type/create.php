<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutTransactionType */

$this->title = Yii::t('app', 'Create Checkout Transaction Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Transaction Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-transaction-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
