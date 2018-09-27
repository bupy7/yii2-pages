<?php

namespace bupy7\pages\models;

use Yii;
use bupy7\pages\Module;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%pages}}".
 *
 * @property integer $id
 * @property string $title
 * @property boolean $display_title
 * @property string $alias
 * @property integer $published
 * @property string|null $content
 * @property string|null $title_browser
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string $created_at
 * @property string $updated_at
 *
 * @since 1.4.0 Added the $display_title property
 *
 * @author Belosludcev Vasilij <bupy765@gmail.com>
 * @since 1.0.0
 */
class Page extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'sluggable' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'alias',
                'immutable' => true,
            ],
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
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
            [['display_title', 'published'], 'boolean'],
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
            'display_title' => Module::t('DISPLAY_TITLE'),
            'alias' => Module::t('ALIAS'),
            'published' => Module::t('PUBLISHED'),
            'content' => Module::t('CONTENT'),
            'title_browser' => Module::t('TITLE_BROWSER'),
            'meta_keywords' => Module::t('META_KEYWORDS'),
            'meta_description' => Module::t('META_DESCRIPTION'),
            'created_at' => Module::t('CREATED_AT'),
            'updated_at' => Module::t('UPDATED_AT'),
        ];
    }
    
    /**
     * List values of field 'published' with label.
     * @return array
     */
    public static function publishedDropDownList()
    {
        $formatter = Yii::$app->formatter;
        return [
            false => $formatter->asBoolean(false),
            true => $formatter->asBoolean(true),
        ];
    }
}
