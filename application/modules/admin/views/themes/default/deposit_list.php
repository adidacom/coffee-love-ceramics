<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    应收查询
                    <a  href="<?= base_url('admin/accounter/deposit_list/create') ?>" class="btn btn-success">添加</a>
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
                    付款列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="deposit_list_datatable">
                            <thead>
                                <tr>
                                    <th>应收账户</th>
                                    <th>应收金额</th>
                                    <th>付款分类</th>
                                    <th>付款时间</th>
                                    <th>备注信息</th>
                                    <?php if($this->logged_in_role == "admin"){?>
                                    <th>操作</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($histories)): ?>
                                    <?php foreach ($histories as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$list->bank_name."(".$list->bank_account_no.")"?></td>
                                            <td><?=number_format($list->withdraw_amount,2)?></td>
                                            <td><?=$list->type_name?></td>
                                            <td><?=$list->reg_date?></td>
                                            <td><?=$list->description?></td>
                                            <?php if($this->logged_in_role == "admin") {?>
                                            <td>
                                                <a href="<?= base_url('admin/accounter/deposit_list/edit/'.$list->id) ?>" class="btn btn-info">编辑</a>

                                                <button class="btn btn-danger" data-href="<?= base_url('admin/accounter/deposit_delete/'.$list->id) ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    删除
                                                </button>
                                            </td>
                                            <?php } ?>
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
