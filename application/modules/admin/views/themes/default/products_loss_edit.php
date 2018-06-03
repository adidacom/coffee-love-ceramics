<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                产品损耗
                <a  href="<?= base_url('admin/product_loss') ?>" class="btn btn-warning">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    更新产品损耗
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
                            <form role="form" method="POST" action="<?=base_url('admin/product_loss/edit/'.$product->id)?>" id="products_loss_detail_mng_frm" class="form-horizontal" >

                                <div class="col-sm-12" style="background-color: #f5f5f5; padding-top:15px; margin-top:-15px;">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品编号</label>
                                            <div class="col-xs-8">
                                                <select class="form-control" id="product_information_id" name="product_information_id" readonly />
                                                    <!--<option value="-1">请选择产品编号</option>-->
                                                    <option value="<?php echo $product->product_information_id?>"><?php echo $product->product_sn?></option>
                                                    <?php /*foreach ($product_informations as $product_information):
                                                        $selected = "";
                                                        if($product->product_information_id == $product_information->id)
                                                            $selected = "selected";
                                                        */?><!--
                                                        <option value="<?php /*echo $product_information->id */?>" <?php /*echo $selected*/?> ><?php /*echo $product_information->product_sn*/?></option>
                                                    --><?php /*endforeach; */?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品系列</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" type="text" id="product_kind_id" name="product_kind_id" placeholder="" readonly value="<?php echo $product->kind_name?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">色号</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" type="text" id="color_id" name="color_id" placeholder="" readonly value="<?php echo $product->color_name?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品型号</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="product_type_no" name="product_type_no" readonly value="<?php echo $product->product_type_no?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">产品包装码</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="product_license_no" name="product_license_no" readonly value="<?php /*echo $product->product_license_no*/?>" />
                                            </div>
                                        </div>
                                    </div>-->

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">规格</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="size" name="size" readonly  value="<?php echo $product->size_width." x ".$product->size_height ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">重量</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="weight" name="weight" readonly value="<?php echo $product->weight?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">装车费</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="loading_fee" name="loading_fee" readonly  value="<?php echo $product->loading_fee?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">箱/片</label>
                                            <div class="col-xs-8">
                                                <input type="number" class="form-control" placeholder="" id="tiles_per_box_quantity" name="tiles_per_box_quantity"  value="<?php echo $product->tiles_per_box_quantity?>" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">库存</label>
                                            <div class="col-xs-8">
                                                <input class="form-control" placeholder="" id="stock" name="stock"  value="<?php echo $product->stock?>" readonly />
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
                                                <select class="form-control" id="color_id" name="color_id" >
                                                    <?php
                                                    foreach ($colors as $color):
                                                        $selected = "";
                                                        if ($color['id'] == $product->color_id)
                                                            $selected = "selected";
                                                        ?>
                                                        <option value="<?php echo $color['id'] ?>" <?php echo $selected?> ><?php echo $color['name']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">箱</label>
                                            <div class="col-xs-8">
                                                <input type="number" class="form-control" placeholder="输入箱" id="box_quantity" name="box_quantity"  value="<?php echo $product->box_quantity?>">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-xs-4 control-label">仓库名称</label>
                                            <div class="col-xs-8">
                                                <select class="form-control" id="store_id" name="store_id">
                                                    <?php foreach ($stores as $store):
                                                        $selected = "";
                                                        if($product->store_id == $store['id'])
                                                            $selected = "selected";
                                                        ?>
                                                        <option value="<?php echo $store['id'] ?>" <?php echo $selected?> ><?php echo $store['store_name']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">入库时间</label>
                                        <div class="col-xs-8">
                                            <div class="col-sm-5">
                                                <input class="form-control datepicker" placeholder="输入时间" id="regist_date" name="regist_date" value="<?php echo $product->reg_date?>" readonly>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="bootstrap-timepicker">
                                                    <input class="form-control timepicker" placeholder="输入时间" id="regist_time" name="regist_time" value="<?php echo $product->reg_time?>" readonly>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">损耗描述</label>
                                        <div class="col-xs-9">
                                            <textarea id="loss_description" name="loss_description" cols="50" role="20"><?php echo $product->loss_description?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center" >
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <input type="hidden" name="is_product_edit" id="is_product_edit" value="0">
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
