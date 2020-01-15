<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap\ActiveForm;

$this->title = Yii::t('backend', 'Sign In');
?>

<div class="form-box" id="login-box">
    <div class="header"><?= Yii::t('backend', 'Sign In') ?></div>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="body bg-gray">
        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => Yii::t('backend', 'Username')])->label(Yii::t('backend', 'Username')) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('backend', 'Password')])->label(Yii::t('backend', 'Password')) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'rememberMe')->checkbox()->label(Yii::t('backend', 'Remember Me')) ?>
        </div>
    </div>
    <div class="footer">
        <button type="submit" class="btn bg-olive btn-block">
            <?= Yii::t('backend', 'Sign me in') ?>
        </button>
    </div>
    <?php ActiveForm::end(); ?>
</div>