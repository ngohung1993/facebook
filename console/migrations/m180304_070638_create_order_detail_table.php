<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_detail`.
 */
class m180304_070638_create_order_detail_table extends Migration
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
        $this->createTable('{{%order_detail}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'amount' => $this->integer()
        ], $tableOptions);

        $this->addForeignKey('fk_order_detail_orders', 'order_detail', 'order_id', 'order', 'id', 'CASCADE');
        $this->addForeignKey('fk_order_detail_product', 'order_detail', 'product_id', 'product', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('chi_tiet_don_hang');
    }
}
