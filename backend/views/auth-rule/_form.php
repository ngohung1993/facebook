<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AuthRule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-rule-form">
    <section class="content-header"><h1>
            Roles
            <small>Create</small>
        </h1>

    </section>
    <section class="content"><div class="row"><div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create</h3>

                        <div class="box-tools">
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a href="http://laravel-admin.org/demo/auth/roles" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;List</a>
                            </div> <div class="btn-group pull-right" style="margin-right: 10px">
                                <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="http://laravel-admin.org/demo/auth/roles" method="post" accept-charset="UTF-8" class="form-horizontal" pjax-container="">

                        <div class="box-body">

                            <div class="fields-group">

                                <div class="form-group  ">

                                    <label for="slug" class="col-sm-2 control-label">Slug</label>

                                    <div class="col-sm-8">


                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                            <input type="text" id="slug" name="slug" value="" class="form-control slug" placeholder="Input Slug">
                                        </div>


                                    </div>
                                </div>
                                <div class="form-group  ">

                                    <label for="name" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-8">


                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                            <input type="text" id="name" name="name" value="" class="form-control name" placeholder="Input Name">
                                        </div>


                                    </div>
                                </div>
                                <div class="form-group  ">

                                    <label for="permissions" class="col-sm-2 control-label">Permissions</label>

                                    <div class="col-sm-8">


                                        <div class="bootstrap-duallistbox-container row moveonselect"> <div class="box1 col-md-6">   <label for="bootstrap-duallistbox-nonselected-list_permissions[]" style="display: none;"></label>   <span class="info-container">     <span class="info">Showing all 12</span>     <button type="button" class="btn clear1 pull-right btn-default btn-xs">Show all</button>   </span>   <input class="filter form-control" type="text" placeholder="Filter">   <div class="btn-group buttons">     <button type="button" class="btn moveall btn-default" title="Move all">       <i class="glyphicon glyphicon-arrow-right"></i>       <i class="glyphicon glyphicon-arrow-right"></i>     </button>     <button type="button" class="btn move btn-default" title="Move selected">       <i class="glyphicon glyphicon-arrow-right"></i>     </button>   </div>   <select multiple="multiple" id="bootstrap-duallistbox-nonselected-list_permissions[]" class="form-control" name="permissions[]_helper1" style="height: 102px;"><option value="1">All permission</option><option value="2">Dashboard</option><option value="3">Login</option><option value="4">User setting</option><option value="5">Auth management</option><option value="6">Admin Config</option><option value="7">Scheduling</option><option value="8">Logs</option><option value="9">Api tester</option><option value="10">Media manager</option><option value="11">Admin helpers</option><option value="12">Exceptions reporter</option></select> </div> <div class="box2 col-md-6">   <label for="bootstrap-duallistbox-selected-list_permissions[]" style="display: none;"></label>   <span class="info-container">     <span class="info">Empty list</span>     <button type="button" class="btn clear2 pull-right btn-default btn-xs">Show all</button>   </span>   <input class="filter form-control" type="text" placeholder="Filter">   <div class="btn-group buttons">     <button type="button" class="btn remove btn-default" title="Remove selected">       <i class="glyphicon glyphicon-arrow-left"></i>     </button>     <button type="button" class="btn removeall btn-default" title="Remove all">       <i class="glyphicon glyphicon-arrow-left"></i>       <i class="glyphicon glyphicon-arrow-left"></i>     </button>   </div>   <select multiple="multiple" id="bootstrap-duallistbox-selected-list_permissions[]" class="form-control" name="permissions[]_helper2" style="height: 102px;"></select> </div></div><select class="form-control permissions" style="width: 100%; display: none;" name="permissions[]" multiple="" data-placeholder="Input Permissions"><option value="1">All permission</option>
                                            <option value="2">Dashboard</option>
                                            <option value="3">Login</option>
                                            <option value="4">User setting</option>
                                            <option value="5">Auth management</option>
                                            <option value="6">Admin Config</option>
                                            <option value="7">Scheduling</option>
                                            <option value="8">Logs</option>
                                            <option value="9">Api tester</option>
                                            <option value="10">Media manager</option>
                                            <option value="11">Admin helpers</option>
                                            <option value="12">Exceptions reporter</option></select><input type="hidden" name="permissions[]">
                                    </div>
                                </div>



                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                            <input type="hidden" name="_token" value="LAWNt8OtZsWoewTA2wqJRIhlC7qzjkYsCCZX5a9N"><div class="col-md-2">

                            </div>
                            <div class="col-md-8">

                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Submit">Submit</button>
                                </div>

                                <div class="btn-group pull-left">
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                </div>

                            </div>

                        </div>

                        <input type="hidden" name="_previous_" value="http://laravel-admin.org/demo/auth/roles" class="_previous_"><!-- /.box-footer -->
                    </form>
                </div>

            </div></div>

    </section>
<!--    --><?php //$form = ActiveForm::begin(); ?>
<!---->
<!--    --><?//= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'data')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>
<!---->
<!--    <div class="form-group">-->
<!--        --><?//= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
<!--    </div>-->
<!---->
<!--    --><?php //ActiveForm::end(); ?>

</div>
