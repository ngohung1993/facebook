<?php

use yii\db\Migration;

/**
 * Handles the creation of table `album`.
 */
class m180205_094243_create_album_table extends Migration
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

        $this->createTable('{{%album}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'describe' => $this->text(),
            'post_id' => $this->integer(),
            'category_id' => $this->integer(),
            'product_id' => $this->integer()
        ], $tableOptions);

        $this->addForeignKey('fk_album_post', 'album', 'post_id', 'post', 'id', 'CASCADE');
        $this->addForeignKey('fk_album_category', 'album', 'category_id', 'category', 'id', 'CASCADE');
        $this->addForeignKey('fk_album_product', 'album', 'product_id', 'product', 'id', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('bo_suu_tap');
    }
}
