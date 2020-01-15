<?php
/**
 * Created by PhpStorm.
 * User: tran thanh
 * Date: 7/18/2018
 * Time: 7:52 PM
 */

/* @var $this \yii\web\View */
/* @var $user common\models\User */
/* @var $facebook_accounts array */

$this->registerJsFile(
    '@web/js/facebook/uid-friend.js'
);

$this->title = 'Thông tài khoản bạn bè';

?>

<style>
    .alert-info {
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
    }

    .practice-wrap footer {
        background-color: #fff;
        position: fixed;
        top: auto;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 10;
        padding-top: 5px;
        padding-bottom: 5px;
        border-top: 1px solid #dddee0;
    }
</style>

<div class="col-xs-12" style="background: #fff;padding-top: 15px;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h2 class="panel-title">
                Thông tin tài khoản bạn bè
            </h2>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="alert alert-info">
                            Bạn có thể xuất thông tin bạn bè của mình để tránh mất thông tin
                            khi tài khoản của bạn có vấn đề.
                        </div>
                        (*) Lấy UID Facebook
                    </div>
                </div>
                <div class="col-md-3">
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
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Tuổi từ">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Đến tuổi">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <select title="" type="" id="sex" class="form-control">
                            <option value="All">Tất cả</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Không xác định">Không xác định</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <button type="submit" onclick="scan_your_friend(event)" class="btn btn-primary"
                                data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang xử lý">
                            Lấy danh sách bạn bè
                        </button>
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