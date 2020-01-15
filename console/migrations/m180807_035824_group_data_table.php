<?php

use yii\db\Migration;

/**
 * Class m180807_035824_group_data_table
 */
class m180807_035824_group_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%group}}', [
            'title',
            'created_at'
        ], [
            ['Gia đình', date('Y-m-d H:i:s', time() + 7 * 3600)], ['Bạn bè', date('Y-m-d H:i:s', time() + 7 * 3600)], ['Khách hàng', date('Y-m-d H:i:s', time() + 7 * 3600)]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180807_035824_group_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180807_035824_group_data_table cannot be reverted.\n";

        return false;
    }
    */
}
