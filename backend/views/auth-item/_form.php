<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-ban"></i>
            </span>
            <span class="title">
                <a href="<?= Url::to(['index']) ?>"><?= Yii::t('backend', 'Permissions') ?></a>
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
        <div class="col-md-4 col-lg-3">
            <h4>Thông tin quyền truy cập</h4>
            <p class="text-muted">Nhập tên và các mô tả cho quyền truy cập</p>
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        <?= Yii::t('app', 'Basic information') ?>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for=""><?= Yii::t('app', 'Đường dẫn') ?></label>
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'type')->dropDownList(['1' => 'Nhóm quyền', '2' => 'Quyền']) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" style="margin-right: 10px;">
        <?= Html::submitButton('<i class="fa fa-check"></i> ' . Yii::t('app', 'Submit'), ['class' => 'btn btn-primary pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
