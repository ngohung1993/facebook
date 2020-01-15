<?php

use yii\db\Migration;

/**
 * Handles the creation of table `supporter`.
 */
class m171223_105254_create_supporter_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%supporter}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull(),
            'describe' => $this->text(),
            'avatar' => $this->string(),
            'serial' => $this->integer()->defaultValue(0),
            'email' => $this->string(),
            'phone' => $this->string(),
            'yahoo' => $this->string(),
            'skype' => $this->string(),
            'status' => $this->integer()->defaultValue(0),
            'slug' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('ho_tro_vien');
    }
}
