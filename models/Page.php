<?php

namespace bupy7\pages\models;

use Yii;
use bupy7\pages\Module;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%pages}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property integer $published
 * @property string $content
 * @property string $title_browser
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $created_at
 * @property string $updated_at
 */
class Page extends \yii\db\ActiveRecord
{
    
    /**
     * Value of 'published' field where page is not published.
     */
    const PUBLISHED_NO = 0;
    /**
     * Value of 'published' field where page is published.
     */
    const PUBLISHED_YES = 1;
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias',
                'immutable' => true,
            ]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Yii::$app->getModule('pages')->tableName;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['published'], 'boolean'],
            [['content'], 'string', 'max' => 65535],
            [['title', 'alias', 'title_browser'], 'string', 'max' => 255],
            [['meta_keywords'], 'string', 'max' => 200],
            [['meta_description'], 'string', 'max' => 160],
            [['alias'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'title' => Module::t('TITLE'),
            'alias' => Module::t('ALIAS'),
            'published' => Module::t('PUBLISHED'),
            'content' => Module::t('CONTENT'),
            'title_browser' => Module::t('TITLE_BROWSER'),
            'meta_keywords' => Module::t('META_KEYWORDS'),
            'meta_description' => Module::t('META_KEYWORDS'),
            'created_at' => Module::t('CREATED_AT'),
            'updated_at' => Module::t('UPDATED_AT'),
        ];
    }
    
    /**
     * List values of field 'published' with label.
     * @return array
     */
    static public function publishedDropDownList()
    {
        $formatter = Yii::$app->formatter;
        return [
            self::PUBLISHED_NO => $formatter->asBoolean(self::PUBLISHED_NO),
            self::PUBLISHED_YES => $formatter->asBoolean(self::PUBLISHED_YES),
        ];
    }
    
}
