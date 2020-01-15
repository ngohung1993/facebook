<?php

use yii\db\Migration;

/**
 * Class m171220_072743_photo_location_data
 */
class m171220_072743_photo_location_data extends Migration {
	/**
	 * @inheritdoc
	 */
	public function safeUp() {
		$this->batchInsert( '{{%photo_location}}', [
			'title',
			'key',
			'slug'
		], [
			[ 'Slider trang chủ', 'homepage-slider', 'slider-trang-chu-3' ],
			[ 'Dịch vụ', 'service', 'dich-vu-4' ],
			[ 'Đối tác', 'partner', 'doi-tac-5' ]
		] );
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown() {
		echo "m171220_072743_category_vi_tri_anh_data cannot be reverted.\n";

		return false;
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m171220_072743_category_vi_tri_anh_data cannot be reverted.\n";

		return false;
	}
	*/
}
