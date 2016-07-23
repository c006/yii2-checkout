<?php
/** @var $array array */

//print_r($array); exit;
?>

<style>
    #progress-container {
        display :block;
    }

    #progress-container .table {
        margin :auto;
        width  :auto;
    }

    #progress-container .icon {
        width           :20px;
        height          :20px;
        background-size :20px;
    }

    #progress-container .icon-progress-on {
        cursor :pointer;
    }
</style>

<div id="progress-container">
    <div class="align-center">
        <div class="table">
            <?php foreach ($array as $item) : ?>

                <div class="table-cell padding-10">
                    <?php if ($item['url']) : ?><a href="<?= $item['url'] ?>"><?php endif ?>
                        <span class="icon <?= ($item['progress']) ? 'icon-progress-on' : 'icon-progress-off' ?>" title="<?= $item['alt'] ?>"></span>
                        <?php if ($item['url']) : ?></a><?php endif ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
