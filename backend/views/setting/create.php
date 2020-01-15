<?php

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('backend', 'Create setting');
?>

<section class="content-header">
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model
            ]) ?>
        </div>
    </div>
</section>