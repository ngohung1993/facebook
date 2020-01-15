<?php

namespace common\models;

use common\models\base;

class Page extends base\Page {
	const AD_PAGE = 'classifieds-page';

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			'id'       => 'ID',
			'title'    => 'Tiêu đề',
			'describe' => 'Mô tả',
			'key'      => 'Khóa',
			'code'     => 'Code',
			'slug'     => 'Slug',
			'released' => 'Phát hành',
		];
	}
}
