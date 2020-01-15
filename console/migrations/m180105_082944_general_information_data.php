<?php

use yii\db\Migration;

/**
 * Class m180105_082944_general_information_data
 */
class m180105_082944_general_information_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->batchInsert('{{%general_information}}', [
            'id'
        ], [
            ['1']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180105_082944_category_thong_tin_chung_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180105_082944_category_thong_tin_chung_data cannot be reverted.\n";

        return false;
    }
    */
}
