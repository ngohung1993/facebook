<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GeneralInformation */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">
	<?php $form = ActiveForm::begin(); ?>
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-sliders"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'General information' ) ?>
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
            <h1 class="wp-heading-inline">Tùy chọn tổng quan</h1>
            <hr class="wp-header-end">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content" style="position: relative;padding: 10px;background: #fff;min-height: 296px;">
                        <div id="titlediv">
                            <div id="titlewrap">
								<?= $form->field( $model, 'site_name' )->textInput( [
									'maxlength'   => true,
									'placeholder' => 'Nhập tiêu đề tại đây'
								] )->label( 'Tiêu đề' ) ?>
                            </div>
                            <div class="inside">
                                <div class="form-group">
									<?= $form->field( $model, 'home_page_header' )->textInput()->label( Yii::t( 'backend', 'Home Page Header' ) ) ?>
                                </div>
                                <div class="form-group">
									<?= $form->field( $model, 'home_page_description' )->textarea( [
										'rows' => 2
									] )->label( Yii::t( 'backend', 'Home Page Description' ) ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="postbox-container-1" class="postbox-container">
                        <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
                            <div id="submitdiv" class="postbox ">
                                <h2 class="hndle ui-sortable-handle">
                                    <span>Thông tin liên hệ</span>
                                </h2>
                                <div class="inside">
                                    <div class="submitbox" id="submitpost">
                                        <div id="minor-publishing">
                                            <div id="misc-publishing-actions">
                                                <div class="misc-pub-section">
                                                    <div class="form-group">
														<?= $form->field( $model, 'email_notify' )->textInput(); ?>
                                                    </div>
                                                    <div class="form-group">
														<?= $form->field( $model, 'phone' )->textInput(); ?>
                                                    </div>
                                                    <div class="form-group">
														<?= $form->field( $model, 'address' )->textarea(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="postimagediv" class="postbox ">
                                <h2 class="hndle ui-sortable-handle"><span>Logo</span></h2>
                                <div class="inside">
                                    <img style="width: 100%;<?= $model->logo ? '' : 'display: none;' ?>"
                                         src="<?= $model->isNewRecord ? '' : $model->logo ?>"
                                         class="fieldID attachment-266x266 size-266x266" alt="">
									<?= $form->field( $model, 'logo' )->hiddenInput( [
										'id'    => 'fieldID',
										'value' => $model->logo
									] )->label( false ) ?>
                                    <a href="/uploads/filemanager/dialog.php?type=1&field_id=fieldID&relative_url=1"
                                       style="<?= $model->logo ? 'display: none;' : '' ?>"
                                       class="thumbnail-fieldID frame-btn">Đặt logo</a>
                                    <a href="javascript:void(0)" style="<?= $model->logo ? '' : 'display: none;' ?>"
                                       class="remove-thumbnail-fieldID" onclick="remove_thumbnail('fieldID')">
                                        Xóa logo
                                    </a>
                                </div>
                            </div>
                            <div id="postimagediv" class="postbox ">
                                <h2 class="hndle ui-sortable-handle"><span>Favicon</span></h2>
                                <div class="inside">
                                    <img style="width: 100%;<?= $model->favicon ? '' : 'display: none;' ?>"
                                         src="<?= $model->isNewRecord ? '' : $model->favicon ?>"
                                         class="fieldFavicon attachment-266x266 size-266x266" alt="">
									<?= $form->field( $model, 'favicon' )->hiddenInput( [
										'id'    => 'fieldFavicon',
										'value' => $model->favicon
									] )->label( false ) ?>
                                    <a href="/uploads/filemanager/dialog.php?type=1&field_id=fieldFavicon&relative_url=1"
                                       style="<?= $model->favicon ? 'display: none;' : '' ?>"
                                       class="thumbnail-fieldFavicon frame-btn">Đặt favicon</a>
                                    <a href="javascript:void(0)" style="<?= $model->favicon ? '' : 'display: none;' ?>"
                                       class="remove-thumbnail-fieldFavicon" onclick="remove_thumbnail('fieldFavicon')">
                                        Xóa favicon
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="post-body-content" style="position: relative;padding: 10px;background: #fff;">
                        <div id="titlediv">
                            <div class="inside">
                                <div class="form-group">
                                    <label for="">Google Analytics</label>
									<?= $form->field( $model, 'google_analytics' )->textarea( [
										'rows'        => 3,
										'placeholder' => 'Nhập mã Google Analytics tại đây'
									] )->label( false ) ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Facebook pixel</label>
									<?= $form->field( $model, 'facebook_pixel' )->textarea( [
										'rows'        => 3,
										'placeholder' => 'Nhập Facebook Pixcel ID tại đây'
									] )->label( false ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="post-body-content" style="position: relative;padding: 10px;background: #fff;">
                        <div id="titlediv">
                            <div class="inside">
                                <div class="form-group">
                                    <label for="">Page facebook</label>
									<?= $form->field( $model, 'page_facebook' )->textInput( [
										'placeholder' => 'Trang fanpage facebook'
									] )->label( false ) ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Video giới thiệu</label>
									<?= $form->field( $model, 'video_intro' )->textInput( [
										'placeholder' => 'Đường dẫn video youtube'
									] )->label( false ) ?>
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
    <div class="form-group" style="margin-right: 12px;">
		<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ), [
			'class'   => 'btn btn-primary pull-right'
		] ) ?>
    </div>
	<?php ActiveForm::end(); ?>
</div>