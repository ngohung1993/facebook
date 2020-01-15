<?php

use yii\helpers\Url;
use common\models\Category;

$this->title = 'Admin RT';

$categories = Category::find()->joinWith( 'page' )->orderBy( 'category.serial ASC' )->all();

?>

<style>

    .progress-description a {
        color: #fff;
    }

    .inner h3 {
        color: #fff;
    }

    .small-box .icon {
        top: 10px;
    }

</style>

<section class="content-header">
    <h1>
        Tổng quan
        <small>Preview page</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?= Url::to( [ 'site/index' ] ) ?>">
                <i class="fa fa-home"></i> Trang chủ
            </a>
        </li>
        <li class="active">Tổng quan</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Xem thêm <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="fa fa-tags"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Xem thêm <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>44</h3>
                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="fa fa-edit"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Xem thêm <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>65</h3>
                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="fa fa-picture-o"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Xem thêm <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>