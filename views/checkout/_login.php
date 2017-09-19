<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new \c006\checkout\models\form\Login();
?>

<style>
    #login-container {
        display               :block;
        margin                :10px;
        padding               :10px;
        border                :1px solid #CCCCCC;
        min-height            :240px;
        -webkit-border-radius :4px;
        -moz-border-radius    :4px;
        border-radius         :4px;
    }
    #login-container label {
        display:none;
    }
</style>

<div id="login-container">
    <?php $form = ActiveForm::begin([]); ?>
    <div class="title-medium">Login</div>
    <div class="form-group">
        <?= $form->field($model, 'email')->textInput(['placeholder'=> 'Email']) ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'password')->textInput(['placeholder'=> 'Password']) ?>
    </div>
    <div class="form-group">
        <div class="table">
            <div class="table-cell align-left"><?= Html::submitButton('Login & Continue', ['class' => 'btn btn-primary', 'id' => 'button-continue']) ?></div>
            <div class="table-cell align-right">
                <?= Html::button('Recover Password', ['class' => 'btn btn-secondary', 'id' => 'button-forgot']) ?>
                <?= Html::a('Register', '/user/signup', ['class' => 'btn btn-secondary', 'id' => 'button-signup']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
