<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    权限管理
                </h2>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <form role="form" class="form-horizontal" method="POST" action="<?=base_url('admin/permissions/addAction')?>" id="permission_mng_frm">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" style="margin-left: 0; margin-right: 0;">
                                    <label>页面名称</label>
                                    <input class="form-control" placeholder="请输入页面名称" id="nom" name="nom">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group"style="margin-left: 0; margin-right: 0;">
                                    <label>模块名称</label>
                                    <input class="form-control" placeholder="请输入模块名称" id="ctrl" name="ctrl">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group"style="margin-left: 0; margin-right: 0;">
                                    <label>控件名称</label>
                                    <input class="form-control" placeholder="请输入控件名称" id="ssctrl" name="ssctrl">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">创建</button>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">

                <div class="panel-heading">
                    权限列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-bordered table-condensed" style="background-color:white">
                        <thead>
                        <tr>
                            <th>页面名称</th>
                            <?php foreach ($groups as $group) { ?>
                                <th><?php echo $group->description; ?></th>
                            <?php } ?>
                            <!--<th>Public</th>-->
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($actions as $action) { ?>
                            <tr>
                                <td>
                                    <?php echo $action->description; ?><br/>
                                    <i><?php echo $action->path; ?></i>
                                </td>
                                <?php
                                foreach ($groups as $group) { ?>
                                    <td align="center">
                                        <?php
                                        $check = "";
                                        if( isset($action->groups[$group->id]) ){
                                            $check = "checked";
                                        }
                                        ?>
                                        <input type="checkbox" name="droit" value="1" data-group="<?php echo $group->id?>" data-action="<?php echo $action->id?>" class="droit" <?php echo $check?>/>
                                    </td>
                                <?php } ?>
                                <!--<td align="center">
                                    <?php
/*                                    $public = isset($action->groups[-1]);
                                    if($public)
                                        $check = "checked";
                                    else
                                        $check = "";
                                    */?>
                                    <input type="checkbox" name="droit" value="-1" data-action="<?php /*echo $action->id*/?>" class="public" checked="<?php /*echo $check*/?>"/>
                                </td>-->
                                <td>
                                    <form role="form" class="form-horizontal" method="POST" action="<?=base_url('admin/permissions/rmAction')?>" id="">
                                        <input type="hidden" name="id_action" id="id_action" value="<?php echo $action->id?>" />

                                        <button type="submit" name="submit" id="submit" onClick='return confirm("Supprimer la route ?")' class="btn btn-danger" >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
</div>
<!-- /#page-wrapper -->