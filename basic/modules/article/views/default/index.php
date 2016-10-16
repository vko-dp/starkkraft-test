<?php
/**
 * @var $this yii\web\View
 * @var $model app\models\Article
 */
?>

<div class="site-index">

    <div class="body-content">

        <h1><?= $model->name; ?></h1>
        <span class="text-warning"><?= Yii::$app->formatter->asDate($model->date_created, 'dd MMMM yyyyг.'); ?></span>, <strong><?= $model->theme->name; ?></strong>
        <p><?= $model->description; ?></p>
        <div>
            <a href="<?= \yii\helpers\Url::to(['main/index'])?>">все новости &raquo;</a>
        </div>

    </div>
</div>
