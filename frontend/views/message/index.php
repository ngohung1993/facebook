<?php

/* @var $this \yii\web\View */
/* @var $facebook_accounts array */

$this->title = 'Gửi tin nhắn';

?>

<div class="col-xs-12" style="background: #fff;padding-top: 15px;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h2 class="panel-title">
                Gửi tin nhắn
            </h2>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <select title="" id="access-token" class="form-control">
                            <option value="">Chọn tài khoản để gửi</option>
                            <?php foreach ($facebook_accounts as $key => $value): ?>
                                <option value="<?= $value['access_token'] ?>">
                                    <?= $value['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea class="form-control"
                                  placeholder="Nội dung tin nhắn ( nhiều nội dung cách nhau bởi dấu xuống dòng và tối đa 255 kí tự 1 tin nhắn). Cá nhân hóa bằng [name], [last_name] [first_name]"
                                  name="message" cols="4" rows="8" onkeyup="Check_Message();" id="message"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Danh sách người gửi" id="sender" name="sender"
                                  cols="4" rows="8"
                                  onkeyup="Check_User();"></textarea>
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
            <div class="row text-center">
                <div class="col-lg-4 col-md-4 m-t-20 col-xs-4">
                    <h1 class="m-b-0 font-light" id="total">0</h1>
                    <small>Tất cả</small>
                </div>
                <div class="col-lg-4 col-md-4 m-t-20 col-xs-4">
                    <h1 class="m-b-0 font-light" id="success" style="color: blue">0</h1>
                    <small style="color: blue">Thành công</small>
                </div>
                <div class="col-lg-4 col-md-4 m-t-20 col-xs-4">
                    <h1 class="m-b-0 font-light" id="error_1" style="color: red">0</h1>
                    <small style="color: red">Lỗi</small>
                </div>
            </div>
            <div class="progress" style="height: 30px">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0"
                     aria-valuemin="0" aria-valuemax="100" style="width:0;height: 30px;" id="percent">
                </div>
            </div>
            <div class="input-group">
                <button class="btn btn-danger" type="button" id="submit">
                    <span class="fa fa-send"></span>
                    Gửi tin nhắn
                </button>
                <button class="btn btn-info" type="button" id="submit-auto" style="margin-left: 4px;">
                    <span class="fa fa-shield"></span>
                    Gửi tự động ( có thể đóng trình duyệt )
                </button>
                <button class="btn btn-warning pull-right" type="button" value="" id="stop"
                        style="display: none;text-align: right;position: absolute;right: 0">Dừng lại
                </button>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>