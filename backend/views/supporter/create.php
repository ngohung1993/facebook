<?php

/* @var $this yii\web\View */
/* @var $model common\models\Supporter */

$this->title = Yii::t('backend', 'Create supporter');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Create supporter'); ?>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model
            ]) ?>
        </div>
    </div>
</section>