<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m171219_171918_create_category_table extends Migration
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

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'avatar' => $this->string(),
            'describe' => $this->text(),
            'serial' => $this->integer()->defaultValue(0),
            'parent_id' => $this->integer(),
            'content' => $this->text(),
            'page_id' => $this->integer()->notNull(),
            'display_homepage' => $this->integer()->defaultValue(0),
            'featured' => $this->integer()->defaultValue(0),
            'status' => $this->integer()->defaultValue(0),
            'seo_tool_id' => $this->integer(),
            'slug' => $this->string(),
            'key' => $this->string(),
            'code' => $this->text(),
            'link' => $this->string(),
            'images' => $this->text(),
            'example'=>$this->integer()->defaultValue(0)
        ], $tableOptions);

        $this->addForeignKey('fk_category_parent', 'category', 'parent_id', 'category', 'id', 'CASCADE');
        $this->addForeignKey('fk_category_page', 'category', 'page_id', 'page', 'id', 'CASCADE');
        $this->addForeignKey('fk_category_seo_tool', 'category', 'seo_tool_id', 'seo_tool', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('danh_muc');
    }
}
