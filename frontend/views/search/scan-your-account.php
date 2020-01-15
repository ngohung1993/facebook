<?php

/* @var $user common\models\User */
/* @var $facebook_accounts array */

$this->registerJsFile(
    '@web/js/search/scan-your-account.js'
);

$this->title = 'Quét theo tài khoản';

?>

<style>
    h2 {
        font-size: 20px;
    }

    .text-muted {
        color: #99abb4 !important;
    }

    h5 {
        line-height: 18px;
        font-size: 16px;
        font-weight: 400;
    }

    .r4_counter h4 {
        margin: 0;
    }

    .text-muted {
        margin-bottom: 4px;
    }

    .card {
        margin-bottom: 30px;
    }

    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-clip: border-box;
        border-radius: .25rem;
    }

    .tab-content {
        min-height: 293px;
    }

</style>

<style>
    .nav-tabs li a {
        text-align: left !important;
    }

    .social-feed-box {
        border: 1px solid #e7eaec;
        background: #fff;
        margin-bottom: 15px;
        padding: 15px;
    }

    .social-feed-separated .social-avatar img {
        width: 90px;
        height: 90px;
        border: 1px solid #e7eaec;
    }

    .social-body {
        padding: 15px 0;
    }

    .btn-rounded {
        border-radius: 50px;
    }

    .tab-pane button {
        border-radius: 25px;
    }

    .reactions i {
        margin: 0 10px;
    }

    .content img {
        max-width: 100%;
    }

    .btn:active:focus, .btn:focus {
        outline: 0 auto -webkit-focus-ring-color;
    }

</style>

<div class="col-xs-12" style="background: #fff;padding-top: 15px;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h2 class="panel-title">
                Quét theo tài khoản
            </h2>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <span>
                        <i class="fa fa-facebook"></i>
                        Chọn tài khoản facebook
                    </span>
                    </div>
                    <select title="" id="access-token" class="form-control">
                        <?php foreach ($facebook_accounts as $key => $value): ?>
                            <option data-facebook="<?= $value['id'] ?>" value="<?= $value['access_token'] ?>">
                                <?= $value['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div style="margin: 15px 0;"></div>
            <div class="row">
                <div class="col-xs-12 search_data">
                    <div class="card">
                        <ul class="nav nav-tabs nav-justified profile-tab" role="tablist">
                            <li class="">
                                <a href="#web-1" data-toggle="tab" aria-expanded="false" onclick="scan_your_post()">
                                    <i class="fa fa-newspaper-o"></i>
                                    Bảng tin
                                </a>
                            </li>
                            <li class="">
                                <a href="#images-1" data-toggle="tab" aria-expanded="false"
                                   onclick="scan_your_friend()">
                                    <i class="fa fa-user"></i>
                                    Bạn bè
                                </a>
                            </li>
                            <li class="">
                                <a href="#contacts-1" data-toggle="tab" aria-expanded="true"
                                   onclick="scan_your_group()">
                                    <i class="fa fa-group"></i>
                                    Nhóm
                                </a>
                            </li>
                            <li class="">
                                <a href="#projects-1" data-toggle="tab">
                                    <i class="fa fa-flag-o"></i>
                                    Trang
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade ps-container ps-active-y" id="web-1">
                                <div id="uid-post">
                                    <div class="form-group">
                                        <div class="loading-search" style="text-align: center;display: none;">
                                            <img style="width: 50px;" src="/uploads/core/images/loading-search.gif"
                                                 alt="">
                                        </div>
                                    </div>
                                    <div id="social-feed-temp" style="display: none">
                                        <div class="social-feed-separated">
                                            <div class="social-feed-box" style="margin-left:0">
                                                <div class="info">
                                                    <div class="social-avatar" style="float: left; padding-right:0">
                                                        <a target="_blanks" href="">
                                                            <img class="avatar" alt="image" style="margin-right: 10px;"
                                                                 src="">
                                                        </a>
                                                    </div>
                                                    <div class="right-info">
                                                        <a target="_blanks" href="">
                                                            <strong class="name"></strong>
                                                        </a>
                                                        <span class="label label-info everyone"
                                                              style="border-radius: 25px;float: right;display: none">
                                                        <i class="fa fa-globe"></i>
                                                        Công khai
                                                    </span>
                                                        <span class="label label-danger self"
                                                              style="border-radius: 25px;float: right;display: none">
                                                        <i class="fa fa-lock"></i>
                                                        Chỉ mình thôi
                                                    </span>
                                                        <span class="label label-warning all-friends"
                                                              style="border-radius: 25px;float: right;display: none">
                                                        <i class="fa fa-user"></i>
                                                        Tất cả bạn bè
                                                    </span>
                                                        <div>
                                                            <small class="text-muted">
                                                                Ngày tạo: <span class="created-time"></span>
                                                            </small>
                                                        </div>
                                                        <div>
                                                            <small class="text-muted">
                                                                Ngày sửa: <span class="updated-time"></span>
                                                            </small>
                                                            <div class="reactions">
                                                                <i class="fa fa-thumbs-up"></i><span
                                                                        class="like"></span>
                                                                <i class="fa fa-comments"></i><span
                                                                        class="comment"></span>
                                                                <i class="fa fa-share"></i><span class="share"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="social-body">
                                                    <div class="content"></div>
                                                    <p></p>
                                                    <div class="row" style="text-align: center;">
                                                        <div class="col-md-3"></div>
                                                        <div class="col-xs-6 col-md-3" style="margin-top: 5px">
                                                            <a target="_blank" href="" class="scan-emotion">
                                                                <button class="btn btn-success btn-rounded btn-sm">
                                                                    <i class="fa fa-thumbs-up"></i>
                                                                    Quét cảm xúc
                                                                </button>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-6 col-md-3" style="margin-top: 5px">
                                                            <a target="_blank" href="" class="scan-comment">
                                                                <button class="btn btn-primary btn-rounded btn-sm">
                                                                    <i class="fa fa-comments"></i>
                                                                    Quét bình luận
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="your-post"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade ps-container" id="images-1" style="">
                                <div class="form-group">
                                    <div class="loading-search" style="text-align: center;display: none;">
                                        <img style="width: 50px;" src="/uploads/core/images/loading-search.gif" alt="">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="overflow-x: hidden;"
                                           id="table-your-friend">
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade ps-container in" id="contacts-1" style="">
                                <div class="form-group">
                                    <div class="loading-search" style="text-align: center;display: none;">
                                        <img style="width: 50px;" src="/uploads/core/images/loading-search.gif" alt="">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="overflow-x: hidden;"
                                           id="table-your-group">
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade ps-container" id="projects-1">
                            </div>
                            <div class="tab-pane fade ps-container" id="map-1">
                            </div>
                            <div class="tab-pane fade ps-container" id="videos-1">
                            </div>
                            <div class="tab-pane fade ps-container" id="messages-1">
                            </div>
                            <div class="tab-pane fade ps-container" id="profile-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>