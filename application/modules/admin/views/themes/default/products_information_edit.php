<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                产品信息
                <a  href="<?= base_url('admin/product_information') ?>" class="btn btn-warning">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    更新产品信息
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
                            <form role="form" method="POST" action="<?=base_url('admin/product_information/edit/'.$product->id)?>" id="products_mng_frm" class="form-horizontal" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">瓷砖类别</label>
                                    <div class="col-xs-8">
                                        <select class="form-control" id="tile_category_id" name="tile_category_id">
                                            <?php
                                            foreach ($tile_category as $category):
                                                $selected = "";
                                                if ($category['id'] == $product->tile_category_id)
                                                    $selected = "selected";
                                                ?>
                                                <option value="<?php echo $category['id'] ?>" <?php echo $selected?> ><?php echo $category['category_name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">产品系列</label>
                                    <div class="col-xs-8">
                                        <select class="form-control" id="product_kind_id" name="product_kind_id">
                                            <?php
                                            foreach ($product_kinds as $product_kind):
                                                $selected = "";
                                                if ($product_kind['id'] == $product->product_kind_id)
                                                    $selected = "selected";
                                                ?>
                                                <option value="<?php echo $product_kind['id'] ?>" <?php echo $selected?> ><?php echo $product_kind['kind_name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label class="col-xs-2 control-label">色号</label>
                                    <div class="col-xs-8">
                                        <select class="form-control" id="color_id" name="color_id">
                                            <?php
/*                                            foreach ($colors as $color):
                                                $selected = "";
                                                if ($color['id'] == $product->color_id)
                                                    $selected = "selected";
                                                */?>
                                                <option value="<?php /*echo $color['id'] */?>" <?php /*echo $selected*/?> ><?php /*echo $color['name']*/?></option>
                                            <?php /*endforeach; */?>
                                        </select>
                                    </div>
                                </div>-->

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">产品型号</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入产品型号" id="product_type_no" name="product_type_no" value="<?php echo $product->product_type_no?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">产品编号</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入产品编号" id="product_sn" name="product_sn" value="<?php echo $product->product_sn?>">
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label class="col-xs-2 control-label">产品包装码</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入产品包装码" id="product_license_no" name="product_license_no" value="<?php /*echo $product->product_license_no*/?>">
                                    </div>
                                </div>-->

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">箱/片</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入箱/片" id="tiles_per_box_quantity" name="tiles_per_box_quantity" <?php if($product->is_ordered == 'yes') echo 'disabled'?> value="<?php echo $product->tiles_per_box_quantity?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">规格</label>
                                    <div class="col-xs-8">
                                        <div class="col-xs-3">
                                            <input class="form-control" placeholder="输入规格" id="size_width" name="size_width" value="<?php echo $product->size_width?>">
                                        </div>
                                        <div class="col-xs-1 text-center">
                                            <label class="control-label text-center">X</label>
                                        </div>

                                        <div class="col-xs-3">
                                            <input class="form-control" placeholder="输入规格" id="size_height" name="size_height" value="<?php echo $product->size_height?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">重量</label>
                                    <div class="col-xs-8">
                                        <div class="col-xs-8">
                                            <input class="form-control" placeholder="输入重量" id="weight" name="weight" value="<?php echo $product->weight?>">
                                        </div>
                                        <div class="col-xs-1 text-center">
                                            <label class="control-label text-center">Kg</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">开单价</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入开单价" id="production_price" name="production_price" value="<?php echo $product->production_price?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">工程价</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入工程价" id="bulk_sale_price" name="bulk_sale_price" value="<?php echo $product->bulk_sale_price?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">店面价</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入店面价" id="sale_price" name="sale_price" value="<?php echo $product->sale_price?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">网上价</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入网上价" id="internet_price" name="internet_price" value="<?php echo $product->internet_price?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">折扣</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入折扣" id="discount_price" name="discount_price" value="<?php echo $product->discount_price?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">装车费</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入装车费" id="loading_fee" name="loading_fee" value="<?php echo $product->loading_fee?>">
                                        <img src="../../../assets/admin/images/no_product.png" style="display: none" id="default_photo" />
                                    </div>
                                </div>

                                <?php
                                $is_photo_ids = array();
                                for($i=1; $i<=5; $i++){
                                    $photo_url = "photo_".$i."_img";
                                    $is_photo = "photo_".$i."_is_photo";
                                    $is_photo = $product->$is_photo;

                                    if($is_photo == "Y") {
                                        $display = "block";
                                        $is_photo_ids[] = $i;
                                    }
                                    else
                                        $display = "none";

                                    ?>
                                    <div class="form-group photo_<?php echo $i?>" style="display: <?php if($i>1) echo $display?>;">
                                        <label class="col-xs-2 control-label"><?php if($i==1) {?>产品图片<?php } ?></label>
                                        <div class="col-xs-3">
                                            <img src="<?php echo $product->$photo_url ?>" name="photo_<?php echo $i?>_preview" id="photo_<?php echo $i?>_preview" style="width:100%; border:1px solid #d2d6de"/>
                                        </div>
                                        <div class="col-xs-5">
                                            <input type="file" class="form-control input-sm product_photo" name="photo_<?php echo $i?>" id="photo_<?php echo $i?>" value="<?php echo $product->$photo_url?>"/>
                                            <!--<button type="button" onclick="addProductPhoto(<?php /*echo ($i+1) */?>)" name="add_product_photo" id="add_photo_btn_1" class="btn btn-success" style="margin-top:15px; margin-left:5px;"><i class="fa fa-plus"></i> 添新</button>-->
                                            <?php if($i>1){?>
                                            <button type="button" onclick="cancelProductPhoto(<?php echo $i?>)" name="cancel_product_photo" id="cancel_photo_btn_<?php echo $i?>" class="btn btn-danger" style="margin-top:15px; margin-left:5px;"><i class="fa fa-remove"></i> 取消</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php }
                                $is_photo_ids = implode(",", $is_photo_ids);
                                ?>

                                <div class="form-group " >
                                    <label class="col-xs-2 control-label">描述</label>
                                    <div class="col-xs-8">
                                        <textarea id="product_description" name="product_description" cols="50" role="20"><?php echo $product->description?></textarea>
                                    </div>
                                </div>

                                <div class="" style="text-align: center">
                                    <input type="hidden" id="is_photo_ids" value="<?php echo $is_photo_ids?>" name="is_photo_ids">
                                    <button type="submit" class="btn btn-primary">保存</button>
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
