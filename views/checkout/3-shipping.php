<?php
use c006\common\models\CommonCountry;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model c006\checkout\models\form\Shipping */
?>

<div class="title-large">Shipping</div>

<?= yii\base\View::render('_progress', ['array' => \c006\checkout\assets\AppProgress::progress()]) ?>

<div id="shipping-container">

    <div class="item-container margin-bottom-20">

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
            <?= $form->field($model, 'shipping')->hiddenInput()->label(FALSE) ?>
        </div>
    </div>

    <div class="item-container margin-bottom-20">
        <div class="title-medium">SHIPPING OPTIONS</div>
        <div id="shipping-options"></div>
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
                    get_shipping($country.val(), $this.val());
                    $.ajax({
                        dataType: "json",
                        url: '/c006-common/address',
                        data: {country: $country.val(), postal_code: $this.val()},
                        success: function (data) {
                            jQuery('#shipping-city').val(data.city);
                            jQuery('#shipping-state').val(data.state_2);
                            hide_submit_spinner();
                        }
                    });
                }
            }
        });


        function get_shipping(_country, _postal) {
            show_submit_spinner();
            $.ajax({
                dataType: "json",
                url: '/checkout/ajax/shipping',
                data: {country: _country, postal_code: _postal},
                success: function (data) {
                    var _html = '<div class="table" style="width: auto">';
                    jQuery.each(data, function (i, item) {
                        _html += '' +
                            '<div class="table-row">' +
                            '   <div class="table-cell padding-5"><input type="radio" class="form-control shipping-option" name="shipping" value="' + item.id + '" /></div>' +
                            '   <div class="table-cell padding-5 bold">' + item.service_name + '</div>' +
                            '   <div class="table-cell padding-5 title-text">$' + item.flat_rate + '</div>' +
                            '</div>';
                    });

                    jQuery('#shipping-options').append(_html + '</div>');

                    jQuery('.shipping-option').unbind('click')
                        .bind('click', function () {
                           jQuery('#shipping-shipping').val(jQuery(this).val());
                        });

                    <?php if ($model->shipping) : ?>
                    jQuery('.shipping-option')[<?= $model->shipping - 1?>].click();
                    <?php endif; ?>

                    hide_submit_spinner();
                }
            });
        }


        if ($postal_code.val()) {
            $postal_code.trigger('keyup');
        }


    });
</script>
