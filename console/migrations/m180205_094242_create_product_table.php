<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m180205_094242_create_product_table extends Migration
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
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'avatar' => $this->string(),
            'price' => $this->double(),
            'amount' => $this->integer(),
            'discount' => $this->integer(),
            'serial' => $this->integer()->defaultValue(0),
            'describe' => $this->text(),
            'content' => $this->text(),
	        'link' => $this->string(),
            'status' => $this->integer()->defaultValue(0),
            'released' => $this->integer()->defaultValue(0),
            'category_id' => $this->integer()->notNull(),
            'display_homepage' => $this->integer()->defaultValue(0),
            'featured' => $this->integer()->defaultValue(0),
            'seo_tool_id' => $this->integer(),
            'slug' => $this->string(),
            'created_at' => $this->integer()->defaultValue(0),
            'views' => $this->integer()->defaultValue(0),
            'user_id' => $this->integer()->notNull(),
            'images' => $this->text(),
        ], $tableOptions);

        $this->addForeignKey('fk_product_category', 'product', 'category_id', 'category', 'id', 'CASCADE');
        $this->addForeignKey('fk_product_seo_tool', 'product', 'seo_tool_id', 'seo_tool', 'id', 'CASCADE');
        $this->addForeignKey('fk_product_user', 'product', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('san_pham');
    }
}
