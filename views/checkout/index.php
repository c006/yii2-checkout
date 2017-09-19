<?php

?>


<div id="checkout-container">

    <div class="title-large">Checkout</div>

    <?= yii\base\View::render('_progress', ['array' => [
        ['url' => '', 'progress' => 1, 'alt' => 'Login'],
        ['url' => '/checkout/2', 'progress' => 1, 'alt' => 'Coupon'],
        ['url' => '/checkout/3', 'progress' => 1, 'alt' => 'Address'],
        ['url' => '/checkout/4', 'progress' => 1, 'alt' => 'Payment'],
        ['url' => '/checkout/5', 'progress' => 1, 'alt' => 'Confirmation'],
    ],
    ]) ?>

    <div class="item-container">
        <div class="table">
            <div class="table-cell">
                <?= yii\base\View::render('_login', []) ?>
            </div>
            <div class="table-cell width-50">
                <?= yii\base\View::render('_guest', []) ?>
            </div>
        </div>
    </div>


</div>
