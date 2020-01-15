<?php
/**
 * Created by PhpStorm.
 * User: tran thanh
 * Date: 7/30/2018
 * Time: 10:28 PM
 */

/* @var $this \yii\web\View */
/** @var $facebook_accounts array */

$this->registerJsFile(
    '@web/js/facebook/request-friend.js'
);

$this->title = 'Chấp nhận lời mời kết bạn';

?>

<div class="col-xs-12" style="background: #fff;padding-top: 15px;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h2 class="panel-title">
                Chấp nhận lời mời kết bạn
            </h2>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        (*) Lấy UID Facebook
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select title="" id="access-token" class="form-control">
                            <option value="">Chọn tài khoản Facebook</option>
                            <?php foreach ($facebook_accounts as $key => $value): ?>
                                <option value="<?= $value['access_token'] ?>">
                                    <?= $value['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <button type="submit" onclick="scan_friend_request(event)" class="btn btn-primary"
                                data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang xử lý">
                            Lấy lời mời kết bạn
                        </button>
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
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="panel-body" style="background: #fff;">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <button class="btn btn-warning btn-radius" onclick="accept_friend(event)"
                            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang xử lý">
                        <span class="fa fa-check"></span>
                        Chấp nhận
                    </button>
                    <button class="btn btn-danger btn-radius" onclick="un_accept_friend(event)"
                            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang xử lý">
                        <span class="fa fa-trash-o"></span>
                        Không chấp nhận
                    </button>
                </div>
            </div>
            <div class="col-md-4 pull-right">
                <div class="form-group">
                    <button class="btn btn-success btn-radius" data-toggle="modal" href="#save-file">
                        <span class="fa fa-save"></span>
                        Lưu File
                    </button>
                    <button id="export-excel" class="btn btn-primary btn-radius"
                            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang xử lý">
                        <span class="fa fa-upload"></span>
                        Xuất Excel
                    </button>
                </div>
            </div>
        </div>
        <p>Trạng thái:
            <span id="status"></span>
        </p>
        <div class="row">
            <div class="col-md-12" style="padding: 0;">
                <div class="table-responsive">
                    <table class="table table-bordered" style="overflow-x: hidden;" id="table-result">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>