<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\MetaLocation;
/* @var $this yii\web\View */
/* @var $metas common\models\Meta */
/* @var $dataProvider yii\data\ActiveDataProvider */
function finLocation($id){
    return MetaLocation::findOne($id)['title'];
}
$this->title = Yii::t('app', 'Metas');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <div class="page-heading page-heading-md">
        <h2 class="header__main">
            <span class="breadcrumb hidden-xs">
                <i class="fa fa fa-thumb-tack"></i>
            </span>
            <span class="title">
                <?= Yii::t( 'backend', 'Vị trí thẻ script </>' ) ?>
            </span>
        </h2>
    </div>
</section>
<section class="content" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="tablenav top">
                        <div class="tablenav-pages one-page">
                            <div class="pull-right">
                                <div class="btn-group pull-right" style="margin-right: 10px">
                                    <a href="<?= Url::to( [ 'meta/create' ] ) ?>" class="btn btn-success">
                                        <i class="fa fa-plus"></i> <?= Yii::t( 'backend', 'New' ) ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br class="clear">
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="wp-list-table widefat fixed striped posts">
                        <thead>
                        <tr>
                            <td class="manage-column column-cb check-column">
                                <input title="" id="cb-select-all" type="checkbox">
                            </td>
                            <th scope="col">
                                <span>Vị trí đặt</span>
                            </th>
                            <th scope="col">
                                Nội dung
                            </th>
                        </tr>
                        </thead>
                        <tbody id="the-list">
                        <?php foreach ( $metas as $key => $value ): ?>
                            <tr id="post-<?= $value['id'] ?>"
                                class="iedit author-self level-0 type-post status-publish format-standard has-post-thumbnail hentry category-events category-health category-receipes category-travel">
                                <th scope="row" class="check-column">
                                    <input title="" type="checkbox">
                                </th>
                                <td>
                                    <div class="locked-info"><span class="locked-avatar"></span>
                                        <span class="locked-text"></span>
                                    </div>
                                    <strong>
                                        <a class="row-title" href="">
                                            <?= finLocation($value['meta_location_id'])?>
                                        </a>
                                    </strong>
                                    <div class="row-actions">
                                    <span class="edit">
                                        <a href="<?= Url::to( [
                                            'meta/update',
                                            'id' => $value['id']
                                        ] ) ?>">Chỉnh sửa</a> |
                                    </span>
                                        <span class="view">
                                        <?= Html::a( Yii::t( 'backend', 'Xóa' ), [
                                            'delete',
                                            'id' => $value->id
                                        ], [
                                            'data' => [
                                                'confirm' => Yii::t( 'backend', 'Are you sure you want to delete this item?' ),
                                                'method'  => 'post',
                                            ],
                                        ] ) ?>
                                    </span>
                                    </div>
                                </td>
                                <td>
                                    <?= $value['content'] ?>
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