<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $settings common\models\Setting */
/* @var $user common\models\User */

$this->title = Yii::t( 'backend', 'Settings' );

?>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-cog"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Settings' ) ?>
            </span>
        </h2>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="padding-left: 15px;">
                                <input title="" type="checkbox" class="minimal">
                            </th>
                            <th>STT</th>
                            <th><?= Yii::t( 'backend', 'Title' ) ?></th>
                            <th><?= Yii::t( 'backend', 'Key' ) ?></th>
                            <th><?= Yii::t( 'backend', 'Trạng thái' ) ?></th>
                            <th><?= Yii::t( 'backend', 'Action' ) ?></th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ( $settings as $key => $value ): ?>
                            <tr>
                                <td style="padding-left: 15px;">
                                    <input title="" data-id="<?= $value['id'] ?>" type="checkbox" class="minimal">
                                </td>
                                <td>
									<?= $key + 1 ?>
                                </td>
                                <td>
									<?= $value['title'] ?>
                                </td>
                                <td>
									<?= $value['key'] ?>
                                </td>
                                <td>
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini"
                                         style="border:none">
                                        <input data-id="<?= $value['id'] ?>" data-api="ajax/enable-column"
                                               data-table="setting" data-column="status"
                                               type="checkbox" <?= $value['status'] ? 'checked="checked"' : '' ?>
                                               title="" name="switch-checkbox">
                                    </div>
                                </td>
                                <td>
                                    <a href="<?= Url::to( [ 'setting/update', 'id' => $value['id'] ] ) ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
						<?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>