<?php

use yii\db\Migration;

/**
 * Handles the creation of table `classifieds`.
 */
class m180331_070648_create_classified_table extends Migration
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

        $this->createTable('{{%classified}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'path' => $this->string(),
            'avatar' => $this->string(),
            'seo_tool_id' => $this->integer(),
            'serial' => $this->integer()->defaultValue(0),
            'category_classified_id' => $this->integer(),
            'slug' => $this->string(),
            'describe' => $this->text(),
            'content' => $this->text(),
            'acreage' => $this->string(),
            'views' => $this->integer()->defaultValue(0),
            'price' => $this->string(),
            'province_id' => $this->integer(),
            'district_id' => $this->integer(),
            'start_date' => $this->dateTime(),
            'expiration_date' => $this->dateTime(),
            'status' => $this->integer()->defaultValue(0),
            'ad_type_id' => $this->integer(),
            'unit_id' => $this->integer(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'mobile' => $this->string(),
            'address' => $this->string(),
            'contacts' => $this->string(),
            'contact_name' => $this->string(),
            'images' => $this->text(),
            'display_homepage' => $this->integer()->defaultValue(0),
            'featured' => $this->integer()->defaultValue(0),
        ], $tableOptions);

        $this->addForeignKey('fk_classified_province', 'classified', 'province_id', 'province', 'id', 'CASCADE');
        $this->addForeignKey('fk_classified_district', 'classified', 'district_id', 'district', 'id', 'CASCADE');
        $this->addForeignKey('fk_classified_category_classified', 'classified', 'category_classified_id', 'category_classified', 'id', 'CASCADE');
        $this->addForeignKey('fk_classified_seo_tool', 'classified', 'seo_tool_id', 'seo_tool', 'id', 'CASCADE');
        $this->addForeignKey('fk_classified_ad_type', 'classified', 'ad_type_id', 'ad_type', 'id', 'CASCADE');
        $this->addForeignKey('fk_classified_unit', 'classified', 'unit_id', 'unit', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('classified');
    }
}
