<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                咖啡店
                <a  href="<?= base_url('admin/shops') ?>" class="btn btn-warning">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    更新咖啡店
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
                            <form role="form" method="POST" action="<?=base_url('admin/shops/edit/'.$shop->id)?>" id="shops_mng_frm">

                                <div class="form-group">
                                    <label>门店名称</label>
                                    <input class="form-control" value="<?=$shop->shop_name?>" placeholder="输入门店名称" id="name" name="name">
                                </div>

                                <div class="form-group">
                                    <label>门店地址</label>
                                    <input class="form-control" value="<?=$shop->address?>" placeholder="输入门店地址" id="address" name="address">
                                </div>

                                <div class="form-group">
                                    <label>门店联系人</label>
                                    <input class="form-control" value="<?=$shop->contact_person?>" placeholder="输入门店联系人" id="contact_person" name="contact_person">
                                </div>

                                <div class="form-group">
                                    <label>联系人手机号</label>
                                    <input class="form-control" value="<?=$shop->contact_phone?>" placeholder="输入联系人手机号" id="contact_phone" name="contact_phone">
                                </div>

                                <button type="submit" class="btn btn-primary">保存</button>
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
