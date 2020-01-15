<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 8/12/2018
 * Time: 3:53 PM
 */

/* @var $this \yii\web\View */
/* @var $facebook_accounts array */

$this->registerJsFile(
    '@web/js/facebook/shield-avatar.js'
);

$this->title = 'Bảo vệ avatar Facebook';

?>

<div class="col-xs-12" style="background: #fff;padding-top: 15px;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h2 class="panel-title">
                Bảo vệ avatar Facebook
            </h2>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        (*) Bảo vệ avatar Facebook
                    </div>
                </div>
                <div class="col-md-4">
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
                <div class="col-md-4">
                    <div class="form-group">
                        <select title="" type="" id="action" class="form-control">
                            <option value="true">Bật</option>
                            <option value="false">Tắt</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="submit" onclick="shield_avatar(event)" class="btn btn-primary"
                                data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Đang xử lý">
                            Xác nhận
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
