<?php

namespace app\modules\article\controllers;

use app\models\Article;
use yii\web\Controller;

/**
 * Default controller for the `article` module
 */
class DefaultController extends Controller
{
    /**
     * @param $id
     * @return string
     */
    public function actionIndex($id)
    {
        return $this->render('index', [
            'model' => Article::findOne($id),
        ]);
    }
}
