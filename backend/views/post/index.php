<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\FunctionHelper;
use backend\assets\PostAsset;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $posts common\models\Post */
/* @var $categories \common\models\Category */
/* @var $pages \yii\data\Pagination */
PostAsset::register($this);
$this->title = Yii::t( 'backend', 'Posts' );

?>

<section class="content-header">
    <div class="page-heading page-heading-md" style="height: 53px;">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-thumb-tack"></i>
                <?= Yii::t('backend', 'Post') ?>

            </span>
        </h2>
        <div class="header-right">
            <div class="btn-group pull-right" style="margin-right: 10px">
                <a href="<?= Url::to( [ 'post/create' ] ) ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i> <?= Yii::t( 'backend', 'New' ) ?>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="tablenav top">
                        <div class="alignleft actions bulkactions">
                            <select title="" name="action" id="post-task">
                                <option value="">Tác vụ</option>
                                <option value="1" class="hide-if-no-js">Kích hoạt</option>
                                <option value="0" class="hide-if-no-js">Ngừng kích hoạt</option>
                                <option value="trash">Bỏ vào thùng rác</option>
                            </select>
                            <input type="submit" id="doaction" onclick="task()" class="button btn btn-primary action" value="Áp dụng">
                        </div>
                        <div class="alignleft actions">
                            <select title="" name="cat" id="post-category" class="postform">
                                <option value="" selected="selected">Tất cả chuyên mục</option>
                                <?php  foreach ($categories as $key =>$value):?>
                                    <option  value="<?= $value['id']?>"><?= $value['title']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="alignleft actions">
                            <input type="text" id="key-word" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
                        </div>
                        <div class="alignleft actions">
                            <input type="submit" name="filter_action" onclick="search_post()" id="post-query-submit"
                                   class="button btn btn-primary" value="Tìm">
                        </div>
                        <div class="tablenav-pages one-page">

                        </div>
                        <br class="clear">
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="wp-list-table widefat fixed striped posts">
                        <thead>
                        <tr>
                            <td class="manage-column column-cb check-column">

                            </td>
                            <th scope="col"
                                class="manage-column column-title column-primary sortable desc">
                                <span>Tiêu đề</span>
                            </th>
                            <th scope="col" class="manage-column column-categories">
                                Chuyên mục
                            </th>
                            <th scope="col" class="manage-column column-tags">
                                Thẻ
                            </th>
                            <th scope="col"
                                class="manage-column column-comments num sortable desc">
                                Thao tác
                            </th>
                        </tr>
                        </thead>
                        <tbody id="the-list">
						<?php foreach ( $posts as $key => $value ): ?>
                            <tr id="post-<?= $value['id'] ?>"
                                class="iedit author-self level-0 type-post status-publish format-standard has-post-thumbnail hentry category-events category-health category-receipes category-travel">
                                <th scope="row" class="check-column">
                                    <input title="" type="checkbox" name="post-check" data-id="<?= $value['id']?>" data-status="<?= $value['status']?>">
                                </th>
                                <td class="title column-title has-row-actions column-primary page-title">
                                    <div class="locked-info"><span class="locked-avatar"></span>
                                        <span class="locked-text"></span>
                                    </div>
                                    <strong>
                                        <a class="row-title" href="">
											<?= $value['title'] ?>
                                        </a>
                                    </strong>
                                    <div class="row-actions">
                                    <span class="edit">
                                        <a href="<?= Url::to( [
	                                        'post/update',
	                                        'id' => $value['id']
                                        ] ) ?>">Chỉnh sửa</a> |
                                    </span>
                                        <span class="inline hide-if-no-js">
                                        <a data-post-id="<?= $value['id'] ?>" href="#" class="edit-inline">Sửa nhanh</a> |
                                    </span>
                                        <span class="view">
                                        <?= Html::a( Yii::t( 'backend', 'Xóa' ), [
	                                        'delete',
	                                        'id' => $value['id']
                                        ], [
	                                        'data' => [
		                                        'confirm' => Yii::t( 'backend', 'Are you sure you want to delete this item?' ),
		                                        'method'  => 'post',
	                                        ],
                                        ] ) ?>
                                    </span>
                                    </div>
                                </td>
                                <td class="categories column-categories">
                                    <a href="">
										<?= $value['category']['title'] ?>
                                    </a>
                                </td>
                                <td class="tags column-tags">
                                    <span>—</span>
                                </td>
                                <td class="comments column-comments">
                                    <div class="post-com-count-wrapper">
                                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini"
                                             style="border:none">
                                            <input data-id="<?= $value['id'] ?>" data-api="ajax/enable-column"
                                                   data-table="post" data-column="status"
                                                   type="checkbox" <?= $value['status'] ? 'checked="checked"' : '' ?>
                                                   title="" name="switch-checkbox">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hidden"></tr>
                            <tr style="display: none" id="post-inline-<?= $value['id'] ?>"
                                class="inline-edit-row inline-edit-row-post quick-edit-row quick-edit-row-post inline-edit-post inline-editor">
                                <td colspan="8" class="colspanchange">
                                    <fieldset class="inline-edit-col-left col-md-5 col-xs-12">
                                        <legend class="inline-edit-legend">Sửa nhanh</legend>
                                        <div class="inline-edit-col">
                                            <label>
                                                <span class="title">Tiêu đề</span>
                                                <span class="input-text-wrap">
                                                <input title="" type="text" id="post-title-<?= $value['id'] ?>"
                                                       class="ptitle" value="<?= $value['title'] ?>">
                                            </span>
                                            </label>
                                            <label>
                                                <span class="title">Danh mục</span>
                                                <span class="input-text-wrap">
                                                <select title="" name="" id="post-category-id-<?= $value['id'] ?>"
                                                        style="width: 100%;">
                                                    <?php FunctionHelper::show_categories_select( $categories, $value['category_id'] ) ?>
                                                </select>
                                            </span>
                                            </label>
                                            <div class="inline-edit-group wp-clearfix">
                                                <label class="alignleft">
                                                    <input type="checkbox" id="post-featured-<?= $value['id'] ?>"
                                                           value="1" <?= $value['featured'] ? 'checked' : '' ?>>
                                                    <span class="checkbox-title">Nổi bật</span>
                                                </label>
                                                <label class="alignleft">
                                                    <input type="checkbox"
                                                           id="post-display-homepage-<?= $value['id'] ?>"
                                                           value="1" <?= $value['display_homepage'] ? 'checked' : '' ?>>
                                                    <span class="checkbox-title">Hiển thị trang chủ</span>
                                                </label>
                                            </div>
                                            <label>
                                                <span class="title">Ngày đăng</span>
                                                <span class="input-text-wrap">
                                                <input id="post-created-at-<?= $value['id'] ?>" disabled
                                                       value="<?= date( 'Y-m-d', strtotime( $value['created_at'] ) ) ?>"
                                                       type="date" title="" class="ptitle" style="width: 100%;">
                                            </span>
                                            </label>
                                            <br class="clear">
                                        </div>
                                    </fieldset>
                                    <fieldset class="inline-edit-col-left col-md-3 col-xs-12">
                                        <legend class="inline-edit-legend">Hình ảnh</legend>
                                        <div class="inline-edit-col">
                                            <div id="list-img-temp" class="thumbnails ui-sortable"
                                                 style="display: none">
                                                <div class="file-preview-frame krajee-default  kv-preview-thumb">
                                                    <div class="kv-file-content" style="padding: 6px;">
                                                        <img src="" class="kv-preview-data file-preview-image"
                                                             style="height: 170px;">
                                                    </div>
                                                    <div class="file-thumbnail-footer">
                                                        <div class="file-upload-indicator" title="Not uploaded yet"
                                                             style="margin: 5px;">
                                                            <i class="glyphicon glyphicon-hand-down text-warning"></i>
                                                        </div>
                                                        <div class="file-actions">
                                                            <div class="file-footer-buttons">
                                                                <button type="button" style="margin: 5px;"
                                                                        class="kv-file-zoom btn btn-xs btn-default"
                                                                        onclick="deleteFileOne(event)">
                                                                    <i class="glyphicon glyphicon-trash"></i>
                                                                </button>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-upload-image">
                                                <div class="thumbnails ui-sortable"
                                                     id="post-avatar-<?= $value['id'] ?>">
													<?php if ( $value['avatar'] ): ?>
                                                        <div class="file-preview-frame krajee-default  kv-preview-thumb">
                                                            <div class="kv-file-content" style="padding: 6px;">
                                                                <img src="<?= $value['avatar'] ?>"
                                                                     style="height: 170px;"
                                                                     class="kv-preview-data file-preview-image">
                                                            </div>
                                                            <div class="file-thumbnail-footer">
                                                                <div class="file-upload-indicator"
                                                                     title="Not uploaded yet"
                                                                     style="margin: 5px;">
                                                                    <i class="glyphicon glyphicon-hand-down text-warning"></i>
                                                                </div>
                                                                <div class="file-actions">
                                                                    <div class="file-footer-buttons">
                                                                        <button type="button"
                                                                                class="btn btn-xs btn-default"
                                                                                onclick="deleteFileOne(event)"
                                                                                style="margin: 5px;">
                                                                            <i class="glyphicon glyphicon-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </div>
                                                        </div>
													<?php endif; ?>
                                                </div>
                                                <div class="spanButtonPlaceholder block-upload-item"
                                                     style="position: relative; overflow: hidden;margin: 10px;<?= $value['avatar'] ? 'display:none;' : 'display:block;' ?>">
                                                    <p>(Click để tải ảnh<br> hoặc kéo thả ảnh vào đây)</p>
                                                    <input class="kv-file-drop-zone-one-image" type="file" name="file">
                                                </div>
                                            </div>
                                            <br class="clear">
                                        </div>
                                    </fieldset>
                                    <fieldset class="inline-edit-col-left col-md-4 col-xs-12">
                                        <legend class="inline-edit-legend">Công cụ SEO</legend>
                                        <div class="inline-edit-col">
                                            <label>
                                                <span class="title">Seo title</span>
                                                <span class="input-text-wrap">
                                                <input title="" type="text" id="seo-title-<?= $value['id'] ?>"
                                                       class="ptitle"
                                                       value="<?= $value['seoTool']['seo_title'] ?>">
                                            </span>
                                            </label>
                                            <label>
                                                <span class="title">Meta Description</span>
                                                <span class="input-text-wrap">
                                                <textarea cols="22" rows="2" id="meta-keywords-<?= $value['id'] ?>"
                                                          class="tax_input_post_tag ui-autocomplete-input"><?= $value['seoTool']['meta_keywords'] ?></textarea>
                                            </span>
                                            </label>
                                            <label>
                                                <span class="title">Meta Keywords</span>
                                                <span class="input-text-wrap">
                                                <textarea cols="22" rows="2" id="meta-description-<?= $value['id'] ?>"
                                                          class="tax_input_post_tag ui-autocomplete-input"><?= $value['seoTool']['meta_description'] ?></textarea>
                                            </span>
                                            </label>
                                            <br class="clear">
                                        </div>
                                    </fieldset>
                                    <div class="submit inline-edit-save">
                                        <button data-post-id="<?= $value['id'] ?>" type="button"
                                                class="cancel-edit-inline btn btn-default alignleft">
                                            <i class="fa fa-close"></i> Hủy
                                        </button>
                                        <button data-post-id="<?= $value['id'] ?>" type="button"
                                                class="submit-edit-inline btn btn-primary alignright">
                                            <i class="fa fa-check"></i> Cập nhật
                                        </button>
                                    </div>
                                </td>
                            </tr>
						<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 0 15px!important;margin-bottom: 20px;">
        <div class="col-md-12">
            <div class="product-pagination text-center">
                <div class="header-subject">
                    <?php
                    echo LinkPager::widget(['pagination' => $pages]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>