<?php

namespace bupy7\pages\migrations;

use Yii;
use yii\db\Schema;
use yii\db\Migration;

/**
 * Create {{%page}} table.
 * 
 * Create new migration to your application: ```./yii migrate/create bupy7_pages_create_page_table```.
 * Extended from this class your new migration class, change tableName to module configurations if need, run migrate.
 * 
 * @example
 * class m140429_155666_bupy7_pages_create_page_table extends \bupy7\pages\migrations\m150429_155009_create_page_table {
 * }
 * 
 * @author Vasilij Belosludcev http://mihaly4.ru
 * @version 1.0.0
 */
class m150429_155009_create_page_table extends Migration
{
    
    private $_tableName;
    
    public function init()
    {
        parent::init();
        $this->_tableName = Yii::$app->getModule('pages')->tableName;
    }
    
    public function up()
    {
        $this->createTable(
            $this->_tableName,
            [
                'id' => Schema::TYPE_PK,
                'title' => Schema::TYPE_STRING . ' NOT NULL',
                'alias' => Schema::TYPE_STRING . ' NOT NULL',
                'published' => Schema::TYPE_BOOLEAN . ' DEFAULT 1',
                'content' => Schema::TYPE_TEXT,
                'title_browser' => Schema::TYPE_STRING,
                'meta_keywords' => Schema::TYPE_STRING . '(200)',
                'meta_description' => Schema::TYPE_STRING . '(160)',
                'created_at' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ]
        );
        $this->createIndex('alias', $this->_tableName, ['alias'], true);
        $this->createIndex('alias_and_published', $this->_tableName, ['alias', 'published']);
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
