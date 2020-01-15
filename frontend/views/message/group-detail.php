<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/11/2018
 * Time: 2:56 PM
 */

use yii\helpers\Url;

/* @var $files common\models\File */
/* @var $group common\models\Group */

$this->title = 'Danh sách tệp';

?>

<style>
    table td {
        line-height: 2.5 !important;
    }
</style>

<div class="col-lg-12">
    <section class="box">
        <header class="panel_header">
            <h2 class="title pull-left">
                <?= $group['title'] ?>
            </h2>
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
                                <th>Tên tệp</th>
                                <th>Khách hàng</th>
                                <th>Ngày tạo</th>
                                <th style="width: 100px;text-align: center">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($files as $key => $value): ?>
                                <tr class="<?= $value['id'] ?>">
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <a href="<?= Url::to(['message/file', 'id' => $value['id']]) ?>">
                                            <?= $value['title'] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= count($value['members']) ?>
                                    </td>
                                    <td>
                                        <?= date('H:i:s d/m/Y', strtotime($value['created_at'])) ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="">
                                            <button class="btn btn-danger btn-sm">
                                                <span class="fa fa-trash-o"></span>
                                            </button>
                                        </a>
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