<?php
/**
 * Created by PhpStorm.
 * User: Varenko Oleg
 * Date: 16.10.2016
 * Time: 18:07
 */

namespace app\modules\article\widgets;

use app\models\Theme;
use Yii;
use yii\base\Widget;

class FilterTheme extends Widget
{
    public $formName = 'ArticleSearch';

    public function run() {

        //--- получаем все темы по которым есть публикации и кешируем на 10 мин.
        $themeFilter = Theme::getDb()->cache(function(){

            return Theme::find()
                ->where(['>', 'article_cnt', 0])
                ->orderBy('name')
                ->all();
        }, 600);

        return $this->render('FilterTheme/common', [
            'themeFilter' => $themeFilter,
            'formName' => $this->formName
        ]);
    }
}