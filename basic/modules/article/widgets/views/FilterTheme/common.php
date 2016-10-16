<?php
/**
 * @var $this yii\web\View
 * @var $themeFilter app\models\Theme[]
 * @var $formName string
 */
?>

<h3>Фильтр по темам:</h3>
<div>
    <?php foreach($themeFilter as $theme) { ?>
        <a href="<?= \yii\helpers\Url::to(['main/index', "{$formName}[theme_id]" => $theme->id]); ?>"><?= $theme->name; ?></a> <span>(<?= $theme->article_cnt; ?>)</span><br>
    <?php } ?>
</div>
