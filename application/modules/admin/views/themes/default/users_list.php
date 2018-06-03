<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    用户
                    <a  href="<?= base_url('admin/users/create') ?>" class="btn btn-success">添加</a>
                </h2>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <?php if ($this->session->flashdata('message')): ?>
            <div class="col-lg-12 col-md-12">
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?=$this->session->flashdata('message')?>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    用户列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="user-list-dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>电话号码</th>
                                    <th>全名</th>
                                    <th>电子邮件</th>
                                    <th>用户组</th>
                                    <th>余额(元)</th>
                                    <th>加盟金(元)</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($users)): ?>
                                    <?php foreach ($users as $user):
                                        $user_groups = $this->ion_auth->get_users_groups($user->id)->result();
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$user->id?></td>
                                            <td><?=$user->phone?></td>
                                            <td><?=$user->nickname?></td>
                                            <td><?=$user->email?></td>
                                            <td><?=$user_groups[0]->description?></td>
                                            <td><?=number_format($user->balance,2)?></td>
                                            <td><?=number_format($user->join_fee,2)?></td>
                                            <td>
                                                <a href="<?= base_url('admin/users/edit/'.$user->id) ?>" class="btn btn-info">编辑</a>
                                                <a href="<?= base_url('admin/users/delete/'.$user->id) ?>" class="btn btn-danger">删除</a>
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