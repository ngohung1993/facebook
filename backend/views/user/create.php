<?php

/* @var $this yii\web\View */
/* @var $model common\models\SignupForm */
/* @var $auth_assignment \common\models\AuthAssignment */

$this->title = Yii::t('backend', 'Create user');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Create user'); ?>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model,
                'auth_assignment' => $auth_assignment
            ]) ?>
        </div>
    </div>
</section>