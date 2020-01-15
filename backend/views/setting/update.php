<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $images common\models\Image */

$this->title = Yii::t('backend', 'Update setting');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Update setting'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?= Url::to('site/index') ?>">
                <i class="fa fa-home"></i>
                <?= Yii::t('backend', 'Home'); ?>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['setting/index']) ?>">
                <?= Yii::t('backend', 'Manager setting'); ?>
            </a>
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_update', [
                'model' => $model,
                'images' => $images,
                'tabs'=>$tabs
            ]) ?>
        </div>
    </div>
</section>