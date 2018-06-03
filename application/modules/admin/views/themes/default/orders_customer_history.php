<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    <?php echo $order_customer->type_name?>跟踪
                    <a  href="<?= base_url('admin/orders_customer') ?>" class="btn btn-warning">返回</a>
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
                    前台用户订单跟踪
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                <?php
                $is_order_changed = false;
                foreach($order_statuses as $ind => $status):
                    if( count($histories[$ind]) > 0 ){ $is_order_changed = true; ?>
                    <div class="col-xs-12 ">

                        <div class="form-group bg-success" style="padding:10px 15px;">
                            <div class="col-xs-4">
                                <label class="control-label">订单状态 : </label>
                                <div class="">
                                    <?php echo $status['status_name'];?>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <label class="control-label">更新时间 : </label>
                                <div class="">
                                    <?php echo $histories[$ind]->modify_date;?>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <label class="control-label">操作人 : </label>
                                <div class="">
                                    <?php echo $histories[$ind]->nickname;?>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <?php } ?>
                <?php endforeach;?>

                <?php
                    if(!$is_order_changed){ ?>
                        <div class="col-xs-12 text-center">

                            <div class="form-group bg-warning" style="padding:10px 15px; ">
                                <h4><p>没有跟踪。</p></h4>
                            </div>

                        </div>
                    <?php }
                ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /#page-wrapper -->

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>确认删除</h1>
            </div>
            <div class="modal-body">
                您确定要删除？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <a class="btn btn-danger btn-ok">删除</a>
            </div>
        </div>
    </div>
</div>