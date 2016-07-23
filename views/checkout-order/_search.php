<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\search\CheckoutOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkout-order-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'subtotal') ?>

    <?= $form->field($model, 'shipping') ?>

    <?php // echo $form->field($model, 'tax') ?>

    <?php // echo $form->field($model, 'total') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
