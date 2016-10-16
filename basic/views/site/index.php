<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Админка</h2>

                <p><a class="btn btn-default" href="<?= \yii\helpers\Url::to(['admin/article/index'])?>">В админку &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Показать публикации</h2>

                <p><a class="btn btn-default" href="<?= \yii\helpers\Url::to(['article/main/index'])?>">Показать публикации &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
