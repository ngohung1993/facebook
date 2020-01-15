<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member`.
 */
class m180807_081626_create_member_table extends Migration
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

        $this->createTable('{{%member}}', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer(),
            'uid' => $this->string(),
            'name' => $this->string()
        ], $tableOptions);

        $this->addForeignKey('fk_member_file', 'member', 'file_id', 'file', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('member');
    }
}
