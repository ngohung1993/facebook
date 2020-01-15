<?php

use yii\db\Migration;

/**
 * Class m180612_134806__meta_location_data
 */
class m180612_134806__meta_location_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%meta_location}}', [
            'title',
            'status',
        ], [
            ['Sau thẻ mở head (<head>)', 1],
            ['Trước thẻ đóng head (</head>)', 1],
            ['Sau thẻ mở body (<body>)', 1],
            ['Trước thẻ đóng body (</body>)', 1],
        ]);
    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180612_134806__meta_location_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180612_134806__meta_location_data cannot be reverted.\n";

        return false;
    }
    */
}
