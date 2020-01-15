<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class PostAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'components/summernote/summernote.css',
		'components/summernote/summernote-bs3.css'
	];
	public $js = [
		'components/fancybox/source/jquery.fancybox.js',
		'components/summernote/summernote.min.js',
		'js/post.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
