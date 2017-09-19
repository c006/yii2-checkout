<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutOrder */

$this->title = Yii::t('app', 'Create Checkout Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
