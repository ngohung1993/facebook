<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/11/2018
 * Time: 2:56 PM
 */

use yii\helpers\Url;

/* @var $file common\models\File */
/* @var $members common\models\Member */

$this->registerJsFile(
    '@web/js/file.js'
);

$this->title = 'Danh sách khách hàng';

?>

<div class="col-xs-12" style="background: #fff;padding-top: 15px;">
    <input title="" id="file-id" type="hidden" value="<?= $file['id'] ?>">
    <div class="loading-search" style="text-align: center;">
        <img style="width: 50px;" src="/uploads/core/images/loading-search.gif" alt="">
    </div>
    <div class="content" style="display: block;">
        <div class="panel-body" style="background: #fff;">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <a href="<?= Url::to(['message/index', 'file_id' => $file['id']]) ?>">
                            <button class="btn btn-warning btn-radius">
                                <span class="fa fa-comments-o"></span>
                                Gửi tin nhằn
                            </button>
                        </a>
                        <a href="<?= Url::to(['facebook/view?ct=add-friend&file_id=' . $file['id']]) ?>">
                            <button class="btn btn-primary btn-radius">
                                <span class="fa fa-user"></span>
                                Kết bạn
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <button class="btn btn-success btn-radius" data-toggle="modal" href="#crud-member">
                            <span class="fa fa-plus"></span>
                            Thêm khách hàng
                        </button>
                        <button type="submit" onclick="scan_emotion_of_post()" class="btn btn-accent">
                            <span class="fa fa-trash-o"></span>
                            Xóa khách hàng đã chọn
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
</div>

<div class="modal fade col-xs-12 in" id="crud-member" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog animated fadeInDown">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Thêm khách hàng</h4>
            </div>
            <div class="modal-body">
                <img id="loading" src="/uploads/core/images/loading.gif" style="display: none;">
                <div id="members">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="field-1">
                                UID
                            </label>
                            <div class="form-group has-feedback">
                                <input title="" type="text" class="form-control uid"
                                       placeholder="Nhập UID hoặc LINK Facebook">
                                <span class="glyphicon glyphicon-link form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="field-1">Tên Facebook</label>
                            <div class="form-group has-feedback">
                                <input title="" type="text" class="form-control name"
                                       placeholder="Nhập tên Facebook">
                                <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="member-temp" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <input title="" type="text" class="form-control uid"
                                       placeholder="Nhập UID hoặc LINK Facebook">
                                <span class="glyphicon glyphicon-link form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <input title="" type="text" class="form-control name"
                                       placeholder="Nhập tên Facebook">
                                <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-danger" type="button" id="add-member">
                            <span class="fa fa-check"></span>
                            Thêm nhiều
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input title="" type="hidden" id="file-id" value="<?= $file['id'] ?>">
                <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                <button class="btn btn-success" type="button" onclick="add_member(event)"
                        data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang xử lý">
                    <span class="fa fa-check"></span>
                    Thêm khách hàng
                </button>
            </div>
        </div>
    </div>
</div>