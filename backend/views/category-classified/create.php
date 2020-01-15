<?php

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $seo \common\models\SeoTool */

$this->title = Yii::t('backend', 'Create category classified');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Create category classified'); ?>
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