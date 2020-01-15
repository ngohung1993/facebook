<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\assets\ImageAsset;

ImageAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $album common\models\Album */
/* @var $albums common\models\Album */

$this->title = Yii::t('backend', $model['title']);

?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', $model['title']) ?>
        <small>Albums</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?= Url::to(['site/index']) ?>">
                <i class="fa fa-home"></i>
                <?= Yii::t('backend', 'Home'); ?>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['product/index']) ?>">
                <?= Yii::t('backend', 'Products'); ?>
            </a>
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <?php foreach ($albums as $key => $value): ?>
                        <li class="<?= $key == 0 ? 'active' : '' ?>">
                            <a href="#tab-<?= $key ?>" data-toggle="tab" aria-expanded="true">
                                <?= Yii::t('backend', $value['title']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content">
                    <?php if (!$albums): ?>
                        <div class="tab-pane active">
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
                                            <li><a href="" target="_blank" class="export-selected">Selected rows</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group pull-right" style="margin-right: 10px">
                                        <a href="" data-toggle="modal" data-target="#modal-default"
                                           class="btn btn-sm btn-success">
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
                        </div>
                    <?php endif; ?>
                    <?php foreach ($albums as $key => $value): ?>
                        <div class="tab-pane <?= $key == 0 ? 'active' : '' ?>" id="tab-<?= $key ?>">
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
                                            <li><a href="" target="_blank" class="export-selected">Selected rows</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group pull-right" style="margin-right: 10px">
                                        <a href="" data-toggle="modal" data-target="#modal-default"
                                           class="btn btn-sm btn-success">
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
                                            <input title="" type="checkbox" class="minimal check-image">
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
                                <?php foreach ($value['images'] as $key_i => $value_i): ?>
                                    <div class="file-preview-frame krajee-default  kv-preview-thumb">
                                        <div class="kv-file-content">
                                            <img src="<?= $value_i['avatar'] ?>"
                                                 class="kv-preview-data file-preview-image">
                                        </div>
                                        <div class="file-thumbnail-footer">
                                            <div class="file-footer-caption">
                                                <a href="#" class="editable" data-name="image#title" data-type="text"
                                                   data-pk="<?= $value_i['id'] ?>" data-title="Enter title"
                                                   data-url="<?= Url::to(['ajax/edit-column']) ?>">
                                                    <?= $value_i['title'] ?>
                                                </a>
                                            </div>
                                            <div class="file-upload-indicator">
                                                <input title="" type="checkbox" class="minimal check-image">
                                            </div>
                                            <div class="file-actions">
                                                <div class="file-footer-buttons">
                                                    <button data-auto="1" data-id="<?= $value_i['id'] ?>" type="button"
                                                            class="btn btn-xs btn-default"
                                                            onclick="deleteFile(event)">
                                                        <i class="glyphicon glyphicon-trash"></i>
                                                    </button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="spanButtonPlaceholder block-upload-item"
                                 style="position: relative; overflow: hidden;margin: 10px;">
                                <p>(Click để tải ảnh<br> hoặc kéo thả ảnh vào đây)</p>
                                <input data-auto="1" data-id="<?= $value['id'] ?>" data-column-parent-id="album_id"
                                       class="kv-file-drop-zone" multiple="multiple" type="file" name="file">
                            </div>
                            <div class="droptext">
                                Đăng ảnh thật nhanh bằng cách kéo và thả ảnh vào khung. Thay đổi vị trí của
                                ảnh bằng cách kéo ảnh vào vị trí mà bạn muốn!
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade in" id="modal-default">
    <div class="modal-dialog">
        <?php $form = ActiveForm::begin(); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Album</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= $form->field($album, 'title')->textInput() ?>
                            <?= $form->field($album, 'product_id')->hiddenInput(['value' => $model->id])->label(false) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>