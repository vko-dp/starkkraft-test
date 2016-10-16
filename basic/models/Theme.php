<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "theme".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_created
 * @property integer $article_cnt
 */
class Theme extends \yii\db\ActiveRecord
{
    protected static $_themeList = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'theme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_created'], 'required'],
            [['date_created'], 'safe'],
            [['article_cnt'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date_created' => 'Date Created',
            'article_cnt' => 'Article Cnt',
        ];
    }

    /**
     * @return array
     */
    public static function getAllThemes() {
        if(empty(self::$_themeList)) {
            self::$_themeList = self::find()
                ->select(['id', 'name'])
                ->asArray()
                ->indexBy('id')
                ->all();
            self::$_themeList = ArrayHelper::map(self::$_themeList, 'id', 'name');
        }
        return self::$_themeList;
    }
}
