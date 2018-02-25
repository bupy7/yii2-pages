<?php

namespace bupy7\pages\tests\functionals\behaviors;

use Yii;
use bupy7\pages\tests\functionals\TestCase;

class DefaultControllerTest extends TestCase
{
    public function testPublishedPage()
    {
        $response = Yii::$app->runAction('/pages/default/index', ['page' => 'example-title-1']);

        $this->assertEquals(200, Yii::$app->response->getStatusCode());
        $this->assertContains('Example Content 1', $response);
        $this->assertContains('Example Title Browser 1', $response);
        $this->assertContains('Example Title 1', $response);
        $this->assertContains('example,meta,keywords,1', $response);
        $this->assertContains('example meta-description 1', $response);
    }

    /**
     * @expectedException \yii\web\NotFoundHttpException
     */
    public function testUnpublishedPage()
    {
        Yii::$app->runAction('/pages/default/index', ['page' => 'example-title-2']);
    }
}
