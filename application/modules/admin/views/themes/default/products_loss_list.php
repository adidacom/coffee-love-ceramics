<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    产品损耗管理
                    <a  href="<?= base_url('admin/product_loss/create') ?>" class="btn btn-success">添加</a>
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
                    产品损耗列表
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="products-loss-list-dataTables">
                            <thead>
                                <tr>
                                    <th>产品系列</th>
                                    <th>色号</th>
                                    <th>产品型号</th>
                                    <th>产品编号</th>
                                    <th>箱</th>
                                    <th>箱/片</th>
                                    <th>损耗描述</th>
                                    <th>录入时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($products_loss)): ?>
                                    <?php foreach ($products_loss as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?=$list->kind_name?></td>
                                            <td><?=$list->color_name?></td>
                                            <td><?=$list->product_type_no?></td>
                                            <td><a href="javascript:void(0)" onclick="showProductDetail('<?php echo $list->product_information_id?>')"><?=$list->product_sn?></a></td>
                                            <td><?=$list->box_quantity?></td>
                                            <td><?=$list->tiles_per_box_quantity?></td>
                                            <td><?=$list->loss_description?></td>
                                            <td><?=$list->reg_date." ".$list->reg_time?></td>
                                            <td align="center">
                                                <?php if($list->confirmed == 'no'){?>
                                                <a href="<?= base_url('admin/product_loss/edit/'.$list->id) ?>" class="btn btn-info">编辑</a>

                                                <button class="btn btn-danger" data-href="<?= base_url('admin/product_loss/delete/'.$list->id) ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    删除
                                                </button>
                                            <?php }
                                                if( ($this->logged_in_role == "accounter" || $this->logged_in_role == "admin") && $list->confirmed =='no' ){?>
                                                    <a href="<?= base_url('admin/product_loss/confirm/'.$list->id) ?>" class="btn btn-info">确认</a>
                                            <?php }
                                                if($list->confirmed == 'yes'){
                                                    echo '<span class="label label-primary">已确认 ('.$list->confirmer_name.')</span>';
                                                }
                                                ?>
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