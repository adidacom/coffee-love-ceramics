<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    提货查询信息
                    <!--<button class="btn btn-primary" onclick="showPaymentHistoryWraper()">存款添加</button>-->
                </h2>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <?php if ($this->session->flashdata('message')): ?>
            <div class="col-lg-12 col-md-12">
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?=$this->session->flashdata('message')?>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    提货人清单
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="orders_transporter_table">
                            <thead>
                                <tr>
                                    <th>订单ID</th>
                                    <th>产品编号</th>
                                    <th>色号</th>
                                    <th>名字</th>
                                    <th>手机号码</th>
                                    <th>身份证号码</th>
                                    <th>车号码</th>
                                    <th>数量(片)</th>
                                    <th>状态</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($transporters)){ ?>
                                    <?php foreach ($transporters as $key => $list): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $list->order_id?></td>
                                            <td><a href="javascript:void(0)" onclick="showProductDetail('<?php echo $list->product_id?>')"><?=$list->product_sn?></a></td>
                                            <td><?=$list->color_name?></td>
                                            <td><?=$list->transporter_name?></td>
                                            <td><?=$list->transporter_phone?></td>
                                            <td><?=$list->transporter_card_no?></td>
                                            <td><?=$list->transporter_car_no?></td>
                                            <td><?=number_format($list->quantity)?></td>
                                            <td align="center">
                                                <?php
                                                    if($list->send_status == 'yes')
                                                        echo '<span class="label label-primary">发货完成</span>';
                                                    else {
                                                        if($this->logged_in_role == "admin" || $this->logged_in_role == "store_manager") {
                                                            ?>
                                                            <form method="post"
                                                                  action="<?= base_url('admin/orders/order_transporter_create') ?>">
                                                                <input type="hidden" name="sale_order_id"
                                                                       id="sale_order_id"
                                                                       value="<?php echo $list->id ?>"/>
                                                                <button type="submit" class="btn btn-info">发货确认</button>
                                                            </form>
                                                            <?php
                                                        } else {
                                                            echo "等待处理";
                                                        }
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
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
