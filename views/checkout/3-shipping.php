<?php
use c006\common\models\CommonCountry;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model c006\checkout\models\form\Shipping */
?>

<div class="title-large">Shipping</div>

<?= yii\base\View::render('_progress', ['array' => [
    ['url' => '/checkout', 'progress' => 1, 'alt' => 'Login'],
    ['url' => '/checkout/2', 'progress' => 1, 'alt' => 'Coupon'],
    ['url' => '/checkout/3', 'progress' => 1, 'alt' => 'Address'],
    ['url' => '/checkout/4', 'progress' => 1, 'alt' => 'Payment'],
    ['url' => '/checkout/5', 'progress' => 1, 'alt' => 'Confirmation'],
],
]) ?>

<div id="shipping-container">

    <div class="item-container marging-bottom-20">

        <?php $form = ActiveForm::begin([
            'id' => 'form-shipping-' . time(),
        ]); ?>
        <div class="form-group">
            <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'First Name']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Last Name']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'address')->textInput(['placeholder' => 'Address']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'address2')->textInput(['placeholder' => 'Apt / Suite']) ?>
        </div>
        <div class="form-group">
            <?
            $model_link = CommonCountry::find()->all();
            $model_link = ArrayHelper::map($model_link, 'id', 'data');
            echo $form->field($model, 'country')->dropDownList($model_link)->label('Country')
            ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'postal_code')->textInput(['placeholder' => 'Postal / Zip Code']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'city')->textInput(['placeholder' => 'City']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'state')->textInput(['placeholder' => 'State']) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'use_for_billing')->dropDownList(['No', 'Yes']) ?>
        </div>
    </div>

    <div class="form-group margin-top-10">
        <?= Html::submitButton('Continue', ['class' => 'btn btn-primary', 'id' => 'button-continue']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>

<script type="text/javascript">
    jQuery(function () {
        var $postal_code = jQuery('#shipping-postal_code');
        $postal_code.bind('keyup blur', function () {
            var $this = jQuery(this);
            var _val = $this.val();
            var $country = jQuery('#shipping-country');
            if ($country.val() == "223") {
                $this.val(_val.toString().replace(/[^0-9]/g, ''));
                if ($this.val().length == 5) {
                    show_submit_spinner();
                    $.ajax({
                        dataType: "json",
                        url: '/c006-common/address',
                        data: {country: $country.val(), postal_code: $this.val()},
                        success: function (data) {
                            console.log(data);
                            jQuery('#shipping-city').val(data.city);
                            jQuery('#shipping-state').val(data.state_2);
                            hide_submit_spinner();
                        }
                    });
                }
            }
        });
    });
</script>
