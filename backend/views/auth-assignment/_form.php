<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model common\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        <?= Yii::t('app', 'Thông tin cơ bản') ?>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for=""><?= Yii::t('app', 'User') ?></label>
                        <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'))->label(false) ?>
                    </div>
                    <label for=""><?= Yii::t('app', 'Tên quyền') ?></label>
                    <select title="" multiple="multiple" size="10" name="duallistbox_demo1[]" class="hide">
                        <?php foreach (AuthItem::find()->where(['=', 'type', '2'])->all() as $key => $value): ?>
                            <option value="<?= $value['name'] ?>"><?= $value['description'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'list_permission')->hiddenInput(['id' => 'list-permission'])->label(false) ?>
        <?= Html::submitButton(Yii::t('app', '<i class="fa fa-check"></i>Xác nhận'), ['class' => 'btn btn-success pull-right', 'onclick' => 'get_list_permission()']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>