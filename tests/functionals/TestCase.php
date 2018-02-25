<?php

namespace bupy7\pages\tests\functionals;

use PHPUnit_Framework_TestCase;
use yii\console\controllers\MigrateController;
use yii\di\Container;
use yii\helpers\ArrayHelper;
use Yii;
use yii\web\Application;
use bupy7\pages\tests\functionals\assets\fixtures\PageFixture;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var bool
     */
    private static $migrationApplied = false;

    protected function setUp()
    {
        $this->mockApplication();
        $this->applyMigrations();
        $this->applyFixtures();
    }

    protected function tearDown()
    {
        $this->destroyApplication();
    }

    /**
     * @param array $config
     */
    private function mockApplication($config = [])
    {
        new Application(ArrayHelper::merge(require __DIR__ . '/assets/config/main.php', $config));
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    private function destroyApplication()
    {
        Yii::$app = null;
        Yii::$container = new Container();
    }

    private function applyMigrations()
    {
        if (!self::$migrationApplied) {
            $migrateController = new MigrateController('migrate', Yii::$app);
            $migrateController->interactive = false;
            $migrateController->migrationPath = [
                '@app/migrations',
                '@bupy7/pages/migrations',
            ];
            $migrateController->runAction('up');

            self::$migrationApplied = true;
        }
    }

    private function applyFixtures()
    {
        $postFixture = new PageFixture();

        $postFixture->unload();
        $postFixture->load();
    }
}
