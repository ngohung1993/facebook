<?php

use yii\db\Migration;

/**
 * Handles the creation of table `setting`.
 */
class m171219_182709_create_setting_table extends Migration
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

        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'avatar' => $this->string(),
            'link' => $this->string(),
            'code' => $this->text(),
            'key' => $this->string()->notNull()->unique(),
            'describe' => $this->text(),
            'content' => $this->text(),
            'released' => $this->integer()->defaultValue(0),
            'status' => $this->integer()->defaultValue(0),
            'slug' => $this->string(),
            'images' => $this->text()
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('cau_hinh');
    }
}
