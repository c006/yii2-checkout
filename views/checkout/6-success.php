<?php
use yii\helpers\Html;

/** @var $array array */
?>

<style>
    #success-container {
        margin                :20px;
        padding               :10px;
        text-align            :center !important;
        -webkit-border-radius :5px;
        -moz-border-radius    :5px;
        border-radius         :5px;
        border                :1px solid #CCCCCC;
    }
</style>

<div id="success-container">

    <div class="title-large">Thank you for ordering.</div>
    <div class="title-medium">Order: <?= $array['order_id'] ?></div>
    <div class="text">
        We sent an invoice to <?= $array['email'] ?>. If you have any questions please contact us.
    </div>
    <div class="padding-top-20">
        <?= Html::a(Yii::t('app', 'Continue'), '/', ['class' => 'btn btn-primary']) ?>
    </div>

</div>
