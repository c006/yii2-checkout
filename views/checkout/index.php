<?php

?>


<div id="checkout-container">

    <div class="title-large">Checkout</div>

    <?= yii\base\View::render('_progress', ['array' => \c006\checkout\assets\AppProgress::progress()]) ?>

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
