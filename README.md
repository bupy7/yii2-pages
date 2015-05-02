yii2-pages
==========
Module implements CRUD with static pages with uses Imperavi Redactor.

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

**Add module to your config file:**

```php
'modules' => [
    ...

    'pages' => [
        'class' => 'bupy7\pages\Module',
    ],
]
```

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

**Create new migration**

```php
./yii migrate/create bupy7_pages_create_page_table
```

In migration file you need extending class from ```\bupy7\pages\migrations\m150429_155009_create_page_table```.

Example:

```php
<?php

class m150429_162704_bupy7_pages_create_page_table extends \bupy7\pages\migrations\m150429_155009_create_page_table
{

}
```

Run migrate ```./yii migrate/up```

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

License
-------

yii2-pages is released under the BSD 3-Clause License.
