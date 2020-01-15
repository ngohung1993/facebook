<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $supporter common\models\Supporter */

$this->title = Yii::t('backend', 'Supporter');

?>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-shield"></i>
            </span>
            <span class="title">
                <?= Yii::t('backend', 'Supporter') ?>
            </span>
        </h2>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="pull-right">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a class="btn btn-sm btn-twitter"><i class="fa fa-download"></i> Export</a>
                            <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="" target="_blank">All</a></li>
                                <li><a href="" target="_blank">Current page</a></li>
                                <li><a href="" target="_blank" class="export-selected">Selected rows</a></li>
                            </ul>
                        </div>
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a href="<?= Url::to(['create']) ?>" class="btn btn-sm btn-success">
                                <i class="fa fa-save"></i> <?= Yii::t('backend', 'New') ?>
                            </a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-sm btn-default"> Action</a>
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" class="grid-batch-0">Delete</a></li>
                        </ul>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="padding-left: 15px;">
                                <input title="" type="checkbox" class="minimal">
                            </th>
                            <th>STT</th>
                            <th><?= Yii::t('backend', 'Full name') ?></th>
                            <th><?= Yii::t('backend', 'Phone') ?></th>
                            <th><?= Yii::t('backend', 'Email') ?></th>
                            <th><?= Yii::t('backend', 'Status') ?></th>
                            <th><?= Yii::t('backend', 'Action') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($supporter as $key => $value): ?>
                            <tr>
                                <td style="padding-left: 15px;">
                                    <input title="" data-id="<?= $value['id'] ?>" type="checkbox" class="minimal">
                                </td>
                                <td>
                                    <?= $key + 1 ?>
                                </td>
                                <td>
                                    <a href="#" class="editable" data-name="supporter#full_name" data-type="text"
                                       data-pk="<?= $value['id'] ?>" data-title="Enter title"
                                       data-url="<?= Url::to(['ajax/edit-column']) ?>">
                                        <?= $value['full_name'] ?>
                                    </a>
                                </td>
                                <td>
                                    <?= $value['phone'] ?>
                                </td>
                                <td>
                                    <?= $value['email'] ?>
                                </td>
                                <td>
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini"
                                         style="border:none">
                                        <input data-id="<?= $value['id'] ?>" data-api="ajax/enable-column"
                                               data-table="supporter" data-column="status"
                                               type="checkbox" <?= $value['status'] ? 'checked="checked"' : '' ?>
                                               title="" name="switch-checkbox">
                                    </div>
                                </td>
                                <td>
                                    <a href="<?= Url::to(['update', 'id' => $value['id']]) ?>">
                                        <i class="fa fa fa-edit"></i>
                                    </a>
                                    <?= Html::a(Yii::t('backend', '<i class="fa fa-trash-o"></i>'), ['delete', 'id' => $value->id], [
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