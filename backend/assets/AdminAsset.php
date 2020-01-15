<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/loaders.css',
		'css/site.css',
		'components/font-awesome/css/font-awesome.min.css',
		'components/admin-lte/css/skins/_all-skins.min.css',
		'components/iCheck/all.css',
		'components/bootstrap-switch/css/bootstrap-switch.min.css',
		'components/nestable/css/nestable.css',
		'components/bootstrap3-editable/css/bootstrap-editable.css',
		'components/select2/css/select2.min.css',
		'components/bootstrap-duallistbox/src/bootstrap-duallistbox.css',
		'components/admin-lte/css/AdminLTE.min.css',
		'components/fancybox/source/jquery.fancybox.css',
		'css/load-styles.css',
	];
	public $js = [
		'components/jquery-ui/js/jquery-ui.min.js',
		'components/bootstrap/js/bootstrap.min.js',
		'components/iCheck/icheck.min.js',
		'components/admin-lte/js/admin-lte.min.js',
		'components/bootstrap-switch/js/bootstrap-switch.min.js',
		'components/ckeditor/ckeditor.js',
		'components/ckeditor/samples/js/sample.js',
		'components/nestable/js/jquery.nestable.js',
		'components/bootstrap3-editable/js/bootstrap-editable.min.js',
		'components/select2/js/select2.full.min.js',
		'components/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js',
		'components/fancybox/source/jquery.fancybox.js',
		'js/notify.js',
		'js/setting.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
