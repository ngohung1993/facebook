<?php

use yii\db\Migration;

/**
 * Handles the creation of table `province`.
 */
class m180106_081926_create_province_table extends Migration
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

        $this->createTable('{{%province}}', [
            'id' => $this->primaryKey(),
            'ten' => $this->string()->notNull(),
            'ten_tieng_anh' => $this->string(),
            'cap' => $this->string(),
            'phi_van_chuyen' => $this->double()
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('provinces');
    }
}
