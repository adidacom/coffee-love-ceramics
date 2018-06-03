<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    用户组
                    <a  href="<?= base_url('admin/user-groups/create') ?>" class="btn btn-success">添加</a>
                </h2>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    用户组列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>角色</th>
                                    <th>描述</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($groups)): ?>
                                    <?php foreach ($groups as $group): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$group->name?></td>
                                            <td><?=$group->description?></td>
                                            <td>
                                                <a href="<?= base_url('admin/user-groups/edit/'.$group->id) ?>" class="btn btn-info">编辑</a>
                                                <!--<a href="<?/*= base_url('admin/user-groups/delete/'.$group->id) */?>" class="btn btn-danger">删除</a>-->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
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