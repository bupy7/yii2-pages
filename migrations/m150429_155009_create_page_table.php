<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * @author Vasilij Belosludcev http://mihaly4.ru
 * @since 1.0.0
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
                'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT "0000-00-00 00:00:00"',
                'updated_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT "0000-00-00 00:00:00"',
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
