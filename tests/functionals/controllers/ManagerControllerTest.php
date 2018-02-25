<?php

namespace bupy7\pages\tests\functionals\behaviors;

use Yii;
use bupy7\pages\tests\functionals\TestCase;

class ManagerControllerTest extends TestCase
{
    public function testSearch()
    {
        // test 1
        $response = Yii::$app->runAction('/pages/manager/index');

        $this->assertContains('Example Title 1', $response);
        $this->assertContains('Example Title 2', $response);

        // test 2
        $response = Yii::$app->runAction('/pages/manager/index', ['PageSearch[title]' => 'Title 1']);

        $this->assertContains('Example Title 1', $response);
        $this->assertNotContains('Example Title 2', $response);
    }
}
