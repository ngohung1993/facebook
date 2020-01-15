<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tab`.
 */
class m180524_065935_create_tab_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%tab}}', [
			'id'            => $this->primaryKey(),
			'title'         => $this->string()->notNull(),
			'category_id'   => $this->integer(),
			'setting_id'    => $this->integer(),
			'classified_id' => $this->integer(),
			'product_id'    => $this->integer(),
			'post_id'       => $this->integer(),
			'serial'        => $this->integer()->defaultValue( 0 ),
			'avatar'        => $this->string(),
			'describe'      => $this->text(),
			'content'       => $this->text(),
			'status'        => $this->integer()->defaultValue( 0 ),
			'slug'          => $this->string(),
			'images'        => $this->text(),
			'code'          => $this->text(),
		], $tableOptions );

		$this->addForeignKey( 'fk_tab_category', 'tab', 'category_id', 'category', 'id', 'CASCADE' );
		$this->addForeignKey( 'fk_tab_setting', 'tab', 'setting_id', 'setting', 'id', 'CASCADE' );
		$this->addForeignKey( 'fk_tab_product', 'tab', 'product_id', 'product', 'id', 'CASCADE' );
		$this->addForeignKey( 'fk_tab_classified', 'tab', 'classified_id', 'classified', 'id', 'CASCADE' );
		$this->addForeignKey( 'fk_tab_post', 'tab', 'post_id', 'post', 'id', 'CASCADE' );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'tab' );
	}
}
