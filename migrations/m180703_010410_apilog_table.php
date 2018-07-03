<?php

use yii\db\Migration;

/**
 * Class m180703_010410_apilog_table
 */
class m180703_010410_apilog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

            $this->createTable('{{%api_log}}', [
                'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
                'ipclient' => $this->string(32),
                'app_name' => $this->string(50),
                'ws_type' => $this->string(50),
                'request' => $this->text(),
                'response' => $this->text(),
                'createdon' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
                'createdby' => $this->integer(11),
            ], $tableOptions);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%api_log}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180703_010410_apilog_table cannot be reverted.\n";

        return false;
    }
    */
}
