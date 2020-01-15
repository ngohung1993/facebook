<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-type-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => true ] ) ?>

	<?= $form->field( $model, 'rank' )->textInput() ?>

	<?= $form->field( $model, 'price' )->textInput() ?>

    <div class="form-group">
		<?= Html::submitButton( Yii::t( 'backend', 'Save' ), [ 'class' => 'btn btn-success' ] ) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
