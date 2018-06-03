<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                支出分类
                <!--<a  href="<?/*= base_url('admin/shops') */?>" class="btn btn-warning">返回</a>-->
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    更新支出分类
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
                            <form role="form" method="POST" action="<?=base_url('admin/accounter/withdraw_payment_type_edit/'.$type->id)?>" id="payment_type_mng_frm">

                                <div class="form-group">
                                    <label>支出分类名</label>
                                    <input class="form-control" placeholder="输入支出分类名" id="type_name" name="type_name" value="<?php echo $type->type_name?>">
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
