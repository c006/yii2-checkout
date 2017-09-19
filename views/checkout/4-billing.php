<?php
use c006\common\models\CommonCountry;
use c006\core\assets\CoreHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model_cc \c006\checkout\models\form\BillingCreditCard */
/** @var $model_bt \c006\checkout\models\form\BillingBankTransfer */
/** @var transaction_type integer */
?>

<style>
    #credit-cart {
        display : block;
        }

    #bank-transfer {
        display : none;
        }
</style>

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

    <div class="item-container margin-top-20 margin-bottom-20">
        <div class="title-medium">Payment Type</div>
        <div class="form-group">
            <select id="billing-choose" class="form-control">
                <option value="credit-cart">Credit Card</option>
                <option value="bank-transfer">Bank Transfer</option>
            </select>
        </div>
    </div>

    <div id="credit-cart" class="container-payment">

        <div class="item-container">

            <div class="title-medium">Credit Card</div>

            <?php $form = ActiveForm::begin(['id' => 'form-cc-' . time(),]); ?>

            <div class="form-group">
                <?= $form->field($model_cc, 'cc_name')->textInput(['placeholder' => 'Name on Card'])->label('Card Holder Name') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model_cc, 'cc_number')->textInput(['placeholder' => 'Number'])->label("Card Number") ?>
            </div>
            <div class="form-group">
                <div class="table">
                    <div class="table-cell vertical-align-top width-50">
                        <?= $form->field($model_cc, 'cc_exp_month')->dropDownList(CoreHelper::monthsArray())->label("Exp Month") ?></div>
                    <div class="table-cell vertical-align-top padding-left-20">
                        <?= $form->field($model_cc, 'cc_exp_year')->dropDownList(CoreHelper::minMaxRange(date('Y'), date('Y') + 10)) ?></div>
                </div>
            </div>
            <div class="form-group">
                <div class="table">
                    <div class="table-cell vertical-align-top width-50">
                        <?= $form->field($model_cc, 'cc_postal_code')->textInput(['placeholder' => 'Zip Code'])->label("Postal Code") ?>
                    </div>
                    <div class="table-cell vertical-align-top padding-left-20">
                        <?php
                        $model_cc_link = CommonCountry::find()->all();
                        $model_cc_link = ArrayHelper::map($model_cc_link, 'id', 'data');
                        ?>
                        <?= $form->field($model_cc, 'cc_country')->dropDownList($model_cc_link)->label("Country") ?></div>
                </div>
            </div>
            <div class="form-group">
                <?= $form->field($model_cc, 'cvv')->textInput(['placeholder' => 'Security Code']) ?>
            </div>

        </div>
        <div class="form-group margin-top-10">
            <?= Html::submitButton('Continue', ['class' => 'btn btn-primary', 'id' => 'button-continue']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>


    <div id="bank-transfer" class="container-payment">

        <div class="item-container">

            <div class="title-medium">Bank Transfer</div>

            <?php $form = ActiveForm::begin(['id' => 'form-bt-' . time(),]); ?>

            <div class="form-group">
                <?
                $model_link = \c006\authorizeNet\models\Banks::find()->orderBy('name')->all();
                $model_link = ArrayHelper::map($model_link, 'name', 'name');
                ?>
                <?= $form->field($model_bt, 'bt_bank')->dropDownList($model_link)->label('Bank') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model_bt, 'bt_name')->textInput(['placeholder' => ''])->label('Name on Account') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model_bt, 'bt_account')->textInput(['placeholder' => ''])->label('Account Number') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model_bt, 'bt_routing')->textInput(['placeholder' => 'Bank routing number'])->label('Routing Number') ?>
            </div>
        </div>
        <div class="form-group margin-top-10">
            <?= Html::submitButton('Continue', ['class' => 'btn btn-primary', 'id' => 'button-continue']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>


    <script type="text/javascript">
        jQuery(function () {
            jQuery('#billing-choose').bind('change', function () {
                jQuery('.container-payment').hide();
                jQuery('#' + jQuery(this).val()).show();
            });

            <?php if ($transaction_type == 2) :?>
            jQuery('#billing-choose').val('bank-transfer').trigger('change');
            <?php endif;?>
        });

    </script>


</div>
<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>

