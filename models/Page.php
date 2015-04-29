<?php

namespace bupy7\pages\models;

use Yii;
use bupy7\pages\Module;

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
            [['title', 'alias'], 'required'],
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
            'title' => Module::t('Title'),
            'alias' => Module::t('Alias'),
            'published' => Module::t('Published'),
            'content' => Module::t('Content'),
            'title_browser' => Module::t('Title browser'),
            'meta_keywords' => Module::t('Meta Keywords'),
            'meta_description' => Module::t('Meta Description'),
            'created_at' => Module::t('Created at'),
            'updated_at' => Module::t('Updated at'),
        ];
    }
    
}
