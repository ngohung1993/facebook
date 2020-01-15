<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/11/2018
 * Time: 2:56 PM
 */

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $groups common\models\User */

$this->title = 'Nhóm khách hàng';

?>

<style>
    table td {
        line-height: 2.5 !important;
    }
</style>

<div class="col-lg-12">
    <section class="box">
        <header class="panel_header">
            <h2 class="title pull-left">Nhóm khách hàng</h2>
            <div class="actions panel_actions pull-right">
                <button class="btn btn-primary btn-radius" data-toggle="modal" href="#crud-facebook">
                    <span class="fa fa-plus"></span>
                    Thêm nhóm khách hàng
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
                                <th style="width: 10px;">
                                    <span class="fa fa-sort-numeric-asc"></span>
                                </th>
                                <th>Tên nhóm</th>
                                <th>Ngày tạo</th>
                                <th style="width: 100px;text-align: center">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($groups as $key => $value): ?>
                                <tr class="<?= $value['id'] ?>">
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <a href="<?= Url::to(['message/group', 'id' => $value['id']]) ?>">
                                            <?= $value['title'] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= date('H:i:s d/m/Y', strtotime($value['created_at'])) ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= Html::a(Yii::t('backend', '<button class="btn btn-danger btn-sm">
                                                <span class="fa fa-trash-o"></span>
                                            </button>'), [
                                            'delete-group',
                                            'id' => $value->id
                                        ], [
                                            'data' => [
                                                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                                                'method' => 'post',
                                            ],
                                        ]) ?>
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
                <h4 class="modal-title">Thêm nhóm khách hàng</h4>
            </div>
            <div class="modal-body">
                <img id="loading" src="/uploads/core/images/loading.gif" style="display: none;">
                <div id="step-1">
                    <label class="form-label" for="field-1">
                        Tên nhóm
                    </label>
                    <div class="form-group has-feedback">
                        <input title="" type="text" id="crud-title" class="form-control"
                               placeholder="Nhập tên nhóm">
                        <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
                <button class="btn btn-success" type="button" onclick="crud_group()">
                    <span class="fa fa-check"></span>
                    Thêm nhóm
                </button>
            </div>
        </div>
    </div>
</div>