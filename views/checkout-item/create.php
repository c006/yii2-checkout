<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutItem */

$this->title = Yii::t('app', 'Create Checkout Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Checkout Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
