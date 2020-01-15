<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ad_type`.
 */
class m180313_093523_create_ad_type_table extends Migration
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
        $this->createTable('ad_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'rank' => $this->integer()->defaultValue(0),
            'price' => $this->double()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ad_type');
    }
}
