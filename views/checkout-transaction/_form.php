<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutTransaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkout-transaction-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'transaction_id')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'transaction_type_id')->textInput() ?>

    <?= $form->field($model, 'fee')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
