<?php
use yii\helpers\Html;

?>
<div class="title-large">Coupon & Voucher</div>

<?= yii\base\View::render('_progress', ['array' => [
    ['url' => '/checkout', 'progress' => 1, 'alt' => 'Login'],
    ['url' => '/checkout/2', 'progress' => 1, 'alt' => 'Coupon'],
    ['url' => '/checkout/3', 'progress' => 1, 'alt' => 'Address'],
    ['url' => '/checkout/4', 'progress' => 1, 'alt' => 'Payment'],
    ['url' => '/checkout/5', 'progress' => 1, 'alt' => 'Confirmation'],
],
]) ?>

<div id="coupons">
    <div class="item-container">

        <div class="table">
            <div class="table-cell vertical-align-top padding-10">
                <?= yii\base\View::render('@c006/coupon/views/frontend/index', []) ?>
            </div>
            <div class="table-cell vertical-align-top padding-10">

            </div>
        </div>
    </div>

    <div class="form-group margin-top-10">
        <?= Html::a(Yii::t('app', 'Continue'), '/checkout/3', ['class' => 'btn btn-primary']) ?>
    </div>


</div>

