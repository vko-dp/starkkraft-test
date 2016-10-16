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
        $model = Article::findOne((int)$id);
        if(is_null($model)) {
            return $this->goHome();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
