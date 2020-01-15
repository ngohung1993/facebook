<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\PhotoLocation */

$this->title = Yii::t('backend', 'Update photo location');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Update photo location'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?= Url::to('site/index') ?>">
                <i class="fa fa-home"></i>
                <?= Yii::t('backend', 'Home'); ?>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['photo-location/index']) ?>">
                <?= Yii::t('backend', 'Manager Photo Location'); ?>
            </a>
        </li>
    </ol>
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