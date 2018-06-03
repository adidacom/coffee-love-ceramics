<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    产品信息管理
                    <a  href="<?= base_url('admin/product_information/create') ?>" class="btn btn-success">添加</a>
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
                    产品信息列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="products-informations-dataTables">
                            <thead>
                                <tr>
                                    <th>瓷砖类别</th>
                                    <th>产品系列</th>
                                    <!--<th>色号</th>-->
                                    <th>等级</th>
                                    <th>产品型号</th>
                                    <th>产品编号</th>
                                    <!--<th>产品包装码</th>-->
                                    <th>箱/片</th>
                                    <th>规格</th>
                                    <th>重量</th>
                                    <th>开单价(元)</th>
                                    <th>工程价(元)</th>
                                    <th>店面价(元)</th>
                                    <th>网上价(元)</th>
                                    <th>折扣(%)</th>
                                    <th>装车费(元)</th>
                                    <th>库存(片)</th>
                                    <th>二维码</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($products_information)): ?>
                                    <?php foreach ($products_information as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$list->category_name?></td>
                                            <td><?=$list->kind_name?></td>
                                            <!--<td><?/*=$list->color_name*/?></td>-->
                                            <td>优等</td>
                                            <td><?=$list->product_type_no?></td>
                                            <td><?=$list->product_sn?></td>
                                            <!--<td><?/*=$list->product_license_no*/?></td>-->
                                            <td><?=$list->tiles_per_box_quantity?></td>
                                            <td><?=$list->size_width." x ".$list->size_height?></td>
                                            <td><?=$list->weight?> Kg</td>
                                            <td><?=number_format($list->production_price,2)?></td>
                                            <td><?=number_format($list->bulk_sale_price,2)?></td>
                                            <td><?=number_format($list->sale_price,2)?></td>
                                            <td><?=number_format($list->internet_price,2)?></td>
                                            <td><?=$list->discount_price?></td>
                                            <td><?=number_format($list->loading_fee,2)?></td>
                                            <td><?=number_format($list->stock)?></td>
                                            <td>
                                                <a href="#" id="product_qr_<?php echo $list->id?>" data-toggle="modal" data-target="#zoom-product-qr-code" data-id="<?php echo $list->id?>"></a>
                                                <script type="text/javascript">
                                                    new QRCode(document.getElementById("product_qr_<?php echo $list->id?>"), {
                                                        text: "http://www.kafeilian.com/app/product/<?php echo $list->id?>",
                                                        width: 50,
                                                        height: 50
                                                    });
                                                </script>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('admin/product_information/edit/'.$list->id) ?>" class="btn btn-info">编辑</a>

                                                <!--<button class="btn btn-danger" data-href="<?/*= base_url('admin/product_information/delete/'.$list->id) */?>" data-toggle="modal" data-target="#confirm-delete">
                                                    删除
                                                </button>-->
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