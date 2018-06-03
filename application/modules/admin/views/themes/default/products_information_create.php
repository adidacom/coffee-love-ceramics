<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                产品信息
                <!--<a  href="<?/*= base_url('admin/product_information') */?>" class="btn btn-warning">返回</a>-->
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    创建新的产品信息
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php if ($this->session->flashdata('message')): ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=$this->session->flashdata('message')?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="">
                            <form role="form" method="POST" action="<?=base_url('admin/product_information/create')?>" id="products_mng_frm" class="form-horizontal" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">瓷砖类别</label>
                                    <div class="col-xs-8">
                                        <select class="form-control" id="tile_category_id" name="tile_category_id">
                                            <?php foreach ($tile_category as $category): ?>
                                                <option value="<?php echo $category['id'] ?>"><?php echo $category['category_name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">产品系列</label>
                                    <div class="col-xs-8">
                                        <select class="form-control" id="product_kind_id" name="product_kind_id">
                                            <?php foreach ($product_kinds as $product_kind): ?>
                                                <option value="<?php echo $product_kind['id'] ?>"><?php echo $product_kind['kind_name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label class="col-xs-2 control-label">色号</label>
                                    <div class="col-xs-8">
                                        <select class="form-control" id="color_id" name="color_id">
                                            <?php /*foreach ($colors as $color): */?>
                                                <option value="<?php /*echo $color['id'] */?>"><?php /*echo $color['name']*/?></option>
                                            <?php /*endforeach; */?>
                                        </select>
                                    </div>
                                </div>-->

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">等级</label>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" value="优等" disabled />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">产品型号</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入产品型号" id="product_type_no" name="product_type_no">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">产品编号</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入产品编号" id="product_sn" name="product_sn">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">箱/片</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入箱/片" id="tiles_per_box_quantity" name="tiles_per_box_quantity">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">规格</label>
                                    <div class="col-xs-8">
                                        <div class="col-xs-3">
                                            <input class="form-control" placeholder="输入规格" id="size_width" name="size_width">
                                        </div>
                                        <div class="col-xs-1 text-center">
                                            <label class="control-label text-center">X</label>
                                        </div>

                                        <div class="col-xs-3">
                                            <input class="form-control" placeholder="输入规格" id="size_height" name="size_height">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">重量</label>
                                    <div class="col-xs-8">
                                        <div class="col-xs-8">
                                            <input class="form-control" placeholder="输入重量" id="weight" name="weight">
                                        </div>
                                        <div class="col-xs-1 text-center">
                                            <label class="control-label text-center">Kg</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">开单价</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入开单价" id="production_price" name="production_price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">工程价</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入工程价" id="bulk_sale_price" name="bulk_sale_price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">店面价</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入店面价" id="sale_price" name="sale_price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">网上价</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入网上价" id="internet_price" name="internet_price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">折扣</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入折扣" id="discount_price" name="discount_price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">装车费</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入装车费" id="loading_fee" name="loading_fee">
                                    </div>
                                </div>

                                <div class="form-group photo_1" >
                                    <label class="col-xs-2 control-label">产品图片</label>
                                    <div class="col-xs-3">
                                        <img src="../../assets/admin/images/no_product.png" name="photo_1_preview" id="photo_1_preview" style="width:100%; border:1px solid #d2d6de"/>
                                        <img src="../../assets/admin/images/no_product.png" style="display: none" id="default_photo" />
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="file" class="form-control input-sm product_photo" name="photo_1" id="photo_1" />
                                        <button type="button" onclick="addProductPhoto(2)" name="add_product_photo" id="add_photo_btn_1" class="btn btn-success" style="margin-top:15px; margin-left:5px;"><i class="fa fa-plus"></i> 添新</button>
                                    </div>
                                </div>

                                <div class="form-group photo_2" style="display: none;">
                                    <label class="col-xs-2 control-label"></label>
                                    <div class="col-xs-3">
                                        <img src="../../assets/admin/images/no_product.png" name="photo_2_preview" id="photo_2_preview" style="width:100%; border:1px solid #d2d6de"/>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="file" class="form-control input-sm product_photo" name="photo_2" id="photo_2" />
                                        <button type="button" onclick="addProductPhoto(3)" name="add_product_photo" id="add_photo_btn_2" class="btn btn-success" style="margin-top:15px; margin-left:5px;"><i class="fa fa-plus"></i> 添新</button>
                                        <button type="button" onclick="cancelProductPhoto(2)" name="cancel_product_photo" id="cancel_photo_btn_2" class="btn btn-danger" style="margin-top:15px; margin-left:5px;"><i class="fa fa-remove"></i> 取消</button>
                                    </div>
                                </div>

                                <div class="form-group photo_3" style="display: none;">
                                    <label class="col-xs-2 control-label"></label>
                                    <div class="col-xs-3">
                                        <img src="../../assets/admin/images/no_product.png" name="photo_3_preview" id="photo_3_preview" style="width:100%; border:1px solid #d2d6de"/>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="file" class="form-control input-sm product_photo" name="photo_3" id="photo_3" />
                                        <button type="button" onclick="addProductPhoto(4)" name="add_product_photo" id="add_photo_btn_3" class="btn btn-success" style="margin-top:15px; margin-left:5px;"><i class="fa fa-plus"></i> 添新</button>
                                        <button type="button" onclick="cancelProductPhoto(3)" name="cancel_product_photo" id="cancel_photo_btn_3" class="btn btn-danger" style="margin-top:15px; margin-left:5px;"><i class="fa fa-remove"></i> 取消</button>
                                    </div>
                                </div>

                                <div class="form-group photo_4" style="display: none;">
                                    <label class="col-xs-2 control-label"></label>
                                    <div class="col-xs-3">
                                        <img src="../../assets/admin/images/no_product.png" name="photo_4_preview" id="photo_4_preview" style="width:100%; border:1px solid #d2d6de"/>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="file" class="form-control input-sm product_photo" name="photo_4" id="photo_4" />
                                        <button type="button" onclick="addProductPhoto(5)" name="add_product_photo" id="add_photo_btn_4" class="btn btn-success" style="margin-top:15px; margin-left:5px;"><i class="fa fa-plus"></i> 添新</button>
                                        <button type="button" onclick="cancelProductPhoto(4)" name="cancel_product_photo" id="cancel_photo_btn_4" class="btn btn-danger" style="margin-top:15px; margin-left:5px;"><i class="fa fa-remove"></i> 取消</button>
                                    </div>
                                </div>

                                <div class="form-group photo_5" style="display: none;">
                                    <label class="col-xs-2 control-label"></label>
                                    <div class="col-xs-3">
                                        <img src="../../assets/admin/images/no_product.png" name="photo_5_preview" id="photo_5_preview" style="width:100%; border:1px solid #d2d6de"/>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="file" class="form-control input-sm product_photo" name="photo_5" id="photo_5" />
                                        <button type="button" onclick="cancelProductPhoto(5)" name="cancel_product_photo" id="cancel_photo_btn_5" class="btn btn-danger" style="margin-top:15px; margin-left:5px;"><i class="fa fa-remove"></i> 取消</button>
                                    </div>
                                </div>

                                <div class="form-group photo_5" >
                                    <label class="col-xs-2 control-label">描述</label>
                                    <div class="col-xs-8">
                                        <textarea id="product_description" name="product_description" cols="50" role="20"></textarea>
                                    </div>
                                </div>



                                <div class="" style="text-align: center">
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
