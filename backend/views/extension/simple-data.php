<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 5/31/2018
 * Time: 3:42 PM
 */
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t( 'backend', 'Simple data' );

?>

<style>
    .ext-icon {
        color: rgba(0, 0, 0, 0.5);
        margin-left: 10px;
    }

    .installed {
        color: #00a65a;
        margin-right: 10px;
    }
</style>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-database"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Simple data' ) ?>
            </span>
        </h2>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Environment</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td width="120px">PHP version</td>
                                <td>PHP/7.1.7</td>
                            </tr>
                            <tr>
                                <td width="120px">Laravel version</td>
                                <td>5.5.13</td>
                            </tr>
                            <tr>
                                <td width="120px">CGI</td>
                                <td>fpm-fcgi</td>
                            </tr>
                            <tr>
                                <td width="120px">Uname</td>
                                <td>Linux VM_162_121_centos 3.10.0-327.36.3.el7.x86_64 #1 SMP Mon Oct 24 16:09:20
                                    UTC 2016 x86_64
                                </td>
                            </tr>
                            <tr>
                                <td width="120px">Server</td>
                                <td>nginx/1.8.1</td>
                            </tr>
                            <tr>
                                <td width="120px">Cache driver</td>
                                <td>file</td>
                            </tr>
                            <tr>
                                <td width="120px">Session driver</td>
                                <td>file</td>
                            </tr>
                            <tr>
                                <td width="120px">Queue driver</td>
                                <td>sync</td>
                            </tr>
                            <tr>
                                <td width="120px">Timezone</td>
                                <td>Asia/Shanghai</td>
                            </tr>
                            <tr>
                                <td width="120px">Locale</td>
                                <td>en</td>
                            </tr>
                            <tr>
                                <td width="120px">Env</td>
                                <td>local</td>
                            </tr>
                            <tr>
                                <td width="120px">URL</td>
                                <td>http://laravel-admin.org/</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Dữ liệu mẫu</h3>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">

                        <li class="item">
                            <div class="product-img">
                                <i class="fa fa-book fa-2x ext-icon"></i>
                            </div>
                            <div class="product-info">
                                <a href=""
                                   class="product-title">
                                    <?= Yii::t( 'backend', 'Categories' ) ?>
                                </a>
                                <div class="btn-group pull-right" style="margin-right: 10px">
                                    <a href="<?= Url::to(['/general-information/import-example-category']) ?>" class="btn btn-primary" data-confirm="Are you sure you want to create example category?">
                                        <i class="fa fa-plus"></i> <?= Yii::t( 'backend', ' Tạo' ) ?>
                                    </a>
                                    <a href="<?= Url::to(['/general-information/delete-example-category'])?>" class="btn btn-danger" data-confirm="Are you sure you want to delete example category?">
                                        <i class="fa fa-close"></i> <?= Yii::t( 'backend', ' Xóa' ) ?>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="item">
                            <div class="product-img">
                                <i class="fa fa-newspaper-o fa-2x ext-icon"></i>
                            </div>
                            <div class="product-info">
                                <a href=""
                                   class="product-title">
                                    <?= Yii::t( 'backend', 'Posts' ) ?>
                                </a>
                                <div class="btn-group pull-right" style="margin-right: 10px">
                                    <a href="<?= Url::to(['/general-information/import-example-post']) ?>" class="btn btn-primary" data-confirm="Are you sure you want to create example post?">
                                        <i class="fa fa-plus"></i> <?= Yii::t( 'backend', ' Tạo' ) ?>
                                    </a>
                                    <a href="<?= Url::to(['/general-information/delete-example-post'])?>" class="btn btn-danger" data-confirm="Are you sure you want to delete example post?">
                                        <i class="fa fa-close"></i> <?= Yii::t( 'backend', ' Xóa' ) ?>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="box-footer text-center">

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Dependencies</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td width="240px">php</td>
                                <td><span class="label label-primary">&gt;=7.0.0</span></td>
                            </tr>
                            <tr>
                                <td width="240px">encore/laravel-admin</td>
                                <td><span class="label label-primary">1.5.x-dev</span></td>
                            </tr>
                            <tr>
                                <td width="240px">fideloper/proxy</td>
                                <td><span class="label label-primary">~3.3</span></td>
                            </tr>
                            <tr>
                                <td width="240px">intervention/image</td>
                                <td><span class="label label-primary">^2.4</span></td>
                            </tr>
                            <tr>
                                <td width="240px">laravel-admin-ext/api-tester</td>
                                <td><span class="label label-primary">*</span></td>
                            </tr>
                            <tr>
                                <td width="240px">laravel-admin-ext/config</td>
                                <td><span class="label label-primary">*</span></td>
                            </tr>
                            <tr>
                                <td width="240px">laravel-admin-ext/helpers</td>
                                <td><span class="label label-primary">*</span></td>
                            </tr>
                            <tr>
                                <td width="240px">laravel-admin-ext/log-viewer</td>
                                <td><span class="label label-primary">*</span></td>
                            </tr>
                            <tr>
                                <td width="240px">laravel-admin-ext/media-manager</td>
                                <td><span class="label label-primary">*</span></td>
                            </tr>
                            <tr>
                                <td width="240px">laravel-admin-ext/redis-manager</td>
                                <td><span class="label label-primary">^1.0</span></td>
                            </tr>
                            <tr>
                                <td width="240px">laravel-admin-ext/reporter</td>
                                <td><span class="label label-primary">^1.0</span></td>
                            </tr>
                            <tr>
                                <td width="240px">laravel-admin-ext/scheduling</td>
                                <td><span class="label label-primary">*</span></td>
                            </tr>
                            <tr>
                                <td width="240px">laravel/framework</td>
                                <td><span class="label label-primary">^5.5</span></td>
                            </tr>
                            <tr>
                                <td width="240px">laravel/tinker</td>
                                <td><span class="label label-primary">~1.0</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>