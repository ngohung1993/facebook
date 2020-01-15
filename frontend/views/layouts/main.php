<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use frontend\assets\ThemeAsset;
use common\models\User;
use common\models\Group;
use common\helpers\ClientHelper;
use common\helpers\ConnectHelper;

/* @var $this \yii\web\View */
/* @var $content string */

ThemeAsset::register($this);

$user = null;

$group = null;

if (!Yii::$app->user->isGuest) {
    try {
        $user = findModel(Yii::$app->user->identity->getId());

        $group = Group::find()->where(['user_id' => $user['id']])->all();

    } catch (NotFoundHttpException $e) {
    }
}

/**
 * @param $id
 *
 * @return User|null
 * @throws NotFoundHttpException
 */
function findModel($id)
{
    if (($model = User::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <style>
            #back-to-top {
                position: fixed;
                bottom: 40px;
                right: 40px;
                z-index: 9999;
                width: 32px;
                height: 32px;
                text-align: center;
                line-height: 30px;
                cursor: pointer;
                border: 0;
                border-radius: 2px;
                text-decoration: none;
                transition: opacity 0.2s ease-out;
                display: none;
                color: white;
                background: #222f68;
            }

            #back-to-top:hover {
                background: #DDA650;
            }

            .btn:active:focus, .btn:focus {
                outline: 0 auto -webkit-focus-ring-color;
            }
        </style>

    </head>
    <body class="pace-done">
    <?php $this->beginBody() ?>
    <div class='page-topbar '>
        <div class='logo-area'></div>
        <div id="loader" class="opacity loader">
            <div class="lds-facebook">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class='quick-area'>
            <div class='pull-left'>
                <ul class="info-menu left-links list-inline list-unstyled">
                    <li class="sidebar-toggle-wrap">
                        <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class='pull-right'>
                <?php if ($user): ?>
                    <ul class="info-menu right-links list-inline list-unstyled" style="margin-right: 45px;">
                        <li class="profile">
                            <a href="#" data-toggle="dropdown" class="toggle">
                                <img src="<?= $user['avatar'] ? ClientHelper::$config['url_server'] . '/' . $user['avatar'] : '/uploads/core/images/default-avatar.jpg' ?>"
                                     alt="user-image" class="img-circle img-inline">
                                <span>
                                <?= $user['last_name'] ?><i class="fa fa-angle-down"></i>
                            </span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                <li>
                                    <a href="<?= Url::to(['account/profile']) ?>">
                                        <i class="fa fa-user"></i>
                                        Thông tin cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['account/password']) ?>">
                                        <i class="fa fa-lock"></i>
                                        Thiết lập mật khẩu
                                    </a>
                                </li>
                                <li class="last">
                                    <a href="<?= Url::to(['site/logout']) ?>">
                                        <i class="fa fa-sign-out"></i>
                                        Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
                <?php if (!$user): ?>
                    <ul class="info-menu right-links list-inline list-unstyled" style="margin-right: 45px;">
                        <li class="profile">
                            <a href="<?= ConnectHelper::generate_url_login() ?>">
                                <button class="btn btn-success" type="button" style="border-radius: 25px;">
                                    <i class="fa fa-sign-in"></i>
                                    Đăng nhập hoặc tạo tài khoản mới
                                </button>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="page-container row-fluid container-fluid">
        <div class="page-sidebar pagescroll">
            <div class="page-sidebar-wrapper" id="main-menu-wrapper">
                <?php if ($user): ?>
                    <div class="profile-info row">
                        <div class="profile-image col-xs-4">
                            <a href="<?= Url::to(['account/profile']) ?>">
                                <img src="<?= $user['avatar'] ? ClientHelper::$config['url_server'] . '/' . $user['avatar'] : '/uploads/core/images/default-avatar.jpg' ?>"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="profile-details col-xs-8">
                            <h3>
                                <a href="<?= Url::to(['account/profile']) ?>">
                                    <?= $user['last_name'] ?>
                                </a>
                                <span class="profile-status online"></span>
                            </h3>
                            <p class="profile-title">Cộng tác viên</p>
                        </div>
                    </div>
                <?php endif; ?>
                <ul class='wraplist'>
                    <li class='menusection'>Main</li>
                    <li class="">
                        <a href="<?= Url::to(['site/index']) ?>">
                            <i class="fa fa-dashboard"></i>
                            <span class="title">Trang chủ</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);">
                            <i class="fa fa-facebook"></i>
                            <span class="title">Tài khoản facebook</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="" href="<?= Url::to(['facebook/index'], true) ?>">
                                    <span class="title">Danh sách tài khoản</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['facebook/view', 'ct' => 'uid-friend'], true) ?>">
                                    <span class="title">Danh sách bạn bè</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['facebook/view', 'ct' => 'filter-friend'], true) ?>">
                                    <span class="title">Lọc bạn bè</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['facebook/view', 'ct' => 'add-friend'], true) ?>">
                                    <span class="title">Thêm bạn bè</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['facebook/view', 'ct' => 'request-friend'], true) ?>">
                                    <span class="title">Chập nhận kết bạn</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['facebook/view', 'ct' => 'un-friend'], true) ?>">
                                    <span class="title">Xóa bạn hàng loạt</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['facebook/view', 'ct' => 'shield-avatar'], true) ?>">
                                    <span class="title">Bảo vệ avatar Facebook</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void()">
                            <i class="fa fa-search"></i>
                            <span class="title">Tìm kiếm khách hàng</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="" href="<?= Url::to(['search/index', 'act' => 'scan-your-account']) ?>">
                                    <span class="title">Quét theo tài khoản</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['search/index', 'act' => 'scan-emotion-of-post']) ?>">
                                    <span class="title">Quét UID cảm xúc</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['search/index', 'act' => 'scan-comment-of-post']) ?>">
                                    <span class="title">Quét UID bình luận</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['search/index', 'act' => 'scan-member-of-group']) ?>">
                                    <span class="title">Quét UID nhóm</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['search/index', 'act' => 'scan-friend-of-friend']) ?>">
                                    <span class="title">Quét UID bạn bè</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['search/index', 'act' => 'scan-email-of-post']) ?>">
                                    <span class="title">Quét Email bài viết</span></a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['search/index', 'act' => 'scan-phone-of-post']) ?>">
                                    <span class="title">Quét SĐT bài viết</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void()">
                            <i class="fa fa-envelope"></i>
                            <span class="title">Gửi tin nhắn</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="" href="<?= Url::to(['message/index']) ?>">
                                    <span class="title">Gửi tin nhắn</span>
                                </a>
                            </li>
                            <li>
                                <a class="" href="<?= Url::to(['message/group']) ?>">
                                    <span class="title">Nhóm khách hàng</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <section id="main-content" class=" ">
            <section class="wrapper main-wrapper row" style=''>
                <?= $content ?>

                <div class="modal fade col-xs-12 in" id="save-file" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog animated fadeInDown">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Lưu thông tin khách hàng</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger" id="thongbao">Vui lòng chọn 1 nhóm để lưu thông tin
                                    khách hàng.
                                </div>
                                <img id="loading" src="/uploads/core/images/loading.gif" style="display: none;">
                                <div id="step-1" style="display: block;">
                                    <label class="form-label" for="field-1">
                                        Tên File
                                    </label>
                                    <div class="form-group has-feedback">
                                        <input title="" type="text" id="file-title" class="form-control"
                                               placeholder="Vui lòng nhập tên cần lưu">
                                        <span class="glyphicon glyphicon-link form-control-feedback"></span>
                                    </div>
                                    <label class="form-label" for="field-1">Nhóm khách hàng</label>
                                    <div class="form-group has-feedback">
                                        <select class="form-control" title="" id="group-id">
                                            <?php foreach ($group as $key => $value): ?>
                                                <option value="<?= $value['id'] ?>">
                                                    <?= $value['title'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group step-2" style="display: none;">
                                        <div class="input-group" style="display: flex;">
                                            <input type="text" class="form-control" placeholder="Nhập tên nhóm"
                                                   id="group-title" style="margin-right: 5px;">
                                            <button type="button" class="btn btn-success pull-right"
                                                    onclick="create_group();">
                                                <span class="fa fa-check"></span>
                                                Tạo nhóm
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group step-1">
                                        <button class="btn btn-danger" type="button" id="open-create-group">
                                            <span class="fa fa-plus"></span>
                                            Tạo nhóm mới
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                                <button class="btn btn-success" type="button" onclick="save_file()">
                                    <span class="fa fa-check"></span>
                                    Lưu tệp
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
    <a href="#" id="back-to-top" title="Back to top">
        <i class="fa fa-arrow-up"></i>
    </a>
    <script>
        let base = "<?= Yii::$app->getHomeUrl() ?>";
        let server = "<?= ClientHelper::$config['url_server'] ?>";
        console.log(base);
        console.log(server);
    </script>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>