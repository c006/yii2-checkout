<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkout-order-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'session_id')->textInput(['maxlength' => 26]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'subtotal')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'shipping')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'tax')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-secondary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
