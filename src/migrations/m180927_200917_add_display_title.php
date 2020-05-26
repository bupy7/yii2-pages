<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * @author Vasily Belosloodcev <vasily.belosloodcev@gmail.com>
 * @since 1.4.0
 */
class m180927_200917_add_display_title extends Migration
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

    public function safeUp()
    {
        $this->addColumn($this->_tableName, 'display_title', Schema::TYPE_BOOLEAN . ($this->db->driverName === 'pgsql' ? ' DEFAULT TRUE' : ' DEFAULT 1'));
    }

    public function safeDown()
    {
        $this->dropColumn($this->_tableName, 'display_title');
    }
}
