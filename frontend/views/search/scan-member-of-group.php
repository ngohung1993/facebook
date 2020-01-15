<?php

/** @var $search integer */
/** @var $facebook integer */
/* @var $this \yii\web\View */
/** @var $facebook_accounts array */

$this->registerJsFile(
    '@web/js/search/scan-member-of-group.js'
);

$this->title = 'Quét UID nhóm';

?>

<div class="col-xs-12" style="background: #fff;padding-top: 15px;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h2 class="panel-title">
                Quét uid nhóm
            </h2>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        (*) Lấy UID Facebook
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <select title="" id="access-token" class="form-control">
                            <?php foreach ($facebook_accounts as $key => $value): ?>
                                <option <?= $value['id'] == $facebook ? 'selected="selected"' : '' ?>
                                        value="<?= $value['access_token'] ?>">
                                    <?= $value['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <input id="id-group" type="text" class="form-control input-md"
                               placeholder="Nhập UID nhóm mở hoặc nhóm bạn tham gia" value="<?= $search ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="submit" onclick="scan_member_of_group(event)" class="btn btn-accent"
                                data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang xử lý">
                            <span class="fa fa-search"></span>
                            Lấy danh sách
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