<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить публикацию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => "{pager}\n{summary}\n{items}\n{pager}",
        'options' => ['style' => 'width: 100%;'],
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-condensed table-hover'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'headerOptions' => ['width' => '20%'],
            ],
            [
                'attribute' => 'date_created',
                'label' => 'дата',
                'format' => 'date',
                'headerOptions' => ['width' => '10%'],
            ],
            [
                'attribute' => 'description',
                'format' => 'raw',
                'enableSorting' => false,
                'headerOptions' => ['width' => '40%'],
                'value' => function(app\models\Article $article){
                    return strlen($article->description) > 256 ? mb_substr($article->description, 0, 256) . ' ...' : $article->description;
                }
            ],
            [
                'attribute' => 'theme.name',
                'label' => 'тема',
                'format' => 'raw',
                'filter' => false,
                'enableSorting' => false,
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
