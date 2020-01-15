<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact`.
 */
class m171223_104541_create_contact_table extends Migration
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
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'describe' => $this->text(),
            'full_name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'email' => $this->string(),
            'skype' => $this->string(),
            'yahoo' => $this->string(),
            'company' => $this->string(),
            'address' => $this->string(),
            'content' => $this->text(),
            'status' => $this->text(),
            'created_at' => $this->dateTime()
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('lien_he');
    }
}
