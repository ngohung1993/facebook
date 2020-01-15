<?php

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $seo \common\models\SeoTool */

$this->title = Yii::t('backend', 'Create post');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Create post'); ?>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model,
                'seo' => $seo
            ]) ?>
        </div>
    </div>
</section>