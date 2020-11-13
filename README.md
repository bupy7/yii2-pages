yii2-pages
==========

Just testing some changes in this plugin.

[![Latest Stable Version](https://poser.pugx.org/bupy7/yii2-pages/v/stable)](https://packagist.org/packages/bupy7/yii2-page)
[![Total Downloads](https://poser.pugx.org/bupy7/yii2-pages/downloads)](https://packagist.org/packages/bupy7/yii2-pages)
[![Latest Unstable Version](https://poser.pugx.org/bupy7/yii2-pages/v/unstable)](https://packagist.org/packages/bupy7/yii2-pages)
[![License](https://poser.pugx.org/bupy7/yii2-pages/license)](https://packagist.org/packages/bupy7/yii2-pages)
[![Build Status](https://travis-ci.org/bupy7/yii2-pages.svg?branch=master)](https://travis-ci.org/bupy7/yii2-pages)
[![Coverage Status](https://coveralls.io/repos/github/bupy7/yii2-pages/badge.svg?branch=master)](https://coveralls.io/github/bupy7/yii2-pages?branch=master)

A static pages module implements CRUD using Imperavi Redactor.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bupy7/yii2-pages "*"
```

or add

```
"bupy7/yii2-pages": "*"
```

to the require section of your `composer.json` file.


Installation
------------

**Add module in your config file:**

```php
'bootstrap' => ['pages'],

...

'modules' => [
    ...

    'pages' => 'bupy7\pages\Module',
]
```

> You must add the above config in your console config file to apply migrations.

By default module uses table name '{{%page}}'. If in your database this table is 
exist - change it adding to configuration of module new table name:

```php
'modules' => [
    ...

    'pages' => [
        'class' => 'bupy7\pages\Module',
        'tableName' => '{{%your_table_name}}',
    ],
]
```

**Run migration**

```php
./yii migrate/up --migrationPath=@bupy7/pages/migrations
```

> Without module in console config file this command will throw an exception.

Usage
-----

In module two controllers: ```default``` and ```manager```.

**manager** need for control the pages out of the control panel. You need 
protect it controller via ```controllerMap``` or override it for add behavior with ```AccessControl```.

Example:

```php
'modules' => [
    ...

    'pages' => [
        'class' => 'bupy7\pages\Module',
        
        ...

        'controllerMap' => [
            'manager' => [
                'class' => 'bupy7\pages\controllers\ManagerController',
                'as access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],
            ],
        ],
    ],
],
```

**default** for display of pages to site. You need add url rules to
file of config for getting content via aliases pages.

Example:

```php
'urlManager' => [
    'rules' => [
        ...

        'pages/<page:[\w-]+>' => 'pages/default/index',
    ],
],
```

You can upload and add files/images via Imperavi Redactor, if enable it:

```php
'modules' => [
    ...
    
    'pages' => [
        'class' => 'bupy7\pages\Module',
        
        ...

        'pathToImages' => '@webroot/images',
        'urlToImages' => '@web/images',
        'pathToFiles' => '@webroot/files',
        'urlToFiles' => '@web/files',
        'uploadImage' => true,
        'uploadFile' => true,
        'addImage' => true,
        'addFile' => true,
    ],
],
```

Set up the custom language at Imperavi redactor:

```php
'modules' => [
    ...

    'pages' => [
        'class' => 'bupy7\pages\Module',
        'imperaviLanguage' => 'es',
    ],
]
```

There is all list a languages here: `/vendor/vova07/yii2-imperavi-widget/src/assets/lang`.

License
-------

yii2-pages is released under the BSD 3-Clause License.
