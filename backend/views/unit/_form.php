<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="page-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-wrench"></i>
            </span>
            <span class="title">
                <a href="<?= Url::to(['index']) ?>"><?= Yii::t('backend', 'Units') ?></a>
            </span>
            <span>/</span>
            <span class="title">
                <?= Yii::t('backend', 'Create') ?>
            </span>
        </h2>
        <div class="header-right">
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-check"></i> ' . Yii::t('backend', 'Submit'), ['class' => 'btn btn-primary pull-right']) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <h4>Thông tin cơ bản</h4>
            <p class="text-muted">Thêm thông tin cho đơn vị</p>
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        <?= Yii::t('backend', 'Basic information') ?>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label(Yii::t('backend', 'Title')) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'status')->checkbox(['class' => 'minimal none-action'])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" style="margin-right: 10px;">
        <?= Html::submitButton('<i class="fa fa-check"></i> ' . Yii::t('backend', 'Submit'), ['class' => 'btn btn-primary pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>