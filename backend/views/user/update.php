<?php

/* @var $this yii\web\View */
/* @var $model common\models\SignupForm */
/* @var $auth_assignment \common\models\AuthAssignment */

$this->title = Yii::t('backend', 'Update user');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Update user'); ?>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_update', [
                'model' => $model,
                'auth_assignment' => $auth_assignment
            ]) ?>
        </div>
    </div>
</section>