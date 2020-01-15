<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 5/31/2018
 * Time: 3:42 PM
 */

use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use common\models\User;
/* @var $this yii\web\View */

$this->title = Yii::t( 'backend', 'Extension' );
$user = null;

if ( ! Yii::$app->user->isGuest ) {
    try {
        $user = findUser( Yii::$app->user->identity->getId() );
    } catch ( NotFoundHttpException $e ) {
    }
}
function findUser( $id ) {
    if ( ( $model = User::findOne( $id ) ) !== null ) {
        return $model;
    } else {
        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}
?>

<style>
    .box-extension {
        padding: 10px;
        margin-bottom: 10px;
        text-align: center;
        position: relative;
        background: #fff;
    }

    .box-extension a {
        color: unset;
    }

    .title-extension {
        font-weight: 600;
    }

    .price-extension {
        background: #3c8dbc;
        color: #fff;
        padding: 0 10px;
        float: right;
        position: absolute;
        right: 0
    }

    .content-extension {
        margin-top: 25px;
    }

    .image-extension {
        margin: 10px;
    }

    .image-extension img {
        width: 128px;
        height: 128px;
    }

    .describe-extension {
        height: 35px;
    }

</style>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-plug"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Extension' ) ?>
            </span>
        </h2>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <?php if ( $user['permission'] == User::ROLE_SENIOR ): ?>
        <div class="col-md-3">
            <div class="box-extension">
                <a href="">
                    <div class="price-extension">
                        <span>Miễn phí</span>
                    </div>
                    <div class="content-extension">
                        <span class="title-extension">Hotline</span>
                        <br>
                        <div class="describe-extension">
                            <span>(Hotlien hiển thị cố định)</span>
                        </div>
                        <div class="image-extension">
                            <img src="/uploads/core/images/phone.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class=" box-extension">
                <a href="">
                    <div class="price-extension">
                        <span>Miễn phí</span>
                    </div>
                    <div class="content-extension">
                        <span class="title-extension">Chống copy nội dung</span>
                        <br>
                        <div class="describe-extension">
                            <span>(Ngăn chặn người dùng copy nội dung, hình ảnh,..)</span>
                        </div>
                        <div class="image-extension">
                            <img src="/uploads/core/images/copy.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-md-3">
            <div class=" box-extension">
                <a href="<?= Url::to( [ 'meta/index' ] ) ?>">
                    <div class="price-extension">
                        <span>Miễn phí</span>
                    </div>
                    <div class="content-extension">
                        <span class="title-extension">Chèn mã javascript</span>
                        <br>
                        <div class="describe-extension">
                            <span>(Chèn mã javascript,mã quảng cáo,webmaster tool, analytics,iframe,..)</span>
                        </div>
                        <div class="image-extension">
                            <img src="/uploads/core/images/script.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php if ( $user['permission'] == User::ROLE_SENIOR ): ?>
        <div class="col-md-3">
            <div class=" box-extension">
                <a href="<?= Url::to( [ 'extension/zip' ] ) ?>">
                    <div class="price-extension">
                        <span>Miễn phí</span>
                    </div>
                    <div class="content-extension">
                        <span class="title-extension">Nén javascript và css</span>
                        <br>
                        <div class="describe-extension">
                            <span>(Nén mã nguồn javascript và css cho website)</span>
                        </div>
                        <div class="image-extension">
                            <img src="/uploads/core/images/zip.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class=" box-extension">
                <div class="price-extension" style="background: #f88e06;">
                    <span>Đang cập nhật</span>
                </div>
                <div class="content-extension">
                    <span class="title-extension">Popup form</span>
                    <br>
                    <div class="describe-extension">
                        <span>(Form điền thông tin dạng popup khi người dùng truy cập website)</span>
                    </div>
                    <div class="image-extension">
                        <img src="/uploads/core/images/tasks.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class=" box-extension">
                <div class="price-extension" style="background: #f88e06;">
                    <span>Đang cập nhật</span>
                </div>
                <div class="content-extension">
                    <span class="title-extension">Click để phóng to ảnh</span>
                    <br>
                    <div class="describe-extension">
                        <span>(Hiển thị ảnh phóng to khi người dùng click vào ảnh)</span>
                    </div>
                    <div class="image-extension">
                        <img src="/uploads/core/images/search.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>
</section>