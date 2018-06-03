<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    分销商管理
                    <a  href="<?= base_url('admin/distributions/create') ?>" class="btn btn-success">添加</a>
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
                    分销商列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="mst-dataTables">
                            <thead>
                                <tr>
                                    <th>推荐人</th>
                                    <th>姓名</th>
                                    <th>手机号码</th>
                                    <th>分销等级</th>
                                    <th>累计佣金</th>
                                    <th>总计</th>
                                    <th>状态</th>
                                    <th>时间</th>
                                    <th>已经体现佣金</th>
                                    <th>未提现佣金</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($distributions)): ?>
                                    <?php foreach ($distributions as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$list->recommended_person?></td>
                                            <td><?=$list->recommended_name?></td>
                                            <td><?=$list->recommended_phone?></td>
                                            <td><?=$list->level_name?></td>
                                            <td><?=$list->cumulative_comission?></td>
                                            <td><?=$list->total?></td>
                                            <td><?=$list->status?></td>
                                            <td><?=$list->reg_date." ".$list->reg_time?></td>
                                            <td><?=$list->commissioned?></td>
                                            <td><?=$list->no_commission?></td>
                                            <td>
                                                <a href="<?= base_url('admin/distributions/edit/'.$list->id) ?>" class="btn btn-info">编辑</a>

                                                <button class="btn btn-danger" data-href="<?= base_url('admin/distributions/delete/'.$list->id) ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    删除
                                                </button>
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
<!-- /#page-wrapper -->

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>确认删除</h1>
            </div>
            <div class="modal-body">
                您确定要删除？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <a class="btn btn-danger btn-ok">删除</a>
            </div>
        </div>
    </div>
</div>