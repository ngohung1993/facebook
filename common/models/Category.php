<?php

namespace common\models;

use Yii;
use common\models\base;

class Category extends base\Category {
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
