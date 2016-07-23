<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutShipping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkout-shipping-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'address2')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => 13]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
