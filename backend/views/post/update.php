<?php

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $seo \common\models\SeoTool */
/* @var $images \common\models\Image */

$this->title = Yii::t('backend', 'Update post');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Update post'); ?>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_form', [
                'model' => $model,
                'seo' => $seo,
                'images' => $images,
                'tabs'=>$tabs
            ]) ?>
        </div>
    </div>
</section>