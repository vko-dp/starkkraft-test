<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date_created
 * @property integer $theme_id
 * @property Theme $theme
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'date_created'], 'required'],
            [['description'], 'string'],
            [['date_created'], 'safe'],
            [['theme_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'название',
            'description' => 'текст',
            'date_created' => 'дата публикации',
            'theme_id' => 'тема',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTheme() {
        return $this->hasOne(Theme::className(), ['id' => 'theme_id']);
    }

    /**
     * Здесь лучше было бы сделать поведение
     * но т.к. задача небольшая - то просто перегрузил метод чтобы пересчитать количество
     * новостей для тем и сохранить данные
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes) {

        //--- только если тема новости изменилась при редактировании
        if(!$insert && isset($changedAttributes['theme_id']) && $changedAttributes['theme_id'] != $this->theme_id) {
            $theme = Theme::findOne($changedAttributes['theme_id']);
            if($theme) {
                $theme->updateCounters(['article_cnt' => -1]);
            }
        }
        $this->theme->updateCounters(['article_cnt' => 1]);
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * после удаления новости уменьшаем счетчик в теме
     */
    public function afterDelete() {

        $this->theme->updateCounters(['article_cnt' => -1]);
        parent::afterDelete();
    }
}
