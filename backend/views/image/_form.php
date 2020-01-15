<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $seo \common\models\SeoTool */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><?= Yii::t('app', 'Images') ?></h3>
                </div>
                <div class="box-body">
                    <div id="list-img-temp" class="thumbnails ui-sortable" style="display: none">
                        <div class="file-preview-frame krajee-default  kv-preview-thumb">
                            <div class="kv-file-content">
                                <img src="" class="kv-preview-data file-preview-image">
                            </div>
                            <div class="file-thumbnail-footer">
                                <div class="file-footer-caption">
                                    <span class="caption"></span>
                                </div>
                                <div class="file-upload-indicator" title="Not uploaded yet">
                                    <i class="glyphicon glyphicon-hand-down text-warning"></i>
                                </div>
                                <div class="file-actions">
                                    <div class="file-footer-buttons">
                                        <button type="button" class="kv-file-zoom btn btn-xs btn-default"
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
                                    <img src="<?= $value['anh_chinh'] ?>" class="kv-preview-data file-preview-image">
                                </div>
                                <div class="file-thumbnail-footer">
                                    <div class="file-footer-caption" title="kitchen_adventurer_lemon.jpg">
                                        <?= $value['anh_chinh'] ?>
                                    </div>
                                    <div class="file-upload-indicator" title="Not uploaded yet">
                                        <i class="glyphicon glyphicon-hand-down text-warning"></i>
                                    </div>
                                    <div class="file-actions">
                                        <div class="file-footer-buttons">
                                            <button type="button" class="btn btn-xs btn-default"
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
                        <input class="kv-file-drop-zone" multiple="multiple" type="file" name="file">
                    </div>
                    <div class="droptext">Đăng ảnh thật nhanh bằng cách kéo và thả ảnh vào khung. Thay đổi vị trí của
                        ảnh bằng cách kéo ảnh vào vị trí mà bạn muốn!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>