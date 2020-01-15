<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->title;
?>

<section class="content-header">
    <h1>
        <?= Yii::t('backend', 'Manager page'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?= Url::to('site/index') ?>">
                <i class="fa fa-home"></i>
                Trang chủ
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['page/index']) ?>">
                Quản lý trang
            </a>
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <p>
                <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'slug',
                    'code',
                    'released',
                ],
            ]) ?>
        </div>
    </div>
</section>
