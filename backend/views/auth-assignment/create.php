<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\AuthAssignment */

$this->title = Yii::t('app', 'Create Auth Assignment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auth Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">
    <aside class="right-side">
        <section class="content-header">
            <ol class="breadcrumb">
                <li>
                    <a href="<?= Url::to(['site/index']) ?>">
                        <i class="fa fa-dashboard"></i>
                        <?= Yii::t('app', 'Trang chủ') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['auth-assignment/index']) ?>">
                        <?= Yii::t('app', 'Phân quyền') ?>
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
