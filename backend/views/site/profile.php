<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 4/21/2018
 * Time: 11:43 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\SiteAsset;

SiteAsset::register( $this );

/* @var $this yii\web\View */
/* @var $model common\models\SignupForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t( 'backend', 'Profile' );

?>

<section class="content-header">
</section>
<section class="content" style="margin-top: 30px;">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">
						Thông tin cơ bản
					</h3>
				</div>
				<div class="box-body">
					<div class="profile-form">
						<?php $form = ActiveForm::begin(); ?>
						<div class="page-heading page-heading-md">
							<h2 class="header__main">
			            <span class="breadcrumb hidden-xs">
			                <i class="fa fa-user"></i>
			            </span>
								<span class="title">
			                <?= Yii::t( 'backend', 'Cập nhật thông tin' ) ?>
			            </span>
							</h2>
							<div class="header-right">
								<div class="form-group">
									<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ), [ 'class' => 'btn btn-primary pull-right' ] ) ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<?= $form->field( $model, 'username' )->textInput( [
										'maxlength' => true,
										'disabled'  => 'disabled'
									] ) ?>
								</div>
								<div class="form-group" style="width: 49%;float: left;margin-right: 6px;">
									<?= $form->field( $model, 'first_name' )->textInput( [ 'maxlength' => true ] ) ?>
								</div>
								<div class="form-group" style="width: 49%;float: left">
									<?= $form->field( $model, 'last_name' )->textInput( [ 'maxlength' => true ] ) ?>
								</div>
								<div class="form-group">
									<?= $form->field( $model, 'phone' )->textInput( [ 'maxlength' => true ] ) ?>
								</div>
								<div class="form-group">
									<?= $form->field( $model, 'address' )->textarea( [ 'rows' => 2 ] ) ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<?= $form->field( $model, 'email' )->textInput( [
										'maxlength' => true,
										'disabled'  => 'disabled'
									] ) ?>
								</div>
								<div class="form-group" style="position: relative;">
									<label for=""><?= Yii::t( 'app', 'Ảnh đại diện' ) ?></label>
									<div class="img-upload">
										<img style="width: 217px;height: 167px;"
										     src="<?= $model['avatar'] ? $model['avatar'] : '/uploads/core/images/avatar5.png' ?>">
									</div>
									<?= $form->field( $model, 'avatar' )->hiddenInput( [
										'maxlength' => true,
										'id'        => 'avatar',
										'value'     => $model['avatar'] ? $model['avatar'] : '/uploads/core/images/avatar5.png'
									] )->label( false ) ?>
									<button style="position: absolute;bottom: 10px;left: 10px;" type="button"
									        class="btn btn-primary">
										<i class="fa fa-picture-o"></i>
									</button>
								</div>
								<button type="button" class="btn btn-primary" data-toggle="modal"
								        data-target="#compose-modal">
									<i class="fa fa-key"></i>
									Đổi mật khẩu
								</button>
							</div>
						</div>
						<div class="form-group" style="margin-right: 10px;">
							<?= Html::submitButton( '<i class="fa fa-check"></i> ' . Yii::t( 'backend', 'Submit' ), [ 'class' => 'btn btn-primary pull-right' ] ) ?>
						</div>
						<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">
					<i style="margin-right: 5px;" class="fa fa-repeat"></i>
					Đổi mật khẩu
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for=""><?= Yii::t( 'app', 'Mật khẩu cũ' ) ?></label>
							<input title="" type="password" id="password" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for=""><?= Yii::t( 'app', 'Mật khẩu mới' ) ?></label>
							<input title="" type="password" id="new-password" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for=""><?= Yii::t( 'app', 'Nhập lại mật khẩu' ) ?></label>
							<input title="" type="password" id="re-password" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer clearfix">
				<input type="hidden" title="" id="id-user">
				<button onclick="change_password()" type="button" class="btn btn-primary pull-left">
					<i class="fa fa-plus"></i>
					Xác nhận
				</button>
			</div>
		</div>
	</div>
</div>

<style>
	.opacity {
		background-color: #ababab;
		opacity: 0.5;
		display: none;
	}
</style>

<div id="loader" class="opacity loader">
	<div class="loader-inner ball-scale-ripple-multiple vh-center">
		<div></div>
		<div></div>
		<div></div>
	</div>
</div>

