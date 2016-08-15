<?php
use yii\helpers\Html;

/** @var $array array */
?>

<div class="title-large">Confirmation</div>

<?= yii\base\View::render('_progress', ['array' => \c006\checkout\assets\AppProgress::progress()]) ?>

<div id="success-container">

    <div class="item-container margin-bottom-30">

        <div class="title-large">Thank you for ordering.</div>
        <div class="title-medium">Order: <?= $array['order_id'] ?></div>
        <div class="text padding-top-20">
            We sent an invoice to <?= $array['email'] ?>. If you have any questions please contact us.
        </div>
        <div class="padding-top-20">
            <?= Html::a(Yii::t('app', 'Continue'), '/', ['class' => 'btn btn-primary']) ?>
        </div>

    </div>
</div>
