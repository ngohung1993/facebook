<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\assets\CategoryAsset;
use common\helpers\FunctionHelper;
use common\models\Category;

CategoryAsset::register( $this );

/* @var $this yii\web\View */
/* @var $categories common\models\Category */

$this->title = Yii::t( 'backend', 'Categories' );

?>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-tags"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Categories' ) ?>
            </span>
        </h2>
        <div class="header-right">
                <div class="pull-right">
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a href="<?= Url::to( [ 'create' ] ) ?>" class="btn btn-primary">
                            <i class="fa fa-plus"></i> <?= Yii::t( 'backend', 'New' ) ?>
                        </a>
                    </div>
                </div>
        </div>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_2" data-toggle="tab" aria-expanded="false">
                            <i class="fa fa-info-circle"></i>
							<?= Yii::t( 'backend', 'Detail' ) ?>
                        </a>
                    </li>
                    <li class="">
                        <a href="#tab_1" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-sort-amount-desc"></i>
							<?= Yii::t( 'backend', 'Quick view' ) ?>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab_1">
                        <div class="box-header">
                            <div class="btn-group">
                                <a class="btn btn-primary btn-sm tree-5aa383cc537d1-tree-tools" data-action="expand">
                                    <i class="fa fa-plus-square-o"></i>
									<?= Yii::t( 'backend', 'Expand' ) ?>
                                </a>
                                <a class="btn btn-primary btn-sm tree-5aa383cc537d1-tree-tools" data-action="collapse">
                                    <i class="fa fa-minus-square-o"></i>
									<?= Yii::t( 'backend', 'Collapse' ) ?>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a class="btn btn-info btn-sm  tree-5aa383cc537d1-save">
                                    <i class="fa fa-save"></i>
									<?= Yii::t( 'backend', 'Save' ) ?>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="<?= Url::to( [ 'category/index' ] ) ?>"
                                   class="btn btn-warning btn-sm">
                                    <i class="fa fa-refresh"></i>
									<?= Yii::t( 'backend', 'Refresh' ) ?>
                                </a>
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <div class="dd" id="tree-5aa383cc537d1">
								<?php FunctionHelper::show_categories_nestable( $categories ) ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="tab_2">
                        <div class="box-header">
                            <div class="tablenav top">
                                <div class="alignleft actions bulkactions">
                                    <select title="" name="action" id="bulk-action-selector-top">
                                        <option value="-1">Tác vụ</option>
                                        <option value="edit" class="hide-if-no-js">Kích hoạt</option>
                                        <option value="edit" class="hide-if-no-js">Ngừng kích hoạt</option>
                                        <option value="trash">Bỏ vào thùng rác</option>
                                    </select>
                                    <input type="submit" id="doaction" class="button btn btn-primary action"
                                           value="Áp dụng">
                                </div>
                                <div class="alignleft actions">
                                    <select title="" name="cat" id="cat" class="postform">
                                        <option value="0" selected="selected">Tất cả chuyên mục</option>
                                        <option class="level-0" value="82">Blog</option>
                                        <option class="level-1" value="85">&nbsp;&nbsp; Events</option>
                                        <option class="level-1" value="84">&nbsp;&nbsp;&nbsp;Health</option>
                                        <option class="level-1" value="83">&nbsp;&nbsp;&nbsp;Receipes</option>
                                        <option class="level-1" value="86">&nbsp;&nbsp;&nbsp;Travel</option>
                                        <option class="level-0" value="1">Chưa được phân loại</option>
                                        <option class="level-0" value="2">Featured</option>
                                    </select>
                                    <input type="submit" name="filter_action" id="post-query-submit"
                                           class="button btn btn-primary" value="Lọc">
                                </div>

                                <br class="clear">
                            </div>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="wp-list-table widefat fixed striped posts">
                                <thead>
                                <tr>
                                    <td class="manage-column column-cb check-column">
                                        <input title="" id="cb-select-all" type="checkbox">
                                    </td>
                                    <th scope="col"
                                        class="manage-column column-title column-primary sortable desc">
                                        <span>Tiêu đề</span>
                                    </th>
                                    <th scope="col" class="manage-column column-author">
                                        Mục cha
                                    </th>
                                    <th scope="col" class="manage-column column-categories">
                                        Kiểu trang
                                    </th>
                                    <th scope="col" class="manage-column column-tags">
                                        Thẻ
                                    </th>
                                    <th scope="col" class="manage-column column-comments num">
                                        Trạng thái
                                    </th>
                                    <th scope="col" class="manage-column column-date sortable asc">
                                        <span>Thời gian</span>
                                    </th>
                                    <th scope="col" class="manage-column column-td_post_views">
                                        Views
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="the-list">
								<?php foreach ( $categories as $key => $value ): ?>
                                    <tr id="category-<?= $value['id'] ?>"
                                        class="iedit author-self level-0 type-post status-publish format-standard has-post-thumbnail hentry category-events category-health category-receipes category-travel">
                                        <th scope="row" class="check-column">
                                            <input title="" type="checkbox">
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
	                                                    'update',
	                                                    'id' => $value['id']
                                                    ] ) ?>">Chỉnh sửa</a> |
                                                </span>
                                                <span class="inline hide-if-no-js">
                                                    <a data-category-id="<?= $value['id'] ?>" href="#" class="edit-inline">Sửa nhanh</a> |
                                                </span>
                                                <span class="view">
                                                    <?= Html::a( Yii::t( 'backend', 'Xóa' ), [
	                                                    'delete',
	                                                    'id' => $value->id
                                                    ], [
	                                                    'data' => [
		                                                    'confirm' => Yii::t( 'backend', 'Are you sure you want to delete this item?' ),
		                                                    'method'  => 'post',
	                                                    ],
                                                    ] ) ?>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="author column-author">
											<?= Category::findOne( $value['parent_id'] )['title'] ?>
                                        </td>
                                        <td class="categories column-categories">
											<?= $value['page']['title'] ?>
                                        </td>
                                        <td class="tags column-tags">
                                            <span>—</span>
                                        </td>
                                        <td class="comments column-comments">
                                            <div class="post-com-count-wrapper">
                                                <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini"
                                                     style="border:none">
                                                    <input data-id="<?= $value['id'] ?>" data-api="ajax/release"
                                                           data-table="page"
                                                           type="checkbox" <?= $value['status'] ? 'checked="checked"' : '' ?>
                                                           title="" name="switch-checkbox">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="date column-date">
                                        </td>
                                        <td class="td_post_views column-td_post_views" data-colname="Views">0</td>
                                    </tr>
                                    <tr class="hidden"></tr>
                                    <tr style="display: none" id="category-inline-<?= $value['id'] ?>"
                                        class="inline-edit-row inline-edit-row-post quick-edit-row quick-edit-row-post inline-edit-post inline-editor">
                                        <td colspan="8" class="colspanchange">
                                            <fieldset class="inline-edit-col-left col-md-5 col-xs-12">
                                                <legend class="inline-edit-legend">Sửa nhanh</legend>
                                                <div class="inline-edit-col">
                                                    <label>
                                                        <span class="title">Tiêu đề</span>
                                                        <span class="input-text-wrap">
                                                            <input title="" type="text"
                                                                   id="category-title-<?= $value['id'] ?>"
                                                                   class="ptitle" value="<?= $value['title'] ?>">
                                                        </span>
                                                    </label>
                                                    <label>
                                                        <span class="title">Danh mục cha</span>
                                                        <span class="input-text-wrap">
                                                            <select title="" name=""
                                                                    id="parent-id-<?= $value['id'] ?>"
                                                                    style="width: 100%;">
                                                                <option value="0">--Chọn danh mục--</option>
                                                                <?php FunctionHelper::show_categories_select( $categories, $value['parent_id'] ) ?>
                                                            </select>
                                                        </span>
                                                    </label>
                                                    <div class="inline-edit-group wp-clearfix">
                                                        <label class="alignleft">
                                                            <input type="checkbox"
                                                                   id="category-featured-<?= $value['id'] ?>"
                                                                   value="1" <?= $value['featured'] ? 'checked' : '' ?>>
                                                            <span class="checkbox-title">Nổi bật</span>
                                                        </label>
                                                        <label class="alignleft">
                                                            <input type="checkbox"
                                                                   id="category-display-homepage-<?= $value['id'] ?>"
                                                                   value="1" <?= $value['display_homepage'] ? 'checked' : '' ?>>
                                                            <span class="checkbox-title">Hiển thị trang chủ</span>
                                                        </label>
                                                    </div>
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
                                                                <div class="file-upload-indicator"
                                                                     title="Not uploaded yet"
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
                                                             id="category-avatar-<?= $value['id'] ?>">
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
                                                            <input class="kv-file-drop-zone-one-image" type="file"
                                                                   name="file">
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
                                                            <input title="" type="text"
                                                                   id="seo-title-<?= $value['id'] ?>"
                                                                   class="ptitle"
                                                                   value="<?= $value['seoTool']['seo_title'] ?>">
                                                        </span>
                                                    </label>
                                                    <label>
                                                        <span class="title">Meta Description</span>
                                                        <span class="input-text-wrap">
                                                            <textarea cols="22" rows="2"
                                                                      id="meta-keywords-<?= $value['id'] ?>"
                                                                      class="tax_input_post_tag ui-autocomplete-input"><?= $value['seoTool']['meta_keywords'] ?></textarea>
                                                        </span>
                                                    </label>
                                                    <label>
                                                        <span class="title">Meta Keywords</span>
                                                        <span class="input-text-wrap">
                                                            <textarea cols="22" rows="2"
                                                                      id="meta-description-<?= $value['id'] ?>"
                                                                      class="tax_input_post_tag ui-autocomplete-input"><?= $value['seoTool']['meta_description'] ?></textarea>
                                                        </span>
                                                    </label>
                                                    <br class="clear">
                                                </div>
                                            </fieldset>
                                            <div class="submit inline-edit-save">
                                                <button data-category-id="<?= $value['id'] ?>" type="button"
                                                        class="cancel-edit-inline btn btn-default alignleft">
                                                    <i class="fa fa-close"></i> Hủy
                                                </button>
                                                <button data-category-id="<?= $value['id'] ?>" type="button"
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
        </div>
    </div>
</section>