<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                前台用户订单
                <a  href="<?= base_url('admin/orders_customer') ?>" class="btn btn-warning">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    创建新的前台用户订单
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php if ($this->session->flashdata('message')): ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=$this->session->flashdata('message')?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="">
                            <form role="form" method="POST" action="<?=base_url('admin/orders_customer/create')?>" class="form-horizontal" id="orders_customer_mng_frm">

                                <div class="col-sm-12" style="background-color: #f5f5f5; padding-top:15px; margin-top:-15px;">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品编号</label>
                                            <div class="col-xs-8">
                                                <select class="form-control" id="product_information_id" name="product_information_id">
                                                    <option value="">请选择产品编号</option>
                                                    <?php foreach ($product_informations as $product_information): ?>
                                                        <option value="<?php echo $product_information->id ?>"><?php echo $product_information->product_sn?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品系列</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" type="text" id="product_kind_id" name="product_kind_id" placeholder="" readonly/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">色号</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" type="text" id="color_id" name="color_id" placeholder="" readonly/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品型号</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="product_type_no" name="product_type_no" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品包装码</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="product_license_no" name="product_license_no" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">规格</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="size" name="size" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">重量</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="weight" name="weight" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">装车费</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="loading_fee" name="loading_fee" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">市场价</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="sale_price" name="sale_price" readonly />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group"></div>

                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">数量</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入数量" id="quantity" name="quantity">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">姓名</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入姓名" id="customer_name" name="customer_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">发货地址</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入发货地址" id="shipping_address" name="shipping_address">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">联系手机</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入联系手机" id="customer_phone" name="customer_phone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">打款银行</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入打款银行" id="deposit_bank" name="deposit_bank">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">打款金额</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入打款金额" id="deposit_amount" name="deposit_amount">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">付款款项</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入付款款项" id="deposit_item" name="deposit_item">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">订单状态</label>
                                            <div class="col-xs-8">
                                                <?php
                                                $disabled = "";
                                                if ($this->logged_in_role != "admin" && $this->logged_in_role != "accounter") $disabled="disabled"; ?>
                                                <select class="form-control" id="status_id" name="status_id" <?php echo $disabled?> >
                                                    <?php foreach ($order_status as $status): ?>
                                                        <option value="<?php echo $status['id'] ?>"><?php echo $status['status_name']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">打款时间</label>
                                            <div class="col-xs-8">
                                                <div class="col-sm-5">
                                                    <input class="form-control datepicker" placeholder="输入打款时间" id="deposit_date" name="deposit_date" value="<?php echo date("Y-m-d")?>">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="bootstrap-timepicker">
                                                        <input class="form-control timepicker" placeholder="输入时间" id="deposit_time" name="deposit_time">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">创建</button>
                                    <button type="reset" class="btn btn-default">重置</button>
                                </div>
                            </form>
                        </div>


                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
