<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MetaLocation;

/* @var $this yii\web\View */
/* @var $model common\models\MetaLocation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
	<?php $form = ActiveForm::begin(); ?>
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-code"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Chèn mã javascript và meta' ) ?>
            </span>
        </h2>
        <div class="header-right">
            <div class="form-group">
				<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ), [
					'class' => 'btn btn-primary pull-right'
				] ) ?>
            </div>
        </div>
    </div>
    <div id="wpbody-content" aria-label="Nội dung chính" tabindex="0" style="overflow: hidden;">
        <div class="wrap">
            <h1 class="wp-heading-inline" style="margin-left: 20px">Chèn mã javascript và meta</h1>
            <hr class="wp-header-end">
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content"
                         style="position: relative;width: 96%; margin-left:20px; padding: 20px;background: #fff;min-height: 296px;">
                        <div id="titlediv">
                            <div id="titlewrap">
								<?= $form->field( $model, 'meta_location_id' )->dropDownList(
									ArrayHelper::map( MetaLocation::find()->all(), 'id', 'title' )
								)->label( 'Chọn vị trí đặt' ) ?>
                            </div>
                            <div class="clear"></div>
                            <div class="inside">
                                <div class="form-group">
									<?= $form->field( $model, 'content' )->textarea( [
										'rows' => 4
									] )->label( Yii::t( 'backend', 'Nội dung' ) ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="postbox-container-1" class="postbox-container">
                        <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
                            <div id="submitdiv" class="postbox " style="height: 297px; margin-right: 10px">
                                <h2 class="hndle ui-sortable-handle">
                                    <span>Hướng dẫn</span>
                                </h2>
                                <div class="inside">
                                    <div class="submitbox" id="submitpost">
                                        <div id="minor-publishing">
                                            <div id="misc-publishing-actions">
                                                <div class="misc-pub-section">
                                                    <div class="form-group">
                                                        <p><b>Bạn có thể chọn các vị trí đặt thẻ meta như sau:</b></p>
                                                        <p>- Thẻ mở head</p>
                                                        <p>- Trước thẻ đóng head</p>
                                                        <p>- Sau thẻ mở body</p>
                                                        <p>- Trước thẻ đóng body.</p>
                                                    </div>

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
    <div class="form-group" style="margin-right: 12px;">
		<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ), [
			'class' => 'btn btn-primary pull-right'
		] ) ?>
    </div>
	<?php ActiveForm::end(); ?>
</div>
