<?php
/**
 * @var $this yii\web\View
 * @var $pagination yii\data\Pagination
 * @var $sort yii\data\Sort
 * @var $models app\models\Article[]
 * @var $dateFilter array
 */
?>

<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">

                <?= \app\modules\article\widgets\FilterDate::widget(); ?>

                <?= \app\modules\article\widgets\FilterTheme::widget(); ?>

            </div>
            <div class="col-lg-9">

                <?= \yii\widgets\LinkSorter::widget(['sort' => $sort])?>
                <br>

                <?php foreach($models as $article) { ?>
                    <h2><?= $article->name; ?></h2>
                    <span class="text-warning"><?= Yii::$app->formatter->asDate($article->date_created, 'dd MMMM yyyyг.'); ?></span>, <strong><?= $article->theme->name; ?></strong>
                    <p><?= strlen($article->description) > 256 ? mb_substr($article->description, 0, 256) . ' ...' : $article->description; ?></p>
                    <div>
                        <a class="btn btn-primary btn-lg" href="<?= \yii\helpers\Url::to(['default/index', 'id' => $article->id])?>">читать далее &raquo;</a>
                    </div>
                <?php } ?>

                <br><br>
                <?= \yii\widgets\LinkPager::widget(['pagination' => $pagination]); ?>
            </div>
        </div>

    </div>
</div>
