<?php

namespace bupy7\pages\tests\functionals\behaviors;

use Yii;
use bupy7\pages\tests\functionals\TestCase;
use bupy7\pages\models\Page;

class ManagerControllerTest extends TestCase
{
    public function testSearch()
    {
        $response = Yii::$app->runAction('/pages/manager/index');

        $this->assertEquals(200, Yii::$app->response->getStatusCode());
        $this->assertContains('Example Title 1', $response);
        $this->assertContains('Example Title 2', $response);
    }

    public function testSearchByTitle()
    {
        $_GET = ['PageSearch' => [
            'title' => 'Title 1'
        ]];
        Yii::$app->request->setQueryParams(null);
        $response = Yii::$app->runAction('/pages/manager/index');

        $this->assertEquals(200, Yii::$app->response->getStatusCode());
        $this->assertContains('Example Title 1', $response);
        $this->assertNotContains('Example Title 2', $response);
    }

    public function testSearchByPublished()
    {
        $_GET = ['PageSearch' => [
            'published' => 1,
        ]];
        Yii::$app->request->setQueryParams(null);
        $response = Yii::$app->runAction('/pages/manager/index');

        $this->assertEquals(200, Yii::$app->response->getStatusCode());
        $this->assertContains('Example Title 1', $response);
        $this->assertNotContains('Example Title 2', $response);
    }

    public function testByUnpublished()
    {
        $_GET = ['PageSearch' => [
            'published' => 0,
        ]];
        Yii::$app->request->setQueryParams(null);
        $response = Yii::$app->runAction('/pages/manager/index');

        $this->assertEquals(200, Yii::$app->response->getStatusCode());
        $this->assertNotContains('Example Title 1', $response);
        $this->assertContains('Example Title 2', $response);
    }

    public function testCreate()
    {
        $response = Yii::$app->runAction('/pages/manager/create');

        $this->assertEquals(200, Yii::$app->response->getStatusCode());
        $this->assertContains('Create', $response);

        $_POST = [
            '_method' => 'POST',
            'Page' => [
                'title' => 'Example Create 3',
            ],
        ];
        Yii::$app->request->setBodyParams(null);
        Yii::$app->runAction('/pages/manager/create');

        $this->assertEquals(302, Yii::$app->response->getStatusCode());
        $this->assertEquals('Example Create 3', Page::findOne(['title' => 'Example Create 3'])->title);
    }

    public function testUpdate()
    {
        $page = Page::findOne(1);

        $response = Yii::$app->runAction('/pages/manager/update', ['id' => 1]);

        $this->assertEquals(200, Yii::$app->response->getStatusCode());
        $this->assertContains('Update', $response);
        $this->assertTrue((bool)$page->published);

        $_POST = [
            '_method' => 'POST',
            'Page' => array_merge($page->getAttributes(), [
                'published' => 0,
            ])
        ];
        Yii::$app->request->setBodyParams(null);
        Yii::$app->runAction('/pages/manager/update', ['id' => 1]);

        $this->assertEquals(302, Yii::$app->response->getStatusCode());
        $this->assertFalse((bool)Page::findOne(1)->published);
    }

    public function testDelete()
    {
        $_POST = ['_method' => 'POST'];
        Yii::$app->runAction('/pages/manager/delete', ['id' => 2]);

        $this->assertEquals(302, Yii::$app->response->getStatusCode());
        $this->assertNull(Page::findOne(2));
    }
}
