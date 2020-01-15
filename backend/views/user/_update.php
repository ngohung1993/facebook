<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model common\models\SignupForm */
/* @var $auth_assignment \common\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-cog"></i>
            </span>
            <span class="title">
                <?= Yii::t('backend', 'Users') ?>
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
                    <h3 class="box-title">
                        <?= Yii::t('app', 'Basic information') ?>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group" style="width: 49%;float: left;margin-right: 6px;margin-bottom: 0;">
                            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group" style="width: 49%;float: left;margin-bottom: 0;">
                            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Phân quyền</label>
                            <select title="" multiple="multiple" size="10" name="duallistbox_demo1[]"
                                    class="hide">
                                <?php foreach (AuthItem::find()->where(['=', 'type', '2'])->all() as $key => $value): ?>
                                    <?php if (in_array($value['name'], json_decode($auth_assignment->list_permission))): ?>
                                        <option selected="selected"
                                                value="<?= $value['name'] ?>"><?= $value['description'] ?></option>
                                    <?php endif; ?>
                                    <?php if (!in_array($value['name'], json_decode($auth_assignment->list_permission))): ?>
                                        <option value="<?= $value['name'] ?>"><?= $value['description'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" style="margin-right: 10px;">
        <?= $form->field($auth_assignment, 'list_permission')->hiddenInput(['id' => 'list-permission'])->label(false) ?>
        <?= Html::submitButton('<i class="fa fa-check"></i> ' . Yii::t('app', 'Submit'), ['class' => 'btn btn-primary pull-right', 'onclick' => 'get_list_permission()']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>