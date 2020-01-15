<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Vietlv <levanviet_t58@hus.eud.vn>
 * @since 1.0
 */
class SiteAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'hosting/css/bootstrap.min.css',
		'hosting/css/iconsmind.css',
		'hosting/css/main.css',
		'hosting/css/socicon.css'
	];
	public $js = [

	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
