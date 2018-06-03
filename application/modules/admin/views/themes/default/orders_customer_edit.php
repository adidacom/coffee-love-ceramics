<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                <?php echo $order_customer->type_name?>
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
                    更新前台<?php echo $order_customer->type_name?>
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
                            <form role="form" method="POST" action="<?=base_url('admin/orders_customer/edit/'.$order_customer->id)?>" id="orders_customer_saler_mng_frm" class="form-horizontal">

                                <div class="col-sm-12" style="background-color: #f5f5f5; padding-top:15px; margin-top:-15px;">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品编号</label>
                                            <div class="col-xs-8">
                                                <select class="form-control" id="product_information_id_edit" name="product_information_id" readonly <?php if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' ?> >
                                                    <!--<option value="-1">请选择产品编号</option>-->
                                                    <?php foreach ($product_informations as $product_information):
                                                        $selected = "";
                                                        if($product_information->id == $order_customer->product_id){
                                                            $selected = "selected";
                                                        ?>
                                                        <option value="<?php echo $product_information->id ?>" <?php echo $selected?> ><?php echo $product_information->product_sn?></option>
                                                    <?php } ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品系列</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" type="text" id="product_kind_id" name="product_kind_id" placeholder="" readonly value="<?php echo $order_customer->kind_name ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">色号</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" type="text" id="color_id" name="color_id" placeholder="" readonly value="<?php /*echo $order_customer->color_name */?>"/>
                                            </div>
                                        </div>
                                    </div>-->

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品型号</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="product_type_no" name="product_type_no" readonly value="<?php echo $order_customer->product_type_no ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品包装码</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="product_license_no" name="product_license_no" readonly value="<?php /*echo $order_customer->product_license_no */?>"/>
                                            </div>
                                        </div>
                                    </div>-->

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">规格</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="size" name="size" readonly value="<?php echo $order_customer->size_width." x ".$order_customer->size_height ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">重量</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="weight" name="weight" readonly value="<?php echo $order_customer->weight ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">装车费</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="loading_fee" name="loading_fee" readonly value="<?php echo $order_customer->loading_fee ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">开单价</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="production_price" name="production_price" readonly value="<?php echo $order_customer->production_price ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">工程价</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="bulk_sale_price" name="bulk_sale_price" readonly value="<?php echo $order_customer->bulk_sale_price ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">店面价</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="sale_price" name="sale_price" readonly value="<?php echo $order_customer->sale_price ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">网上价</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="internet_price" name="internet_price" readonly value="<?php echo $order_customer->internet_price ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">库存</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="stock" name="stock" readonly  value="<?php echo $order_customer->stock ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group"></div>

                                <div class="col-sm-12">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">色号</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" type="text" id="color_id" name="color_id" placeholder="" readonly value="<?php echo $order_customer->color_name ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">订单类型</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入选择订单类型" id="order_type_name" name="order_type_name" value="<?php echo $order_customer->type_name?>" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">箱</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入箱" value="<?php echo $order_customer->box_quantity?>" id="box_quantity" name="box_quantity" onchange="calcSalerOrderTotalPrice()" readonly <?php if ($order_customer->status_id == 8) echo 'readonly'; ?>>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">箱/片</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入箱/片"  value="<?php echo $order_customer->tiles_per_box_quantity?>" id="tiles_per_box_quantity" name="tiles_per_box_quantity" onchange="calcSalerOrderTotalPrice()" readonly <?php if ($order_customer->status_id == 8) echo 'readonly'; ?> >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">价格</label>
                                            <div class="col-xs-8">
                                                <input class="form-control"  value="<?php echo $order_customer->item_price?>" placeholder="输入价格" id="item_price" name="item_price" onchange="calcSalerOrderTotalPrice()" readonly <?php if ($order_customer->status_id == 8) echo 'readonly'; ?> >
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">数量</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入数量" id="quantity" name="quantity" readonly value="<?php /*echo $order_customer->quantity*/?>" <?php /*if ($this->logged_in_role == "accounter") echo 'readonly' */?> >
                                            </div>
                                        </div>
                                    </div>-->

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">总价格</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" id="total_price" name="total_price" value="<?php echo $order_customer->total_price?>" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group ">
                                            <label class="col-xs-4 control-label">发货地址</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入发货地址" id="shipping_address" name="shipping_address" value="<?php echo $order_customer->shipping_address?>"  <?php if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' ?> >
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">姓名</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入姓名" id="customer_name" name="customer_name" value="<?php /*echo $order_customer->customer_name*/?>" <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?>  />
                                            </div>
                                        </div>
                                    </div>-->

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">联系手机</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入联系手机" id="customer_phone" name="customer_phone" value="<?php echo $order_customer->customer_phone?>" <?php if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' ?>  />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="clearfix"></div>

                                <!--<div class="col-xs-6">

                                    <h3 style="background-color: #f5f5f5; padding: 5px 10px">预付 (30%) : <span id="prepay_price"><?php /*echo $order_customer->total_price * 0.3*/?></span>元</h3>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">姓名</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入姓名" id="customer_name" name="customer_name" value="<?php /*echo $order_customer->customer_name*/?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">打款银行</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入打款银行" id="deposit_bank" name="deposit_bank" value="<?php /*echo $order_customer->deposit_bank*/?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">打款金额</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入打款金额" id="deposit_amount" name="deposit_amount" readonly value="<?php /*echo $order_customer->total_price * 0.3*/?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">打款时间</label>
                                            <div class="col-xs-9">
                                                <div class="col-sm-6">
                                                    <input class="form-control datepicker" placeholder="输入打款时间" id="deposit_date" name="deposit_date" value="<?php /*if($order_customer->deposit_date != "") echo $order_customer->deposit_date; else echo date("Y-m-d");*/?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="bootstrap-timepicker">
                                                        <input class="form-control timepicker" placeholder="输入时间" id="deposit_time" name="deposit_time" value="<?php /*echo $order_customer->deposit_time */?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">付款款项</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入付款款项" id="deposit_item" name="deposit_item" value="<?php /*echo $order_customer->deposit_item*/?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <h3 style="background-color: #f5f5f5; padding: 5px 10px">尾付 (70%) : <span id="final_price"><?php /*echo $order_customer->total_price * 0.7*/?></span>元</h3>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">姓名</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入姓名" id="customer_name_70" name="customer_name_70" value="<?php /*echo $order_customer->customer_name_70*/?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">打款银行</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入打款银行" id="deposit_bank_70" name="deposit_bank_70" value="<?php /*echo $order_customer->deposit_bank_70*/?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">打款金额</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入打款金额" id="deposit_amount_70" name="deposit_amount_70" readonly value="<?php /*echo $order_customer->total_price*0.7*/?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">打款时间</label>
                                            <div class="col-xs-9">
                                                <div class="col-sm-6">
                                                    <input class="form-control datepicker" placeholder="输入打款时间" id="deposit_date_70" name="deposit_date_70" value="<?php /*if($order_customer->deposit_date_70 != "") echo $order_customer->deposit_date_70; else echo date("Y-m-d");*/?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="bootstrap-timepicker">
                                                        <input class="form-control timepicker" placeholder="输入时间" id="deposit_time_70" name="deposit_time_70" value="<?php /*echo $order_customer->deposit_time_70 */?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label">付款款项</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="输入付款款项" id="deposit_item_70" name="deposit_item_70" value="<?php /*echo $order_customer->deposit_item_70*/?>"  <?php /*if ($this->logged_in_role == "accounter" || $order_customer->status_id == 8) echo 'readonly' */?> >
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                                <div class="clearfix"></div>

                                <div class="col-xs-12">
                                    <div class="form-group col-xs-12" style="margin-top: 20px">
                                        <label class="col-xs-3 control-label">订单状态</label>
                                        <div class="col-xs-6">
                                            <?php
                                            $disabled = "";
                                            if ($this->logged_in_role != "admin" && $this->logged_in_role != "accounter") $disabled="disabled"; ?>
                                            <select class="form-control" id="status_id" name="status_id" <?php echo $disabled?> >
                                                <?php
                                                foreach ($order_status as $status):
                                                    $selected = "";
                                                    if ($status['id'] == $order_customer->status_id)
                                                        $selected = "selected";
                                                    ?>
                                                    <option value="<?php echo $status['id'] ?>" <?php echo $selected?> ><?php echo $status['status_name']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($order_customer->status_id < 8) {?>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <input type="hidden" id="is_product_edit" name="is_product_edit" value=""/>
                                </div>
                                <?php } ?>
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
