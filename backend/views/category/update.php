<?php

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $seo \common\models\SeoTool */
/* @var $images \common\models\Image */

$this->title = Yii::t('backend', 'Update category');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Update category'); ?>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model,
                'seo' => $seo,
                'images' => $images
            ]) ?>
        </div>
    </div>
</section>