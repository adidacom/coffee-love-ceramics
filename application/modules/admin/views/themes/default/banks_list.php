<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    银行账户查询
                    <!--<a  href="<?/*= base_url('admin/banks/create') */?>" class="btn btn-success">添加</a>-->
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
                    银行账户列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="banks_list_datatable">
                            <thead>
                                <tr>
                                    <th>账户编号</th>
                                    <th>账户名称</th>
                                    <th>账号</th>
                                    <th>当前余额(元)</th>
                                    <th>期初余额(元)</th>
                                    <th>建账日期</th>
                                    <th>账户类型</th>
                                    <?php if($this->logged_in_role == "admin") {?>
                                    <th>操作</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($banks)): ?>
                                    <?php foreach ($banks as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$list['id']?></td>
                                            <td><?=$list['bank_name']?></td>
                                            <td><?=$list['bank_account_no']?></td>
                                            <td><?=number_format($list['balance'],2)?></td>
                                            <td><?=number_format($list['basic_balance'],2)?></td>
                                            <td><?=$list['reg_date']?></td>
                                            <td><?=$list['bank_account_type']?></td>
                                            <?php if($this->logged_in_role == "admin") {?>
                                            <td>
                                                <a href="<?= base_url('admin/banks/edit/'.$list['id']) ?>" class="btn btn-info">编辑</a>

                                                <button class="btn btn-danger" data-href="<?= base_url('admin/banks/delete/'.$list['id']) ?>" data-toggle="modal" data-target="#confirm-delete">
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
