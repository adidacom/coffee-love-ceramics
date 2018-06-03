<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    后台生产订单管理
                    <a  href="<?= base_url('admin/orders_production/create') ?>" class="btn btn-success">添加</a>
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
                    后台生产订单列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="mst-dataTables">
                            <thead>
                                <tr>
                                    <th>产品系列</th>
                                    <th>色号</th>
                                    <th>产品型号</th>
                                    <th>产品编号</th>
                                    <th>产品包装码</th>
                                    <th>数量</th>
                                    <th>产品单位</th>
                                    <th>开单价</th>
                                    <th>工程价</th>
                                    <th>市场价</th>
                                    <th>折扣</th>
                                    <th>金额</th>
                                    <th>排产定金</th>
                                    <th>排产日期</th>
                                    <th>时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($orders_production)): ?>
                                    <?php foreach ($orders_production as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$list->kind_name?></td>
                                            <td><?=$list->color_name?></td>
                                            <td><?=$list->product_type_no?></td>
                                            <td><?=$list->product_sn?></td>
                                            <td><?=$list->product_license_no?></td>
                                            <td><?=$list->unit_name?></td>
                                            <td><?=$list->quantity?></td>
                                            <td><?=$list->production_price?> 元</td>
                                            <td><?=$list->bulk_sale_price?> 元</td>
                                            <td><?=$list->sale_price?> 元</td>
                                            <td><?=$list->discount_price?> 元</td>
                                            <td><?=$list->price?> 元</td>
                                            <td><?=$list->reservation_amount?></td>
                                            <td><?=$list->reservation_date?></td>
                                            <td><?=$list->reservation_time?></td>
                                            <td>
                                                <a href="<?= base_url('admin/orders_production/edit/'.$list->id) ?>" class="btn btn-info">编辑</a>

                                                <button class="btn btn-danger" data-href="<?= base_url('admin/orders_production/delete/'.$list->id) ?>" data-toggle="modal" data-target="#confirm-delete">
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