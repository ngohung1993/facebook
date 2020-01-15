<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/11/2018
 * Time: 2:56 PM
 */

use frontend\assets\FacebookAccountAsset;

/* @var $user common\models\User */
/* @var $facebook_accounts array */

FacebookAccountAsset::register( $this );

$this->title = 'Tài khoản facebook';

?>

<style>
    table td {
        line-height: 1.42857143!important;
    }

    table th {
        text-align: center;
        text-transform: uppercase;
    }
</style>

<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left" style="text-transform: uppercase;">Tài khoản facebook</h2>
            <div class="actions panel_actions pull-right">
                <button class="btn btn-success btn-radius" data-toggle="modal" href="#crud-facebook">
                    <span class="fa fa-plus"></span>
                    Thêm tài khoản facebook
                </button>
            </div>
        </header>
        <div class="content-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    <span class="fa fa-sort-numeric-asc"></span>
                                </th>
                                <th>Tài khoản</th>
                                <th>UID</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach ( $facebook_accounts as $key => $value ): ?>
                                <tr class="<?= $value['uid'] ?>">
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <img src="<?= $value['avatar'] ?>"
                                             style="width: 30px;height: 30px;" class="img-circle">
                                        <?= $value['name'] ?>
                                    </td>
                                    <td>
										<?= $value['uid'] ?>
                                    </td>
                                    <td>
                                        <span class="check hidden" style="color: #f1b900;">
                                            <span class="fa fa-cog fa-spin"></span>
                                            Đang kiểm tra
                                        </span>
										<?php if ( $value['status'] ): ?>
                                            <span class="active" style="color: blue;">
                                                <span class="fa fa-check"></span>
                                                Đang hoạt động
                                            </span>
                                            <span class="not-active hidden" style="color: red;">
                                                <span class="fa fa-check"></span>
                                                Đã hết hạn
                                            </span>
										<?php endif; ?>
										<?php if ( ! $value['status'] ): ?>
                                            <span class="active hidden" style="color: blue;">
                                                <span class="fa fa-check"></span>
                                                Đang hoạt động
                                            </span>
                                            <span class="not-active" style="color: red;">
                                                <span class="fa fa-check"></span>
                                                Đã hết hạn
                                            </span>
										<?php endif; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <button onclick="check_token(<?= $value['uid'] ?>)" class="btn btn-info btn-sm">
                                            <span class="fa fa-check"></span>
                                            Kiểm tra
                                        </button>
                                        <button data-toggle="modal" href="#crud-facebook" class="btn btn-success btn-sm">
                                            <span class="fa fa-shield"></span>
                                            Cập nhật
                                        </button>
                                        <button onclick="delete_token(<?= $value['uid'] ?>)" class="btn btn-danger btn-sm">
                                            <span class="fa fa-trash-o"></span>
                                            Xóa
                                        </button>
                                    </td>
                                </tr>
							<?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade col-xs-12 in" id="crud-facebook" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog animated fadeInDown">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Thêm tài khoản facebook</h4>
            </div>
            <div class="modal-body">
                <img id="loading" src="/uploads/core/images/loading.gif" style="display: none;">
                <div id="step-1" style="display: block;">
                    <div id="result-verify" style="display: none;">
                        <iframe width="100%" height="100%" src=""></iframe>
                        <div class="alert alert-success alert-dismissible" style="font-weight: 500;">
                            Vui lòng copy đoạn mã bên dưới và nhấn thêm tài khoản để thêm . <br>
                            <button onclick="go_step_two()" class="btn btn-info btn-rounded">Nhấn thêm mã tại đây
                            </button>
                        </div>
                    </div>
                    <div class="alert alert-primary alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Chú ý:</strong>
                        Vui lòng điền thông tin tài khoản Facebook của bạn. Nên dùng trình duyệt bạn
                        hay đăng nhập Facebook để đăng nhập dịch vụ. <br>Có thể bị checkpoint lần đầu tiên. Hãy vô
                        facebook xác nhận đó là tôi
                    </div>
                    <label class="form-label" for="field-1">
                        Email hoặc số điện thoại Facebook
                    </label>
                    <div class="form-group has-feedback">
                        <input title="" type="text" id="username" class="form-control"
                               placeholder="Email hoặc số điện thoại Facebook">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <label class="form-label" for="field-1">Mật khẩu Facebook</label>
                    <div class="form-group has-feedback">
                        <input title="" type="password" id="password" class="form-control"
                               placeholder="Mật khẩu Facebook">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                </div>
                <div id="step-2" style="display: none;">
                    <div class="result-error" style="display: none;">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>Cookie lỗi</strong>
                        </div>
                    </div>
                    <div class="result-success" style="display: none;">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            Thêm tài khoản thành công. Hệ thống sẽ tải lại trang.
                        </div>
                    </div>
                    <label style="font-weight: 600;">Nhập mã</label>
                    <textarea title="" name="" id="result" class="form-control" cols="30" rows="4"
                              placeholder="Mã facebook"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <input title="" type="hidden" id="username-send" value="<?= $user['username'] ?>">
                <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                <button class="btn btn-success" type="button" onclick="verify_account()">
                    <span class="fa fa-check"></span>
                    Thêm tài khoản
                </button>
            </div>
        </div>
    </div>
</div>