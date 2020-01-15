<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 */
class m180304_070448_create_order_table extends Migration
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

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'province_id' => $this->integer(),
            'district_id' => $this->integer(),
            'place_delivery' => $this->text(),
            'delivery_time' => $this->dateTime(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'note' => $this->text()
        ], $tableOptions);

        $this->addForeignKey('fk_orders_user', 'order', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_orders_province', 'order', 'province_id', 'province', 'id', 'CASCADE');
        $this->addForeignKey('fk_orders_district', 'order', 'district_id', 'district', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('don_hang');
    }
}
