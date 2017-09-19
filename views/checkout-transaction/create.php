<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutTransaction */

$this->title = Yii::t('app', 'Create Checkout Transaction');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
