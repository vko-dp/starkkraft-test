<?php
/**
 * Created by PhpStorm.
 * User: Varenko Oleg
 * Date: 16.10.2016
 * Time: 15:28
 */

namespace app\modules\article\controllers;

use Yii;
use app\modules\admin\models\ArticleSearch;
use yii\web\Controller;

class MainController extends Controller
{
    protected $_defaultPageSize = 5;

    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $dataProvider->setSort([
            'attributes' => [
                'date_created' => [
                    'asc' => ['date_created' => SORT_ASC],
                    'desc' => ['date_created' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'По дате',
                ],
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'По названию',
                ]
            ],
            'defaultOrder' => ['date_created' => SORT_DESC]
        ]);
        $dataProvider->setPagination(['defaultPageSize' => $this->_defaultPageSize]);

        return $this->render('index', [
            'models' => $dataProvider->getModels(),
            'pagination' => $dataProvider->getPagination(),
            'sort' => $dataProvider->getSort(),
        ]);
    }
}