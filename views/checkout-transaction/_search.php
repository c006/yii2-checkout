<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\search\CheckoutTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkout-transaction-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'transaction_id') ?>

    <?= $form->field($model, 'transaction_type_id') ?>

    <?= $form->field($model, 'fee') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
