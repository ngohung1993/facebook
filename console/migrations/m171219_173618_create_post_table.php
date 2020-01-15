<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m171219_173618_create_post_table extends Migration {
	/**
	 * @inheritdoc
	 */
	public function safeUp() {
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%post}}', [
			'id'               => $this->primaryKey(),
			'title'            => $this->string()->notNull(),
			'category_id'      => $this->integer()->notNull(),
			'serial'           => $this->integer()->defaultValue( 0 ),
			'avatar'           => $this->string(),
			'describe'         => $this->text(),
			'content'          => $this->text(),
			'display_homepage' => $this->integer()->defaultValue( 0 ),
			'status'           => $this->integer()->defaultValue( 0 ),
			'featured'         => $this->integer()->defaultValue( 0 ),
			'seo_tool_id'      => $this->integer(),
			'slug'             => $this->string(),
			'created_at'       => $this->dateTime(),
			'views'            => $this->integer()->defaultValue( 0 ),
			'images'           => $this->text(),
			'code'             => $this->text(),
			'user_id'          => $this->integer(),
            'example'=>$this->integer()->defaultValue(0)

        ], $tableOptions );

		$this->addForeignKey( 'fk_post_user', 'post', 'user_id', 'user', 'id', 'CASCADE' );
		$this->addForeignKey( 'fk_post_category', 'post', 'category_id', 'category', 'id', 'CASCADE' );
		$this->addForeignKey( 'fk_post_seo_tool', 'post', 'seo_tool_id', 'seo_tool', 'id', 'CASCADE' );
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown() {
		$this->dropTable( 'noi_dung' );
	}
}
