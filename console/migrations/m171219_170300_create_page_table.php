<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 */
class m171219_170300_create_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'describe' => $this->string(),
            'key' => $this->string()->notNull()->unique(),
            'code' => $this->text(),
            'slug' => $this->string(),
            'released' => $this->integer()->defaultValue(0),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('chuc_nang');
    }
}
