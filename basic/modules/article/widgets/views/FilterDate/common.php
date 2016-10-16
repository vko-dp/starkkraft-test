<?php
/**
 * @var $this yii\web\View
 * @var $dateFilter array
 * @var $formName string
 */
?>

<p><a class="btn btn-default" href="<?= \yii\helpers\Url::to(['main/index'])?>">Сбросить фильтр &raquo;</a></p>

<h3>Фильтр по датам:</h3>
<div>
    <?php foreach($dateFilter as $k => $v) { ?>
        <a href="<?= \yii\helpers\Url::to(['main/index', "{$formName}[year]" => $k]); ?>"><?= $k; ?></a>
        <ul>
            <?php foreach($v as $m) { ?>
                <li><a href="<?= \yii\helpers\Url::to(['main/index', "{$formName}[year]" => $k, "{$formName}[month]" => $m['month']]); ?>"><?= $m['month_name']; ?></a> <span>(<?= $m['cnt']; ?>)</span></li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
