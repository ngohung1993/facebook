<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Page;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $seo \common\models\SeoTool */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">
	<?php $form = ActiveForm::begin(); ?>
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa  fa-tags"></i>
            </span>
            <span class="title">
                <a href="<?= Url::to( [ 'index' ] ) ?>"><?= Yii::t( 'backend', 'Categories' ) ?></a>
            </span>
            <span>/</span>
            <span class="title">
                <?= Yii::t( 'backend', 'Create' ) ?>
            </span>
        </h2>
        <div class="header-right">
            <div class="form-group">
				<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ), [
					'class'   => 'btn btn-primary pull-right'
				] ) ?>
            </div>
        </div>
    </div>
    <div id="wpbody-content" aria-label="Nội dung chính" tabindex="0" style="overflow: hidden;">
        <div class="wrap">
            <h1 class="wp-heading-inline">Thêm danh mục</h1>
            <hr class="wp-header-end">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content" style="position: relative;padding: 10px;background: #fff;">
                        <div id="titlediv">
                            <div id="titlewrap">
								<?= $form->field( $model, 'title' )->textInput( [
									'maxlength'   => true,
									'placeholder' => 'Nhập tiêu đề tại đây'
								] )->label( 'Tiêu đề' ) ?>
                            </div>
                            <div class="inside">
                                <div class="form-group">
									<?= $form->field( $model, 'content' )->textarea( [ 'id' => 'content' ] )->label( 'Nội dung' ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="postbox-container-1" class="postbox-container">
                        <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
                            <div id="submitdiv" class="postbox ">
                                <h2 class="hndle ui-sortable-handle">
                                    <span>Cài đặt</span>
                                </h2>
                                <div class="inside">
                                    <div class="submitbox" id="submitpost">
                                        <div id="minor-publishing">
                                            <div id="misc-publishing-actions">
                                                <div class="misc-pub-section">
                                                    <span>
                                                        <i class="fa fa-clone"></i> Kiểu trang
                                                    </span>
                                                    <div id="post-status-select" class="hide-if-js">
														<?= $form->field( $model, 'page_id' )->dropDownList(
															ArrayHelper::map( Page::find()->where( [
																'=',
																'released',
																1
															] )->all(), 'id', 'title' ),
															[
																'prompt' => '-- ' . Yii::t( 'backend', 'Chọn kiểu trang' ) . ' --',
															]
														)->label( false ) ?>
                                                    </div>
                                                </div>
                                                <div class="misc-pub-section">
                                                    <span>
                                                        <i class="fa fa-tags"></i> Danh mục cha
                                                    </span>
                                                    <div id="post-status-select" class="hide-if-js">
														<?= $form->field( $model, 'parent_id' )->dropDownList(
															ArrayHelper::map( Category::find()->where( [
																'=',
																'status',
																1
															] )->all(), 'id', 'title' ),
															[
																'prompt' => '-- ' . Yii::t( 'backend', 'Chọn danh mục cha' ) . ' --',
															]
														)->label( false ) ?>
                                                    </div>
                                                </div>
                                                <div class="misc-pub-section">
                                                    <div class="form-group">
														<?= $form->field( $model, 'status' )->checkbox( [ 'class' => 'minimal none-action' ] )->label( false ) ?>
                                                    </div>
                                                    <div class="form-group">
														<?= $form->field( $model, 'display_homepage' )->checkbox( [ 'class' => 'minimal none-action' ] )->label( false ) ?>
                                                    </div>
                                                    <div class="form-group">
														<?= $form->field( $model, 'featured' )->checkbox( [ 'class' => 'minimal none-action' ] )->label( false ) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="postimagediv" class="postbox ">
                                <h2 class="hndle ui-sortable-handle"><span>Ảnh đại diện</span></h2>
                                <div class="inside">
                                    <img style="width: 100%;<?= $model->avatar ? '' : 'display: none;' ?>"
                                         src="<?= $model->isNewRecord ? '' : $model->avatar ?>"
                                         class="fieldID attachment-266x266 size-266x266" alt="">
									<?= $form->field( $model, 'avatar' )->hiddenInput( [
										'id'    => 'fieldID',
										'value' => $model->avatar
									] )->label( false ) ?>
                                    <a href="/uploads/filemanager/dialog.php?type=1&field_id=fieldID&relative_url=1"
                                       style="<?= $model->avatar ? 'display: none;' : '' ?>"
                                       class="thumbnail-fieldID frame-btn">Đặt ảnh dại diện</a>
                                    <a href="javascript:void(0)" style="<?= $model->avatar ? '' : 'display: none;' ?>"
                                       class="remove-thumbnail-fieldID" onclick="remove_thumbnail('fieldID')">
                                        Xóa ảnh đại diện
                                    </a>
                                </div>
                            </div>
                            <div id="tagsdiv-post_tag" class="postbox ">
                                <h2 class="hndle ui-sortable-handle">
                                    <span>Công cụ SEO</span>
                                    <i style="color: #3c8dbc" class="fa fa-question-circle"></i>
                                </h2>
                                <div class="inside">
                                    <div class="tagsdiv" id="post_tag">
                                        <div class="jaxtag">
                                            <div class="form-group">
												<?= $form->field( $seo, 'seo_title' )->textInput() ?>
                                            </div>
                                            <div class="form-group">
												<?= $form->field( $seo, 'meta_keywords' )->textarea( [ 'rows' => 2 ] ) ?>
                                            </div>
                                            <p class="howto" id="new-tag-post_tag-desc">
                                                Phân cách các thẻ bằng dấu phẩy (,).
                                            </p>
                                            <div class="form-group">
												<?= $form->field( $seo, 'meta_description' )->textarea( [ 'rows' => 2 ] ) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form-group" style="margin-right: 10px;">
		<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ), [
			'class'   => 'btn btn-primary pull-right'
		] ) ?>
    </div>
	<?php ActiveForm::end(); ?>
</div>