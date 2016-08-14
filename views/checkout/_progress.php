<?php
/** @var $array array */

//print_r($array); exit;
?>

<style>
    #progress-container {
        display : block;
        }

    #progress-container .table {
        margin : auto;
        width  : auto;
        }

    #progress-container .icon-progress {
        display               : inline-block;
        width                 : 20px;
        height                : 20px;
        -webkit-border-radius : 10px;
        -moz-border-radius    : 10px;
        border-radius         : 10px;
        cursor                : pointer;
        }

    #progress-container .icon-progress-0 {
        background-color : #CCCCCC;
        }

    #progress-container .icon-progress-1 {
        background-color : #ae9d4f;
        }

    #progress-container .icon-progress-2 {
        background-color : #ff8300;
        }

</style>

<div id="progress-container">
    <div class="align-center">
        <div class="table">
            <?php foreach ($array as $item) : ?>

                <div class="table-cell padding-10">
                    <?php if ($item['progress'] == 0) : ?>
                        <span class="icon-progress icon-progress-<?= $item['progress'] ?>" title="<?= $item['alt'] ?>" style="cursor: default"></span>
                    <?php else : ?>
                        <?php if ($item['url']) : ?>
                            <a href="<?= $item['url'] ?>"><span class="icon-progress icon-progress-<?= $item['progress'] ?>" title="<?= $item['alt'] ?>"></span></a>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
