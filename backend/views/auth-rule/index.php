<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\base\AuthRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Auth Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-rule-index">
    <aside class="right-side">
    <section class="content-header" style="margin:23px;">
        <h1>
            Rules
            <small>List</small>
        </h1>

    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">

                        <h3 class="box-title"></h3>

                        <div class="pull-right">
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#filter-modal"><i class="fa fa-filter"></i>&nbsp;&nbsp;Filter</a>
                                <a href="http://laravel-admin.org/demo/auth/roles?_pjax=%23pjax-container" class="btn btn-sm btn-facebook"><i class="fa fa-undo"></i>&nbsp;&nbsp;Reset</a>
                            </div>

                            <div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Filter</h4>
                                        </div>
                                        <form action="http://laravel-admin.org/demo/auth/roles?_pjax=%23pjax-container" method="get" pjax-container="">
                                            <div class="modal-body">
                                                <div class="form">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label>ID</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-pencil"></i>
                                                                </div>
                                                                <input type="text" class="form-control id" placeholder="ID" name="id" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary submit">Submit</button>
                                                <button type="reset" class="btn btn-warning pull-left">Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a class="btn btn-sm btn-twitter"><i class="fa fa-download"></i> Export</a>
                                <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/demo/auth/roles?_pjax=%23pjax-container&amp;_export_=all" target="_blank">All</a></li>
                                    <li><a href="/demo/auth/roles?_pjax=%23pjax-container&amp;_export_=page%3A1" target="_blank">Current page</a></li>
                                    <li><a href="/demo/auth/roles?_pjax=%23pjax-container&amp;_export_=selected%3A__rows__" target="_blank" class="export-selected">Selected rows</a></li>
                                </ul>
                            </div>
                            &nbsp;&nbsp;


                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a href="<?= Url::to(['auth-rule/create']) ?>" class="btn btn-sm btn-success">
                                    <i class="fa fa-save"></i>&nbsp;&nbsp;New
                                </a>
                            </div>

                        </div>

                        <span>
             <a class="btn btn-sm btn-primary grid-refresh"><i class="fa fa-refresh"></i> Refresh</a>
        </span>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody><tr>
                                <th> </th>
                                <th>ID<a class="fa fa-fw fa-sort" href="http://laravel-admin.org/demo/auth/roles?_pjax=%23pjax-container&amp;_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc"></a>
                                </th>
                                <th>Slug</th>
                                <th>Name</th>
                                <th>Permission</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="grid-row-checkbox" data-id="1" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    administrator
                                </td>
                                <td>
                                    Administrator
                                </td>
                                <td>
                                    <span class="label label-success">All permission</span>
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <a href="/demo/auth/roles/1/edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                    <div class="box-footer clearfix">
                        Showing <b>1</b> to <b>1</b> of <b>1</b> entries<ul class="pagination pagination-sm no-margin pull-right">
                            <!-- Previous Page Link --><li class="page-item disabled"><span class="page-link">«</span></li>

                            <!-- Pagination Elements -->
                            <!-- "Three Dots" Separator -->

                            <!-- Array Of Links -->
                            <li class="page-item active"><span class="page-link">1</span></li>

                            <!-- Next Page Link -->
                            <li class="page-item disabled"><span class="page-link">»</span></li>
                        </ul>
                        <label class="control-label pull-right" style="margin-right: 10px; font-weight: 100;">

                            <small>Show</small>&nbsp;
                            <select class="input-sm grid-per-pager" name="per-page"><option value="http://laravel-admin.org/demo/auth/roles?_pjax=%23pjax-container&amp;per_page=10">10</option>
                                <option value="http://laravel-admin.org/demo/auth/roles?_pjax=%23pjax-container&amp;per_page=20" selected="">20</option>
                                <option value="http://laravel-admin.org/demo/auth/roles?_pjax=%23pjax-container&amp;per_page=30">30</option>
                                <option value="http://laravel-admin.org/demo/auth/roles?_pjax=%23pjax-container&amp;per_page=50">50</option>
                                <option value="http://laravel-admin.org/demo/auth/roles?_pjax=%23pjax-container&amp;per_page=100">100</option></select>
                            &nbsp;<small>entries</small>
                        </label>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div></div>

    </section>
    </aside>
</div>
