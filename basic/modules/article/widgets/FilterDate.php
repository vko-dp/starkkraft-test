<?php
/**
 * Created by PhpStorm.
 * User: Varenko Oleg
 * Date: 16.10.2016
 * Time: 17:59
 */

namespace app\modules\article\widgets;

use app\helpers\DateHelper;
use app\models\Article;
use Yii;
use yii\base\Widget;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class FilterDate extends Widget
{
    public $formName = 'ArticleSearch';

    public function run() {

        //--- получаем данные для фильтра по датам кешируем на 10 минут
        $dateFilter = Article::getDb()->cache(function(){

            return Article::find()
                ->select(new Expression("YEAR(date_created) as year, MONTH(date_created) as month, COUNT(*) as cnt"))
                ->groupBy('year, month')
                ->asArray()
                ->all();
        }, 600);
        ArrayHelper::multisort($dateFilter, ['year', 'month'], SORT_DESC);
        //--- соберем новый массив для удобного вывода
        $dateResult = [];
        foreach($dateFilter as &$v) {
            if(isset($v['month'])) {
                $v['month_name'] = DateHelper::getMonth((int)$v['month']);
            }
            if(!isset($dateResult[$v['year']])) {
                $dateResult[$v['year']] = [];
            }
            $dateResult[$v['year']][] = $v;
        }
        unset($v);
        unset($dateFilter);

        return $this->render('FilterDate/common', [
            'dateFilter' => $dateResult,
            'formName' => $this->formName
        ]);
    }
}