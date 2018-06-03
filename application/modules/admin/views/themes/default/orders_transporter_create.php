<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    提货授权录入
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
            <div class="panel-default panel" >
                <div class="panel-body">
                    <form role="form" method="POST" action="<?=base_url('admin/orders/order_transporter_create')?>" id="order_transporter_mng_frm" class="form-horizontal">

                        <div class="col-sm-12">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">订单号</label>
                                    <div class="col-xs-8">
                                        <select class="form-control" id="order_id" name="order_id">
                                            <option value="">请选择订单</option>
                                            <?php foreach($paid_orders as $key=>$list){ ?>
                                            <option value="<?php echo $list->id?>"><?php echo $list->id." / ".$list->nickname." / ".$list->quantity." 片";?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">司机</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" id="transporter_name" name="transporter_name" placeholder="输入司机名字" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">联系方式</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" id="transporter_phone" name="transporter_phone" placeholder="输入司机手机号码" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">身份证号码</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" id="transporter_card_no" name="transporter_card_no" placeholder="输入身份证号码" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">车号码</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入车号码" id="transporter_car_no" name="transporter_car_no"  />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">数量(箱)</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入数量(箱)" id="quantity" name="quantity"  />
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">总订货</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" disabled id="order_total_quantity" name="order_total_quantity"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-4 control-label">已提货</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" disabled id="already_ordered_quantity" name="already_ordered_quantity" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-4 control-label">箱/片</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" disabled id="tiles_per_box_quantity" name="tiles_per_box_quantity" />
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">保存</button>
                            <input type="hidden" name="selected_order_limit" id="selected_order_limit" value="0">
                        </div>

                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /#page-wrapper -->
