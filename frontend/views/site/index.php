<?php

use yii\helpers\Url;
use common\helpers\ClientHelper;

/* @var $this yii\web\View */
/* @var $user \common\models\User */

$this->title = 'Bảng điều khiển';

?>

<style>
    h2 {
        line-height: 36px;
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

    .panel_s .panel-body {
        background: #fff;
        border: 1px solid #dce1ef;
        border-radius: 4px;
        padding: 20px;
        position: relative;
    }

    .padding-10 {
        padding: 10px !important;
    }

    .activity-feed {
        padding: 15px;
        word-wrap: break-word;
    }

    .activity-feed .feed-item {
        position: relative;
        padding-bottom: 15px;
        padding-left: 30px;
        border-left: 2px solid #84c529;
    }

    .activity-feed .feed-item .date {
        position: relative;
        top: -5px;
        color: #4b5158;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 500;
    }

    .activity-feed .feed-item .text {
        position: relative;
        top: -3px;
    }

    .mtop5 {
        margin-top: 5px;
    }

    .text-muted {
        color: #777;
    }

    .activity-feed .feed-item:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: -6px;
        width: 10px;
        height: 10px;
        border-radius: 6px;
        background: #fff;
        border: 1px solid #4b5158;
    }

    .bold {
        font-weight: 500;
    }

    .no-mbot {
        margin-bottom: 0 !important;
    }

    a {
        color: #008ece;
        text-decoration: none !important;
    }

    .feed-item .text-has-action {
        margin-bottom: 7px;
        display: inline-block;
    }

    .text-has-action {
        border-bottom: 1px dashed #bbb;
        padding-bottom: 2px;
    }

    .activity-feed .feed-item .text {
        font-size: 13px;
    }

    .img-circle {
        height: 80px;
        width: 80px;
    }

    .tab-content {
        min-height: 293px;
    }

</style>

<style>
    span.available-balances {
        display: inline-block;
        border-color: #4285f4;
        background-color: #4285f4;
        color: white;
        line-height: 24px;
        padding: 2px 5px;
        text-align: center;
        width: 100%;
        border-radius: 5px;
    }

    .tp-coin {
        background: url('/uploads/core/images/transaction.png') no-repeat;
        background-size: auto 100%;
        padding-left: 25px;
        margin-left: 5px;
    }
</style>

<div class="row">
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <ul class="nav nav-tabs nav-justified profile-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#home" role="tab"
                       aria-expanded="false">Thông báo</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" data-toggle="tab" href="#note" role="tab"
                       aria-expanded="true">Lưu ý</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab"
                       aria-expanded="false">Thống kê</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#settings" role="tab"
                       aria-expanded="false">Tin tức</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="home" role="tabpanel" aria-expanded="false">
                    <div class="card-body">
                        <div class="message-box">
                            <div class="message-widget">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile" role="tabpanel" style="" aria-expanded="false">
                    <div class="card-body">
                    </div>
                </div>
                <div class="tab-pane" id="settings" role="tabpanel" aria-expanded="false">
                    <div class="card-body">
                    </div>
                </div>
                <div class="tab-pane active" id="note" role="tabpanel" aria-expanded="true">
                    <div class="card-body">
                        <div class="alert alert-info">
                            Để sử dụng sản phẩm một cách tốt nhất vui lòng đọc kỹ một số lưu ý sau :
                        </div>
                        <ul class="list-group" id="page">
                            <li class="list-group-item">
                                Không thay đổi IP mạng thường xuyên ( ví dụ mạng 3g , wifi quán
                                cafe, hoặc truy cập từ 1 ip lạ so với hàng ngày bạn truy cập Facebook)
                            </li>
                            <li class="list-group-item">
                                Không nên gửi quá 150 tin nhắn / ngày ( cả người lạ và quen ,
                                nên chia ra nhiều lần gửi để an toàn tài khoản Facebook)
                            </li>
                            <li class="list-group-item">
                                Không nên kết bạn quá 300 người / ngày ( nên chia nhỏ để kết bạn)
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card" style="background: #fff;min-height: 328px;">
            <div class="card-body" style="text-align: center;">
                <img src="<?= ClientHelper::$config['url_server'] . $user['avatar'] ?>" class="img-circle" width="150">
                <h4 class="card-title m-t-10"><?= $user['last_name'] ?></h4>
                <h6 class="card-subtitle">AUTOFACE.VN</h6>
                <div class="col-xs-6">
                        <span class="available-balances">
                            <strong class="tp-coin"><?= number_format(0, '0', '.', '.') ?></strong> VND
                        </span>
                </div>
                <div class="col-xs-6">
                    <a href="<?= Url::to(['site/bkim']) ?>">
                        <button class="btn btn-danger btn-sm" style="border-radius: 5px;width: 100%;">
                            <span class="fa fa-paypal"></span>
                            Nạp tiền
                        </button>
                    </a>
                </div>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body" style="padding: 0 25px;">
                <small class="text-muted">Email</small>
                <h6><?= $user['email'] ?></h6>
                <small class="text-muted p-t-30 db">Số điện thoại</small>
                <h6><?= $user['phone'] ?></h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="clearfix"></div>
    <div class="col-md-8 ui-sortable" data-container="left-8">
        <div class="widget" id="widget-finance_overview" data-name="Tổng quan ngân sách">
            <div class="finance-summary">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="widget-dragger ui-sortable-handle"></div>
                        <div class="row home-summary">
                            <div class="col-md-6 col-lg-4 col-sm-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-dark text-uppercase">Tin nhắn</p>
                                        <hr class="mtop15">
                                    </div>
                                    <div class="col-md-12 text-stats-wrapper">
                                        <a href="http://demo2.vinga.ooo/admin/invoices/list_invoices?status=6"
                                           class="text-muted mbot15 inline-block">
                                            <span class="_total bold">0</span> Nháp
                                        </a>
                                    </div>
                                    <div class="col-md-12 text-right progress-finance-status">
                                        0%
                                        <div class="progress no-margin progress-bar-mini">
                                            <div class="progress-bar progress-bar-default no-percent-text not-dynamic"
                                                 role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 0" data-percent="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-stats-wrapper">
                                        <a href="http://demo2.vinga.ooo/admin/invoices/list_invoices?filter=not_sent"
                                           class="text-muted inline-block mbot15">
                                            <span class="_total bold">0</span> Not Sent </a>
                                    </div>
                                    <div class="col-md-12 text-right progress-finance-status">
                                        0%
                                        <div class="progress no-margin progress-bar-mini">
                                            <div class="progress-bar progress-bar-default no-percent-text not-dynamic"
                                                 role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 0" data-percent="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-sm-6">
                                <div class="row">
                                    <div class="col-md-12 text-stats-wrapper">
                                        <p class="text-dark text-uppercase">Khách hàng</p>
                                        <hr class="mtop15">
                                    </div>
                                    <div class="col-md-12 text-stats-wrapper">
                                        <a href="http://demo2.vinga.ooo/admin/estimates/list_estimates?status=1"
                                           class="text-muted mbot15 inline-block estimate-status-dashboard-muted">
                                            <span class="_total bold">0</span>
                                            Nháp </a>
                                    </div>
                                    <div class="col-md-12 text-right progress-finance-status">
                                        0%
                                        <div class="progress no-margin progress-bar-mini">
                                            <div class="progress-bar progress-bar-default no-percent-text not-dynamic"
                                                 role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 0" data-percent="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-stats-wrapper">
                                        <a href="http://demo2.vinga.ooo/admin/estimates/list_estimates?filter=not_sent"
                                           class="text-muted mbot15 inline-block estimate-status-dashboard-muted">
                                            <span class="_total bold">0</span>
                                            Not Sent </a>
                                    </div>
                                    <div class="col-md-12 text-right progress-finance-status">
                                        0%
                                        <div class="progress no-margin progress-bar-mini">
                                            <div class="progress-bar progress-bar-default no-percent-text not-dynamic"
                                                 role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 0" data-percent="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-6 col-lg-4">
                                <div class="row">
                                    <div class="col-md-12 text-stats-wrapper">
                                        <p class="text-dark text-uppercase">Tìm kiếm</p>
                                        <hr class="mtop15">
                                    </div>
                                    <div class="col-md-12 text-stats-wrapper">
                                        <a href="http://demo2.vinga.ooo/admin/proposals/list_proposals?status=6"
                                           class="text-muted mbot15 inline-block">
                                            <span class="_total bold">0</span> Nháp </a>
                                    </div>
                                    <div class="col-md-12 text-right progress-finance-status">
                                        0%
                                        <div class="progress no-margin progress-bar-mini">
                                            <div class="progress-bar progress-bar-default no-percent-text not-dynamic"
                                                 role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 0" data-percent="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-stats-wrapper">
                                        <a href="http://demo2.vinga.ooo/admin/proposals/list_proposals?status=4"
                                           class="text-info mbot15 inline-block">
                                            <span class="_total bold">0</span> Đã gửi </a>
                                    </div>
                                    <div class="col-md-12 text-right progress-finance-status">
                                        0%
                                        <div class="progress no-margin progress-bar-mini">
                                            <div class="progress-bar progress-bar-default no-percent-text not-dynamic"
                                                 role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 0" data-percent="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <a href="#" class="hide invoices-total initialized"></a>
                        <div id="invoices_total" class="">
                            <div class="row">
                                <div class="col-lg-4 col-xs-12 col-md-12 total-column">
                                    <div class="panel_s">
                                        <div class="panel-body">
                                            <h3 class="text-muted _total">
                                                $0.00 </h3>
                                            <span class="text-warning">Hóa đơn nổi bật</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12 col-md-12 total-column">
                                    <div class="panel_s">
                                        <div class="panel-body">
                                            <h3 class="text-muted _total">
                                                $0.00 </h3>
                                            <span class="text-danger">Hóa đơn quá hạn</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12 col-md-12 total-column">
                                    <div class="panel_s">
                                        <div class="panel-body">
                                            <h3 class="text-muted _total">
                                                $0.00 </h3>
                                            <span class="text-success">Đã thanh toán</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 ui-sortable" data-container="right-4">
        <div class="widget hide" id="widget-goals" style="">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body padding-10">
                            <div class="widget-dragger ui-sortable-handle"></div>
                            <p class="padding-5">
                                Các mục tiêu
                            </p>
                            <hr class="hr-panel-heading-dashboard">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget" id="widget-projects_activity" data-name="Hoạt động dự án cuối cùng" style="">
            <div class="panel_s projects-activity">
                <div class="panel-body padding-10" style="min-height: 424px;">
                    <div class="widget-dragger ui-sortable-handle"></div>
                    <p class="padding-5">Hoạt động dự án cuối cùng</p>
                    <hr class="hr-panel-heading-dashboard">
                    <div class="activity-feed">
                        <div class="feed-item">
                            <div class="date">
                                    <span class="text-has-action">
                                        22 tiếng trước
                                    </span>
                            </div>
                            <div class="text">
                                <p class="bold no-mbot">
                                    <a href="http://demo2.vinga.ooo/admin/profile/1">Phạm Nghĩa</a>
                                    - Đã thêm thành viên mới
                                </p>
                                Tên dự án:
                                <a href="http://demo2.vinga.ooo/admin/projects/view/1">
                                    Dự án tháng 8 - 2018
                                </a>
                            </div>
                            <p class="text-muted mtop5">Phạm Nghĩa</p>
                        </div>
                        <div class="feed-item">
                            <div class="date">
                                    <span class="text-has-action">
                                        22 tiếng trước
                                    </span>
                            </div>
                            <div class="text">
                                <p class="bold no-mbot">
                                    <a href="http://demo2.vinga.ooo/admin/profile/1">Phạm Nghĩa</a>
                                    - Đã tạo dự án
                                </p>
                                Tên dự án:
                                <a href="http://demo2.vinga.ooo/admin/projects/view/1">
                                    Dự án tháng 8 - 2018
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>