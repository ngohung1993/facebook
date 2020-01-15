<?php

use yii\db\Migration;

/**
 * Handles the creation of table `meta`.
 */
class m180612_082840_create_meta_table extends Migration
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
        $this->createTable('meta', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'content'=>$this->text()->notNull(),
            'status' =>$this->integer()->defaultValue(0),
            'meta_location_id'=>$this->integer()
        ],$tableOptions);
        $this->addForeignKey('fk_meta_meta_location','meta','meta_location_id','meta_location','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('meta');
    }
}
