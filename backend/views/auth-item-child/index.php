<?php

use yii\helpers\Url;
use common\models\AuthItemChild;

/* @var $this yii\web\View */
/* @var $items common\models\AuthItemChild */

$this->title = Yii::t('app', 'Quản lý nhóm quyền');
?>
<div class="auth-item-child-index">

    <aside class="right-side">
        <section class="content-header" style="margin-top: 25px;">
            <h1>
                <?= Yii::t('app', 'Quản lý nhóm quyền') ?>
                <small>Roles</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i><?= Yii::t('app', 'Trang chủ') ?></a></li>
                <li class="active"><?= Yii::t('app', 'Quản lý nhóm quyền') ?></li>
            </ol>
        </section>
        <section class="content" style="border-top: 1px solid #dbdbdb">
            <div class="row">
                <div class="col-xs-12">
                    <p>
                        <a href="<?= Url::to(['create']) ?>" class="btn btn-success">
                            <i style="margin-right: 5px;" class="fa fa-plus"></i>
                            Thêm mới
                        </a>
                    </p>
                    <table class="table table-bordered table-striped" style="background: #fff;">
                        <thead>
                        <tr>
                            <th style="width: 30px;"><?= Yii::t('app', 'TT') ?></th>
                            <th><?= Yii::t('app', 'Nhóm quyền') ?></th>
                            <th><?= Yii::t('app', 'Quyền') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $key => $value): ?>
                            <tr class="tr-<?= $value['name'] ?>">
                                <td><?= $key + 1 ?></td>
                                <td>
                                    <?= $value['description'] ?>
                                </td>
                                <td>
                                    <?php foreach (AuthItemChild::find()->where(['=', 'parent',$value['name']])->asArray()->all() as $key_child => $value_child): ?>
                                        <small class="badge bg-green">
                                            <?= $value_child['child'] ?>
                                        </small>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </aside>
</div>
