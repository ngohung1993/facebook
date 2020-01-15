<?php

use yii\helpers\Html;
use  yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\AuthItemChild */

$this->title = Yii::t('app', 'Create Auth Item Child');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auth Item Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-create">

    <aside class="right-side">
        <section class="content-header" style="margin-top: 25px;">
            <h1>
                <?= Yii::t('app', 'Thêm mới nhóm quyền') ?>
                <small>Roles</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= Url::to(['site/index']) ?>">
                        <i class="fa fa-dashboard"></i>
                        <?= Yii::t('app', 'Trang chủ') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['auth-item-child/index']) ?>">
                        <?= Yii::t('app', 'Nhóm quyền') ?>
                    </a>
                </li>
            </ol>
        </section>

        <section class="content">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </section>
    </aside>
</div>
