<?php

namespace bupy7\pages;

use Yii;

/**
 * Module implements CRUD with static pages.
 * 
 * @author Vasilij Belosludcev http://mihaly4.ru
 * @version 1.0.0
 */
class Module extends \yii\base\Module
{
    
    /**
     * @var string Table name of model \bupy7\pages\models\Page.
     * @see \yii\db\ActiveRecord::tableName()
     */
    public $tableName = '{{%page}}';
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
    
    /**
     * Registeration translation files.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['bupy7/pages/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@bupy7/pages/messages',
            'fileMap' => [
                'bupy7/pages/core' => 'core.php',
            ],
        ];
    }

    /**
     * Translates a message to the specified language.
     * 
     * @param string $message the message to be translated.
     * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
     * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current application language
     * will be used.
     * @return string
     */
    public static function t($message, $params = [], $language = null)
    {
        return Yii::t('bupy7/pages/core', $message, $params, $language);
    }
    
}
