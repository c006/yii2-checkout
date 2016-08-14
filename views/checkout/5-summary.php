<?php
use c006\cart\assets\AppCartHelpers;
use c006\common\assets\AppCommon;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $cart array */
/** @var $shipping array */
/** @var $billing array */
/** @var $transaction_type array */

?>

<style>

    div.text {
        font-size: 1.0em;
        font-weight: 300;
        color: #666666;
        line-height: 1.5em;
    }

    .border-container {
        display: block;
        padding: 10px;
        margin: 5px;
        min-height: 180px;
        border: 1px solid #CCCCCC;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }
</style>

<div class="title-large">Summary</div>

<?= yii\base\View::render('_progress', ['array' => \c006\checkout\assets\AppProgress::progress()]) ?>

<div id="summay-container">

    <div class="item-container">

        <?= yii\base\View::render('@c006/cart/views/cart/_items', ['is_summary' => TRUE, 'items' => $cart]) ?>

        <?php $form = ActiveForm::begin([]); ?>

        <div class="form-group">
            <div class="table">
                <div class="table-cell vertical-align-top width-50 padding-10">
                    <div class="border-container">
                        <div class="title-heading">Shipping</div>
                        <?php if (AppCartHelpers::requiresShipping()) : ?>
                            <div class="text"><?= $shipping['first_name'] ?> <?= $shipping['last_name'] ?></div>
                            <div class="text"><?= $shipping['address'] ?> <?= $shipping['address2'] ?></div>
                            <div class="text"><?= $shipping['city'] ?>, <?= $shipping['state'] ?></div>
                            <div class="text"><?= $shipping['postal_code'] ?>, <?= AppCommon::getCountry($shipping['country'])['char2'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="table-cell vertical-align-top width-50 padding-10">
                    <div class="border-container">
                        <div class="title-heading">Billing</div>
                        <?php if ($transaction_type == 1) : ?>
                            <div class="text"><?= $billing['cc_name'] ?></div>
                            <div class="text">****<?= substr($billing['cc_number'], -4) ?></div>
                            <div class="text"><?= $billing['cc_exp_month'] ?>/<?= $billing['cc_exp_year'] ?></div>
                            <div class="text"><?= $billing['cc_postal_code'] ?>, <?= AppCommon::getCountry($billing['cc_country'])['char2'] ?></div>
                        <?php elseif ($transaction_type == 2) : ?>
                            <div class="text"><?= $billing['bt_bank'] ?></div>
                            <div class="text"><?= $billing['bt_name'] ?></div>
                            <div class="text">****<?= substr($billing['bt_account'], -4) ?></div>
                            <div class="text"><?= $billing['bt_routing'] ?></div>
                            <?php else : ?>
                            No billing needed
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group align-right margin-top-10">
        <?= Html::submitButton('Complete Order', ['class' => 'btn btn-primary', 'id' => 'button-continue']) ?>
        <input type="hidden" name="Checkout" value="<?= Yii::$app->session->id ?>"/>
    </div>


    <?php ActiveForm::end(); ?>
</div>

<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>
