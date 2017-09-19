<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutShipping */

$this->title = Yii::t('app', 'Create Checkout Shipping');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Shippings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-shipping-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
