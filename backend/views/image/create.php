<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\ImageAsset;

ImageAsset::register($this);

/* @var $this yii\web\View */
/* @var $location common\models\PhotoLocation */
/* @var $images common\models\Image */

$this->title = Yii::t('backend', 'Image ' . $location['title']);

?>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-picture-o"></i>
            </span>
            <span class="title">
                <a href="<?= Url::to(['index']) ?>"> <?= Yii::t('backend', 'Images') ?></a>
            </span>
            <span>/</span>
            <span class="title">
                <?= $location['title'] ?>
            </span>
        </h2>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_1" data-toggle="tab" aria-expanded="true">
                            <?= Yii::t('backend', 'Quick view') ?>
                        </a>
                    </li>
                    <li class="">
                        <a href="#tab_2" data-toggle="tab" aria-expanded="false">
                            <?= Yii::t('backend', 'Detail') ?>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box-header">
                            <div class="pull-right">
                                <div class="btn-group pull-right" style="margin-right: 10px">
                                    <a class="btn btn-sm btn-twitter"><i class="fa fa-download"></i> Export</a>
                                    <button type="button" class="btn btn-sm btn-twitter dropdown-toggle"
                                            data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="" target="_blank">All</a></li>
                                        <li><a href="" target="_blank">Current page</a></li>
                                        <li><a href="" target="_blank" class="export-selected">Selected rows</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-default"> Action</a>
                                <button type="button" class="btn btn-sm btn-default dropdown-toggle"
                                        data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" class="grid-batch-0">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="list-img-temp" class="thumbnails ui-sortable" style="display: none">
                            <div class="file-preview-frame krajee-default  kv-preview-thumb">
                                <div class="kv-file-content">
                                    <img src="" class="kv-preview-data file-preview-image">
                                </div>
                                <div class="file-thumbnail-footer">
                                    <div class="file-footer-caption">
                                        <span class="caption"></span>
                                    </div>
                                    <div class="file-upload-indicator">
                                    </div>
                                    <div class="file-actions">
                                        <div class="file-footer-buttons">
                                            <button type="button" data-auto="1"
                                                    class="kv-file-zoom btn btn-xs btn-default"
                                                    onclick="deleteFile(event)">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="list-img" class="thumbnails ui-sortable">
                            <?php if (isset($images)): foreach ($images as $key => $value): ?>
                                <div class="file-preview-frame krajee-default  kv-preview-thumb">
                                    <div class="kv-file-content">
                                        <img src="<?= $value['avatar'] ?>"
                                             class="kv-preview-data file-preview-image">
                                    </div>
                                    <div class="file-thumbnail-footer">
                                        <div class="file-footer-caption">
                                            <a href="#" class="editable" data-name="image#title" data-type="text"
                                               data-pk="<?= $value['id'] ?>" data-title="Enter title"
                                               data-url="<?= Url::to(['ajax/edit-column']) ?>">
                                                <?= $value['title'] ?>
                                            </a>
                                        </div>
                                        <div class="file-upload-indicator">
                                            <button type="button" class="btn btn-xs btn-default"
                                                    onclick="load_content_image(<?= $value['id'] ?>)"
                                                    data-toggle="modal" data-target="#content-image">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="file-actions">
                                            <div class="file-footer-buttons">
                                                <button data-auto="1" data-id="<?= $value['id'] ?>" type="button"
                                                        class="btn btn-xs btn-default"
                                                        onclick="deleteFile(event)">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; endif; ?>
                        </div>
                        <div class="spanButtonPlaceholder block-upload-item"
                             style="position: relative; overflow: hidden;margin: 10px;">
                            <p>(Click để tải ảnh<br> hoặc kéo thả ảnh vào đây)</p>
                            <input data-auto="1" data-id="<?= $location['id'] ?>"
                                   data-column-parent-id="photo_location_id" class="kv-file-drop-zone"
                                   multiple="multiple" type="file" name="file">
                        </div>
                        <div class="droptext">Đăng ảnh thật nhanh bằng cách kéo và thả ảnh vào khung. Thay đổi vị trí
                            của
                            ảnh bằng cách kéo ảnh vào vị trí mà bạn muốn!
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="box-header">
                            <div class="pull-right">
                                <div class="btn-group pull-right" style="margin-right: 10px">
                                    <a class="btn btn-sm btn-twitter"><i class="fa fa-download"></i> Export</a>
                                    <button type="button" class="btn btn-sm btn-twitter dropdown-toggle"
                                            data-toggle="dropdown">
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
                                    <a href="<?= Url::to(['category/create']) ?>" class="btn btn-sm btn-success">
                                        <i class="fa fa-save"></i> <?= Yii::t('backend', 'New') ?>
                                    </a>
                                </div>
                            </div>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-default"> Action</a>
                                <button type="button" class="btn btn-sm btn-default dropdown-toggle"
                                        data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" class="grid-batch-0">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="padding-left: 15px;">
                                    <input title="" type="checkbox" class="minimal">
                                </th>
                                <th>STT</th>
                                <th><?= Yii::t('backend', 'Title') ?></th>
                                <th><?= Yii::t('backend', 'Action') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($images as $key => $value): ?>
                                <tr>
                                    <td style="padding-left: 15px;">
                                        <input title="" data-id="<?= $value['id'] ?>" type="checkbox" class="minimal">
                                    </td>
                                    <td>
                                        <?= $key + 1 ?>
                                    </td>
                                    <td>
                                        <?= $value['title'] ?>
                                    </td>
                                    <td>
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
    </div>
</section>

<div id="content-image" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Content Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="link">Đường dẫn</label>
                            <input class="form-control" type="text" title="" id="link">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="describe-temp">Mô tả</label>
                            <input class="form-control" type="text" title="" id="describe-temp">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="describe">Nội dụng</label>
                            <textarea title="" name="" id="describe" cols="30" rows="10">
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="id-image">
                <button type="button" class="btn btn-primary" onclick="save_content_image()" data-dismiss="modal">
                    <i class="fa fa-check"></i>
                    Xác nhận
                </button>
            </div>
        </div>
    </div>
</div>