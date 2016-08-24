<?php
use yii\helpers\Html;

?>
<div class="title-large">Coupon & Voucher</div>

<?= yii\base\View::render('_progress', ['array' => \c006\checkout\assets\AppProgress::progress()]) ?>

<div id="coupons">
    <div class="item-container">

        <div class="table">
            <div class="table-cell vertical-align-top padding-10">
                <?= yii\base\View::render('@c006/coupon/views/frontend/index', ['return_url'=> $return_url]) ?>
            </div>
            <div class="table-cell vertical-align-top padding-10">
                <?= yii\base\View::render('@c006/cart/views/cart/mini-cart', []) ?>
            </div>
        </div>
    </div>

    <div class="form-group margin-top-10">
        <?= Html::a(Yii::t('app', 'Continue'), '/checkout/3', ['class' => 'btn btn-primary']) ?>
    </div>


</div>

