<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('backend', 'Update page');
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Update page'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?= Url::to('site/index') ?>">
                <i class="fa fa-home"></i>
                <?= Yii::t('backend', 'Home'); ?>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['page/index']) ?>">
                <?= Yii::t('backend', 'Manager page'); ?>
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