<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Classifieds */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Classifieds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classifieds-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'avatar',
            'seo_tool_id',
            'category_id',
            'slug',
            'describe:ntext',
            'content:ntext',
            'views',
            'price',
            'province_id',
            'district_id',
            'start_date',
            'expiration_date',
            'status',
            'user_id',
            'email:email',
            'phone',
            'mobile',
            'address',
            'contacts',
            'contact_name',
            'images:ntext',
        ],
    ]) ?>

</div>
