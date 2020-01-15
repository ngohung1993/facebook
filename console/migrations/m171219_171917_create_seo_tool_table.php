<?php

use yii\db\Migration;

/**
 * Handles the creation of table `seo_tool`.
 */
class m171219_171917_create_seo_tool_table extends Migration
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
        $this->createTable('{{%seo_tool}}', [
            'id' => $this->primaryKey(),
            'seo_title' => $this->string(),
            'meta_keywords' => $this->string(),
            'meta_description' => $this->text()
        ],$tableOptions);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('seo_tool');
    }
}
