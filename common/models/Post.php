<?php

namespace common\models;

use Yii;
use common\models\base;

class Post extends base\Post {
	public $category_child;
    public $tab_post;
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return array_merge( parent::rules(),[
			[ 'category_child', 'string' ],
            [ 'tab_post', 'string' ]
		] );
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return array_merge( parent::attributeLabels(), [
			'status'           => Yii::t( 'backend', 'Status' ),
			'featured'         => Yii::t( 'backend', 'Featured' ),
			'display_homepage' => Yii::t( 'backend', 'Display Homepage' ),
		] );
	}
}
