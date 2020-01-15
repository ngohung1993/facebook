<?php

use yii\db\Migration;

/**
 * Class m171219_170428_page_data
 */
class m171219_170428_page_data extends Migration {
	/**
	 * @inheritdoc
	 */
	public function safeUp() {
		$this->batchInsert( '{{%page}}', [
			'title',
			'released',
			'key',
			'slug'
		], [
			[ 'Trang đơn', 1, 'single-page', 'trang-don-1' ],
			[ 'Trang rỗng', 1, 'empty-page', 'trang-rong-2' ],
			[ 'Trang liên hệ', 1, 'contact-page', 'trang-lien-he-3' ],
			[ 'Trang bản tin', 1, 'news-page', 'trang-ban-tin-4' ],
			[ 'Trang sản phẩm', 1, 'product-page', 'trang-san-pham-5' ],
			[ 'Trang dự án', 1, 'project-page', 'trang-du-an-6' ],
			[ 'Trang tin rao', 1, 'classified-page', 'trang-tin-rao-7' ],
		] );
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown() {
		echo "m171219_170428_category_chuc_nang_data cannot be reverted.\n";

		return false;
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m171219_170428_category_chuc_nang_data cannot be reverted.\n";

		return false;
	}
	*/
}
