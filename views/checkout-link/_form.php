<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model c006\checkout\models\CheckoutLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkout-link-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'item_id')->textInput() ?>

    <?= $form->field($model, 'shipping_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
