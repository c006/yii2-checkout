<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\search\CheckoutItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkout-item-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'product_shipping_id') ?>

    <?= $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'price') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
