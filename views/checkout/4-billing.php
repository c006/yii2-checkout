<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model \c006\checkout\models\form\Billing */
?>

<div class="title-large">Billing</div>

<?= yii\base\View::render('_progress', ['array' => [
        ['url' => '/checkout', 'progress' => 1, 'alt' => 'Login'],
        ['url' => '/checkout/2', 'progress' => 1, 'alt' => 'Coupon'],
        ['url' => '/checkout/3', 'progress' => 1, 'alt' => 'Address'],
        ['url' => '/checkout/4', 'progress' => 1, 'alt' => 'Payment'],
        ['url' => '/checkout/5', 'progress' => 1, 'alt' => 'Confirmation'],
],
]) ?>

<div id="shipping-container">
    <?php $form = ActiveForm::begin([
            'id' => 'form-billing-' . time(),
    ]); ?>
    <div class="form-group">
        <?= $form->field($model, 'cc_name')->textInput(['placeholder' => 'Name on Card'])->label('Card Holder Name') ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'cc_number')->textInput(['placeholder' => 'Number'])->label("Card Number") ?>
    </div>
    <div class="form-group">
        <div class="table">
            <div class="table-cell vertical-align-top width-50">
                <?= $form->field($model, 'cc_exp_month')->dropDownList(\c006\core\assets\CoreHelper::minMaxRange(1, 12))->label("Exp Month") ?></div>
            <div class="table-cell vertical-align-top padding-left-20">
                <?= $form->field($model, 'cc_exp_year')->dropDownList(\c006\core\assets\CoreHelper::minMaxRange(date('Y'), date('Y') + 10)) ?></div>
        </div>
    </div>
    <div class="form-group">
        <div class="table">
            <div class="table-cell vertical-align-top width-50">
                <?= $form->field($model, 'cc_postal_code')->textInput(['placeholder' => 'Zip Code'])->label("Postal Code") ?>
            </div>
            <div class="table-cell vertical-align-top padding-left-20">
                <?php
                $model_link = \common\models\CommonCountry::find()->all();
                $model_link = ArrayHelper::map($model_link, 'id', 'data');
                ?>
                <?= $form->field($model, 'cc_country')->dropDownList($model_link)->label("Country") ?></div>
        </div>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'cvv')->textInput(['placeholder' => 'Security Code']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Continue', ['class' => 'btn btn-primary', 'id' => 'button-continue']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>

