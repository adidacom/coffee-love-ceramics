<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    咖啡店管理
                    <a  href="<?= base_url('admin/shops/create') ?>" class="btn btn-success">添加</a>
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
                    咖啡店列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="shops-list-dataTable">
                            <thead>
                                <tr>
                                    <th>门店名称</th>
                                    <th>门店地址</th>
                                    <th>门店联系人</th>
                                    <th>联系人手机号</th>
                                    <th>录入时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($shops)): ?>
                                    <?php foreach ($shops as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$list['shop_name']?></td>
                                            <td><?=$list['address']?></td>
                                            <td><?=$list['contact_person']?></td>
                                            <td><?=$list['contact_phone']?></td>
                                            <td><?=$list['reg_date']?></td>
                                            <td>
                                                <a href="<?= base_url('admin/shops/edit/'.$list['id']) ?>" class="btn btn-info">编辑</a>

                                                <button class="btn btn-danger" data-href="<?= base_url('admin/shops/delete/'.$list['id']) ?>" data-toggle="modal" data-target="#confirm-delete">
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