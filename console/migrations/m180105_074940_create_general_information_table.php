<?php

use yii\db\Migration;

/**
 * Handles the creation of table `general_information`.
 */
class m180105_074940_create_general_information_table extends Migration {
	/**
	 * @inheritdoc
	 */
	public function safeUp() {
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable( '{{%general_information}}', [
			'id'                    => $this->primaryKey(),
			'site_name'             => $this->string(),
			'logo'                  => $this->string(),
			'favicon'               => $this->string(),
			'home_page_header'      => $this->string(),
			'home_page_description' => $this->text(),
			'email_notify'          => $this->string(),
			'address'               => $this->text(),
			'phone'                 => $this->string(),
			'page_facebook'         => $this->text(),
			'video_intro'           => $this->text(),
			'google_analytics'      => $this->text(),
			'facebook_pixel'        => $this->text(),
			'status'                => $this->integer()->defaultValue( 1 )
		], $tableOptions );
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown() {
		$this->dropTable( 'thong_tin_chung' );
	}
}
