<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 5/31/2018
 * Time: 3:42 PM
 */

/* @var $this yii\web\View */

$this->title = Yii::t( 'backend', 'Library' );

?>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-folder-open"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Library' ) ?>
            </span>
        </h2>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <iframe width="100%" height="450" frameborder="0"
                    src="/uploads/filemanager/dialog.php">
            </iframe>
        </div>
    </div>
</section>