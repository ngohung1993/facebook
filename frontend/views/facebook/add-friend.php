<?php
/**
 * Created by PhpStorm.
 * User: tran thanh
 * Date: 7/30/2018
 * Time: 9:53 PM
 */

/* @var $this \yii\web\View */
/* @var $data string */
/* @var $members array common\models\Member */
/* @var $facebook_accounts array */

$this->registerJsFile(
    '@web/js/facebook/add-friend.js'
);

$this->title = 'Gửi lời mời kết bạn';

?>

<style>
    .alert-warning {
        color: #856404;
        background-color: #fff3cd;
        border-color: #ffeeba;
    }

    .alert-info {
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
        text-align: center;
    }

    .alert *, .alert a {
        color: unset;
    }
</style>

<div class="col-xs-12" style="background: #fff;padding-top: 15px;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h2 class="panel-title">
                Gửi lời mời kết bạn
            </h2>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <select title="" id="access-token" class="form-control">
                            <option value="">Chọn tài khoản để gửi</option>
                            <?php foreach ($facebook_account as $key => $value): ?>
                                <option value="<?= $value['access_token'] ?>">
                                    <?= $value['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="100027504733227|Nguyễn Văn A" id="list-uid"
                                  rows="5" onkeypress="count_uid(event)"><?= $data ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="loading-search" style="text-align: center;display: none;">
                            <img style="width: 50px;" src="/uploads/core/images/loading-search.gif" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-info" id="warning" style="display: none;">
                Có vẻ bạn muốn kết bạn với nhiều người (208 người). Tuy nhiên chúng tôi khuyên
                bạn nên kết bạn không quá 150 người / ngày nhằm đảm bảo tài khoản Facebook của bạn an toàn.
            </div>
            <div class="alert alert-warning">
                Trạng thái:
                <span id="status">
                    <span style="color: blue;">
                    Đang chờ yêu cầu
                    </span>
                </span>
            </div>
            <div class="row text-center">
                <div class="col-lg-4 col-md-4 m-t-20 col-xs-4">
                    <h1 class="m-b-0 font-light" id="total"><?= count($members) ?></h1>
                    <small>Tất cả</small>
                </div>
                <div class="col-lg-4 col-md-4 m-t-20 col-xs-4">
                    <h1 class="m-b-0 font-light" id="success" style="color: blue">0</h1>
                    <small style="color: blue">Thành công</small>
                </div>
                <div class="col-lg-4 col-md-4 m-t-20 col-xs-4">
                    <h1 class="m-b-0 font-light" id="error" style="color: red">0</h1>
                    <small style="color: red">Lỗi</small>
                </div>
            </div>
            <div class="progress" style="height: 25px;">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0"
                     aria-valuemin="0" aria-valuemax="100" style="width:0;height: 25px;" id="percent">
                </div>
            </div>
            <div class="input-group">
                <button class="btn btn-danger" type="button" onclick="add_friend()"
                        data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang xử lý">
                    <span class="fa fa-send"></span>
                    Gửi lời mời kết bạn
                </button>
                <button class="btn btn-info" type="button" onclick="send_request_auto()" style="margin-left: 4px;">
                    <span class="fa fa-shield"></span>
                    Gửi tự động ( có thể đóng trình duyệt )
                </button>
                <button class="btn btn-warning pull-right" type="button" value="" onclick="stop()"
                        style="display: none;text-align: right;position: absolute;right: 0">Dừng lại
                </button>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>