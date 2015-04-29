<?php

namespace bupy7\pages;

use Yii;
use yii\base\InvalidConfigException;

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
     * @var boolean Enable ability add images via Imperavi Redactor? If this property is 'true', you must be
     * set property '$pathToImages' and '$urlToImages'.
     */
    public $addImage = false;
    
    /**
     * @var mixed Action of images add. By default 'images-get' to 'bupy7/pages/controllers/ManagerController'.
     */
    public $imagesGetAction = ['images-get'];
    
    /**
     * @var boolean Enable ability upload images via Imperavi Redactor? If this property is 'true', you must be
     * set property '$pathToImages', '$urlToImages' and '$imageUploadAction'.
     */
    public $uploadImage = false;
    
    /**
     * @var mixed Action of images upload. By default 'image-upload' to 'bupy7/pages/controllers/ManagerController'.
     */
    public $imageUploadAction = ['image-upload'];
    
    /**
     * @var string Alias of absolute path to directory with images for upload images via Imperavi Redactor. If not 
     * set, then this ability not used.
     * @example '@webroot/uploads/images'
     * @see \vova07\imperavi\actions\GetAction::$path
     */
    public $pathToImages;
    
    /**
     * @var string Alias of URL to directory with images for get images uploaded via Imperavi Redactor. If not set, 
     * then this ability not used.
     * @example '@web/uploads/images'
     * @see \vova07\imperavi\actions\GetAction::$url
     */
    public $urlToImages;
    
    /**
     * @var boolean Enable ability add files via Imperavi Redactor? If this property is 'true', you must be
     * set property '$pathToFiles' and '$urlToFiles'.
     */
    public $addFile = false;
    
    /**
     * @var mixed Action of files add. By default 'files-get' to 'bupy7/pages/controllers/ManagerController'.
     */
    public $filesGetAction = ['files-get'];
    
    /**
     * @var boolean Enable ability upload files via Imperavi Redactor? If this property is 'true', you must be
     * set property '$pathToFiles', '$urlToFiles' and '$fileUploadAction'.
     */
    public $uploadFile = false;
    
    /**
     * @var mixed Action of files upload. By default 'file-upload' to 'bupy7/pages/controllers/ManagerController'.
     */
    public $fileUploadAction = ['file-upload'];
    
    /**
     * @var string Alias of absolute path to directory with files for upload files via Imperavi Redactor. If not set, 
     * then this ability not used.
     * @example '@webroot/uploads/files'
     * @see \vova07\imperavi\actions\GetAction::$path
     */
    public $pathToFiles;
    
    /**
     * @var string Alias of URL to directory with files for uploaded files via Imperavi Redactor. If not set, then 
     * this ability not used.
     * @example '@web/uploads/files'
     * @see \vova07\imperavi\actions\GetAction::$url
     */
    public $urlToFiles;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->addImage && !($this->imagesGetAction && $this->pathToImages && $this->urlToImages)) {
            throw new InvalidConfigException("For add image via Imperavi Redactor you must be set 'imagesGetAction',"
                . " 'pathToImages' and 'urlToImages'.");
        } 
        if ($this->addFile && !($this->filesGetAction && $this->pathToFiles && $this->urlToFiles)) {
            throw new InvalidConfigException("For add file via Imperavi Redactor you must be set 'filesGetAction',"
                . " 'pathToFiles' and 'urlToFiles'.");
        } 
        if ($this->uploadImage && !($this->imageUploadAction && $this->pathToImages && $this->urlToImages)) {
            throw new InvalidConfigException("For upload image via Imperavi Redactor you must be set "
                . "'imageUploadAction', 'pathToImages' and 'urlToImages'.");
        }
        if ($this->uploadFile && !($this->fileUploadAction && $this->pathToFiles && $this->urlToFiles)) {
            throw new InvalidConfigException("For upload file via Imperavi Redactor you must be set "
                . "'fileUploadAction', 'pathToFiles' and 'urlToFiles'.");
        }
        $this->registerTranslations();
    }
    
    /**
     * Registeration translation files.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['bupy7/pages/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'forceTranslation' => true,
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
