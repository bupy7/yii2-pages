<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\helpers\Inflector;

/**
 * @author Vasilij Belosludcev http://mihaly4.ru
 * @since 1.0.0
 */
class m150429_155009_create_page_table extends Migration
{
    /**
     * @var string
     */
    private $_tableName;
    
    public function init()
    {
        parent::init();
        $this->_tableName = Yii::$app->getModule('pages')->tableName;
    }
    
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            $this->_tableName,
            [
                'id' => Schema::TYPE_PK,
                'title' => Schema::TYPE_STRING . ' NOT NULL',
                'alias' => Schema::TYPE_STRING . ' NOT NULL',
                'published' => Schema::TYPE_BOOLEAN . ($this->db->driverName === 'pgsql' ? ' DEFAULT TRUE' : ' DEFAULT 1'),
                'content' => Schema::TYPE_TEXT,
                'title_browser' => Schema::TYPE_STRING,
                'meta_keywords' => Schema::TYPE_STRING . '(200)',
                'meta_description' => Schema::TYPE_STRING . '(160)',
                'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
                'updated_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            ],
            $tableOptions
        );

        $baseIndex = strtolower(Inflector::classify($this->_tableName)) . '_idx_';

        $this->createIndex($baseIndex . '1', $this->_tableName, ['alias'], true);
        $this->createIndex($baseIndex . '2', $this->_tableName, ['alias', 'published']);
    }

    public function down()
    {
        $this->dropTable($this->_tableName);
    }
}
