<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 6/16/2018
 * Time: 11:36 AM
 */

/* @var $finish array */

?>

<style>
    .installed {
        color: #00a65a;
        margin-right: 10px;
    }
</style>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-random"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Zip' ) ?>
            </span>
        </h2>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Available files</h3>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
						<?php foreach ( $finish as $key => $value ): ?>
                            <li class="item">
                                <div class="product-img">
                                    <i class="fa fa-copy fa-2x ext-icon"></i>
                                </div>
                                <div class="product-info">
                                    <a target="_blank" href="<?= $value ?>" class="product-title">
										<?= $value ?>
                                    </a>
                                    <span class="pull-right installed">
                                    <i class="fa fa-check"></i>
                                </span>
                                </div>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
