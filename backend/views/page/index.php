<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $pages common\models\Page */

$this->title = Yii::t( 'backend', 'Pages' );

?>

<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa-clone"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Pages' ) ?>
            </span>
        </h2>
        <div class="header-right">
            <div class="form-group">
				<?= Html::a( '<i class="fa fa-plus"></i> ' . Yii::t( 'backend', 'Create' ), [ 'create' ], [ 'class' => 'btn btn-primary pull-right' ] ) ?>
            </div>
        </div>
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
                            <th><?= Yii::t( 'backend', 'Released' ) ?></th>
                            <th><?= Yii::t( 'backend', 'Action' ) ?></th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ( $pages as $key => $value ): ?>
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
                                        <input data-id="<?= $value['id'] ?>" data-api="ajax/release" data-table="page"
                                               type="checkbox" <?= $value['released'] ? 'checked="checked"' : '' ?>
                                               title="" name="switch-checkbox">
                                    </div>
                                </td>
                                <td>
                                    <a href="<?= Url::to( [ 'page/update', 'id' => $value['id'] ] ) ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
									<?= Html::a( Yii::t( 'backend', '<i class="fa fa-trash-o"></i>' ), [
										'delete',
										'id' => $value->id
									], [
										'data' => [
											'confirm' => Yii::t( 'backend', 'Are you sure you want to delete this item?' ),
											'method'  => 'post',
										],
									] ) ?>
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