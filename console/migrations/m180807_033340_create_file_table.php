<?php

use yii\db\Migration;

/**
 * Handles the creation of table `file`.
 */
class m180807_033340_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(),
            'title' => $this->string(),
            'amount' => $this->integer()->defaultValue(0),
            'created_at' => $this->dateTime()
        ], $tableOptions);

        $this->addForeignKey('fk_file_group', 'file', 'group_id', 'group', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('file');
    }
}
