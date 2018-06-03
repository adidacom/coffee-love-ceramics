<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                后台生产订单
                <a  href="<?= base_url('admin/orders_production') ?>" class="btn btn-warning">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    创建新的后台订单列表
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
                        <div class="col-lg-6">
                            <form role="form" method="POST" action="<?=base_url('admin/orders_production/create')?>" id="orders_production_mng_frm">

                                <div class="form-group">
                                    <label>产品系列</label>
                                    <select class="form-control" id="product_kind_id" name="product_kind_id">
                                        <?php foreach ($product_kinds as $product_kind): ?>
                                            <option value="<?php echo $product_kind['id'] ?>"><?php echo $product_kind['kind_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>色号</label>
                                    <select class="form-control" id="color_id" name="color_id">
                                        <?php foreach ($colors as $color): ?>
                                            <option value="<?php echo $color['id'] ?>"><?php echo $color['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>产品型号</label>
                                    <input class="form-control" placeholder="输入产品型号" id="product_type_no" name="product_type_no">
                                </div>

                                <div class="form-group">
                                    <label>产品编号</label>
                                    <input class="form-control" placeholder="输入产品编号" id="product_sn" name="product_sn">
                                </div>

                                <div class="form-group">
                                    <label>产品包装码</label>
                                    <input class="form-control" placeholder="输入产品包装码" id="product_license_no" name="product_license_no">
                                </div>

                                <div class="form-group">
                                    <label>数量</label>
                                    <input class="form-control" placeholder="输入数量" id="quantity" name="quantity">
                                </div>

                                <div class="form-group">
                                    <label>产品单位</label>
                                    <select class="form-control" id="unit_id" name="unit_id">
                                        <?php foreach ($units as $unit): ?>
                                            <option value="<?php echo $unit['id'] ?>"><?php echo $unit['unit_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>开单价</label>
                                    <input class="form-control" placeholder="输入开单价" id="production_price" name="production_price">
                                </div>

                                <div class="form-group">
                                    <label>工程价</label>
                                    <input class="form-control" placeholder="输入工程价" id="bulk_sale_price" name="bulk_sale_price">
                                </div>

                                <div class="form-group">
                                    <label>市场价</label>
                                    <input class="form-control" placeholder="输入市场价" id="sale_price" name="sale_price">
                                </div>

                                <div class="form-group">
                                    <label>折扣</label>
                                    <input class="form-control" placeholder="输入折扣" id="discount_price" name="discount_price">
                                </div>

                                <div class="form-group">
                                    <label>金额</label>
                                    <input class="form-control" placeholder="输入金额" id="price" name="price">
                                </div>

                                <div class="form-group">
                                    <label>排产定金</label>
                                    <input class="form-control" placeholder="输入排产定金" id="reservation_amount" name="reservation_amount">
                                </div>

                                <div class="form-group">
                                    <label>排产日期</label>
                                    <input class="form-control datepicker" placeholder="输入排产日期" id="reservation_date" name="reservation_date" value="<?php echo date("Y-m-d")?>">
                                </div>

                                <div class="form-group">
                                    <div class="bootstrap-timepicker">
                                        <label>时间</label>
                                        <input class="form-control timepicker" placeholder="输入时间" id="reservation_time" name="reservation_time">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">创建</button>
                                <button type="reset" class="btn btn-default">重置</button>
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
