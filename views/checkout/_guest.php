<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new \c006\checkout\models\form\Guest();

$model->email = 'clhosting@hotmail.com';
?>

<style>
    #guest-container {
        display               :block;
        margin                :10px;
        padding               :10px;
        border                :1px solid #CCCCCC;
        min-height            :240px;
        -webkit-border-radius :4px;
        -moz-border-radius    :4px;
        border-radius         :4px;
    }

    #guest-container label {
        display :none;
    }
</style>

<div id="guest-container">
    <?php $form = ActiveForm::begin([
            'action' => '/checkout',
    ]); ?>
    <div class="title-medium">Guest</div>
    <div class="form-group">
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Continue', ['class' => 'btn btn-primary', 'id' => 'button-continue']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

