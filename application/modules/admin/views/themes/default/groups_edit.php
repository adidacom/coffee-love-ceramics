<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                用户组
                <a  href="<?= base_url('admin/user-groups') ?>" class="btn btn-warning">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    更新组
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/user-groups/edit/'.$group->id)?>" id="groups_mng_frm">

                                <div class="form-group">
                                    <label>组名称</label>
                                    <input class="form-control" value="<?=$group->name?>" placeholder="输入组名称" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label>描述</label>
                                    <input class="form-control" value="<?=$group->description?>" placeholder="输入组描述" id="description" name="description">
                                </div>

                                <button type="submit" class="btn btn-primary">保存</button>
                            </form>
                        </div>


                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
