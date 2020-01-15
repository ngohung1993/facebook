<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $seo \common\models\SeoTool */
/* @var $images \common\models\Image */

$this->title = Yii::t('backend', 'Update product');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Update product'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?= Url::to('site/index') ?>">
                <i class="fa fa-home"></i>
                <?= Yii::t('backend', 'Home'); ?>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['product/index']) ?>">
                <?= Yii::t('backend', 'Products'); ?>
            </a>
        </li>
    </ol>
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