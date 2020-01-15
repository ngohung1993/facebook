<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\helpers\FunctionHelper;
use common\models\Page;

/* @var $this yii\web\View */
/* @var $model common\models\Classified */
/* @var $seo \common\models\SeoTool */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-folder"></i>
            </span>
            <span class="title">
                <a href="<?= Url::to(['index']) ?>"><?= Yii::t('backend', 'Classifieds') ?></a>
            </span>
            <span>/</span>
            <span class="title">
                <?= Yii::t('backend', 'Create') ?>
            </span>
        </h2>
        <div class="header-right">
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-check"></i> ' . Yii::t('app', 'Submit'), ['class' => 'btn btn-primary pull-right', 'onclick' => 'getImages()',]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= Yii::t('app', 'Basic information') ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <?= $form->field($model, 'title')->textInput() ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'describe')->textarea(['rows' => 2]) ?>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $form->field($model, 'category_id')->dropDownList(
                                    ArrayHelper::map(FunctionHelper::get_categories_by_page_key(Page::AD_PAGE), 'id', 'title')
                                ) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $form->field($model, 'province_id')->dropDownList(
                                    ArrayHelper::map(FunctionHelper::get_provinces(), 'id', 'ten')
                                ) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $form->field($model, 'district_id')->dropDownList(
                                    ArrayHelper::map(FunctionHelper::get_districts(), 'id', 'ten')
                                ) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $form->field($model, 'district_id')->textInput() ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $form->field($model, 'price')->textInput() ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= $form->field($model, 'district_id')->textInput() ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'address')->textInput() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><?= Yii::t('backend', 'Content Details') ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <?= $form->field($model, 'content')->textarea(['id' => 'content']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Công cụ SEO</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?= $form->field($seo, 'seo_title')->textInput() ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $form->field($seo, 'meta_keywords')->textarea(['rows' => 2]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $form->field($seo, 'meta_description')->textarea(['rows' => 2]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Liên hệ</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $form->field($model, 'contact_name')->textInput() ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $form->field($model, 'mobile')->textInput() ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?= $form->field($model, 'contacts')->textInput() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Lịch đăng tin</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <?= $form->field($seo, 'seo_title')->textInput() ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $form->field($model, 'start_date')->textInput() ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $form->field($model, 'expiration_date')->textInput() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'images')->hiddenInput(['id' => 'images'])->label(false) ?>
    </div>
    <div class="form-group" style="margin-right: 10px;">
        <?= Html::submitButton('<i class="fa fa-check"></i> ' . Yii::t('app', 'Submit'), ['class' => 'btn btn-primary pull-right', 'onclick' => 'getImages()',]) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>