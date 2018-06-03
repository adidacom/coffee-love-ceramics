<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    仓储查询
                    <a  href="<?= base_url('admin/products/create') ?>" class="btn btn-success">添加</a>
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
                    产品列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="products-list-dataTables">
                            <thead>
                                <tr>
                                    <!--<th>产品系列</th>
                                    <th>色号</th>
                                    <th>产品型号</th>-->
                                    <th>产品编号</th>
                                    <th>色号</th>
                                    <th>批次码</th>
                                    <!--<th>产品包装码</th>
                                    <th>数量</th>
                                    <th>产品单位</th>
                                    <th>开单价</th>
                                    <th>工程价</th>
                                    <th>店面价</th>
                                    <th>网上价</th>
                                    <th>折扣</th>
                                    <th>金额</th>
                                    <th>装车费</th>
                                    <th>入库时间</th>-->
                                    <th>箱</th>
                                    <th>箱/片</th>
                                    <th>总平方</th>
                                    <th>重量</th>
                                    <th>总开单价(元)</th>
                                    <th>总工程价(元)</th>
                                    <th>总店面价(元)</th>
                                    <th>总网上价(元)</th>
                                    <th>仓库名称</th>
                                    <th>入库时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($products)): ?>
                                    <?php foreach ($products as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><a href="javascript:void(0)" onclick="showProductDetail('<?php echo $list->product_information_id?>')"><?=$list->product_sn?></a></td>
                                            <td><?=$list->color_name?></td>
                                            <td><?=$list->product_license_no?></td>
                                            <td><?=$list->box_quantity?></td>
                                            <td><?=$list->tiles_per_box_quantity?></td>
                                            <td><?=number_format(($list->size_width/1000)*($list->size_height/1000)*$list->tiles_per_box_quantity*$list->box_quantity,2)?></td>
                                            <td><?=number_format($list->weight*$list->tiles_per_box_quantity*$list->box_quantity)?></td>
                                            <td><?=number_format($list->production_price*$list->tiles_per_box_quantity*$list->box_quantity)?> </td>
                                            <td><?=number_format($list->bulk_sale_price*$list->tiles_per_box_quantity*$list->box_quantity)?> </td>
                                            <td><?=number_format($list->sale_price*$list->tiles_per_box_quantity*$list->box_quantity)?> </td>
                                            <td><?=number_format($list->internet_price*$list->tiles_per_box_quantity*$list->box_quantity)?> </td>
                                            <td><?=$list->store_name?></td>
                                            <td><?=$list->reg_date." ".$list->reg_time?></td>
                                            <td>
                                                <a href="<?= base_url('admin/products/edit/'.$list->id) ?>" class="btn btn-info">查看详细</a>

                                                <button class="btn btn-danger" data-href="<?= base_url('admin/products/delete/'.$list->id) ?>" data-toggle="modal" data-target="#confirm-delete">
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

<div class="modal fade" id="zoom-product-qr-code" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:330px">
        <div class="modal-content">
            <div class="modal-body">
                <div id="product_qr_zoomed"></div>
            </div>
        </div>
    </div>
</div>