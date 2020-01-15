<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\PhotoLocation */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="photo-location-form">
	<?php $form = ActiveForm::begin(); ?>
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-picture-o"></i>
            </span>
            <span class="title">
                <a href="<?= Url::to( [ 'index' ] ) ?>"><?= Yii::t( 'backend', 'Photo Locations' ) ?></a>
            </span>
            <span>/</span>
            <span class="title">
                <?= Yii::t( 'backend', 'Create' ) ?>
            </span>
        </h2>
        <div class="header-right">
            <div class="form-group">
				<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ), [ 'class' => 'btn btn-primary pull-right' ] ) ?>
            </div>
        </div>
    </div>
    <div id="wpbody-content" aria-label="Nội dung chính" tabindex="0" style="overflow: hidden;">
        <div class="wrap">
            <h1 class="wp-heading-inline">Thêm mới vị trí ảnh</h1>
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
									<?= $form->field( $model, 'key' )->textInput() ?>
                                </div>
                                <div class="form-group">
									<?= $form->field( $model, 'describe' )->textarea() ?>
                                </div>
                                <div class="form-group">
									<?= $form->field( $model, 'released' )->checkbox( [ 'class' => 'minimal none-action' ] )->label( false ) ?>
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
                                            <div id="misc-publishing-actions" style="min-height: 260px;">
                                                <div class="misc-pub-section">
                                                </div>
                                            </div>
                                            <div class="clear"></div>
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
		<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ), [ 'class' => 'btn btn-primary pull-right' ] ) ?>
    </div>
	<?php ActiveForm::end(); ?>
</div>