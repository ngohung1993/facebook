<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model common\models\AuthItemChild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-child-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">
                            <?= Yii::t('app', 'Thông tin cơ bản') ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for=""><?= Yii::t('app', 'Tên nhóm quyền') ?></label>
                            <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                        <div class="form-group">
                            <label for=""><?= Yii::t('app', 'Tên quyền') ?></label>
                            <select title="" multiple="multiple" size="10" name="duallistbox_demo1[]" class="hide">
                                <?php foreach (AuthItem::find()->where(['=', 'type', '2'])->all() as $key => $value): ?>
                                    <option value="<?= $value['name'] ?>"><?= $value['description'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'list_permission')->hiddenInput(['id' => 'list-permission'])->label(false) ?>
                    <?= Html::submitButton(Yii::t('app', '<i class="fa fa-check"></i>Xác nhận'), ['class' => 'btn btn-success', 'onclick' => 'get_list_permission()']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
