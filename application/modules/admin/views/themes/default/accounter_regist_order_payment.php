<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    收款录入
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
            <div class="panel-default panel " id="new_pay_history_wrapper" >
                <div class="panel-body">
                    <form role="form" method="POST" action="<?=base_url('admin/accounter/regist_payment_history')?>" id="accounter_orders_payment_mng_frm" class="form-horizontal">

                        <div class="col-sm-12">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">订单号</label>
                                    <div class="col-xs-8">
                                        <select class="form-control" id="order_id" name="order_id">
                                            <option value="">请选择订单</option>
                                            <?php foreach($unprocessed_orders as $key=>$list){ ?>
                                            <option value="<?php echo $list->id?>"><?php echo $list->id." / ".$list->nickname." / ".$list->quantity." 片";?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">汇款人名称</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" id="payer_name" name="payer_name" placeholder="输入汇款人名称" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">汇款银行</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" id="payer_bank" name="payer_bank" placeholder="输入汇款银行" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">汇款额</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" id="amount" name="amount" placeholder="输入汇款额" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">汇款时间</label>
                                    <div class="col-xs-8">
                                        <div class="col-sm-6">
                                            <input class="form-control datepicker" placeholder="输入汇款时间" id="paid_date" name="paid_date" value="<?php echo date('Y-m-d')?>" />
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="bootstrap-timepicker">
                                                <input class="form-control timepicker" placeholder="输入时间" id="paid_time" name="paid_time" />
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">汇款形式</label>
                                    <div class="col-xs-8">
                                        <select class="form-control" id="paid_type" name="paid_type">
                                            <option value="prepay">预付</option>
                                            <option value="finalpay">尾付</option>
                                            <option value="totalpay">全款</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label"> 储蓄银行</label>
                                    <div class="col-xs-8">
                                        <!--<input class="form-control" type="text" id="receiver_bank" name="receiver_bank" placeholder="输入储蓄银行" />-->
                                        <select class="form-control" id="receiver_bank" name="receiver_bank">
                                            <option value="">请选择储蓄银行</option>
                                            <?php foreach($banks as $key=>$list){ ?>
                                                <option value="<?php echo $list['id']?>"><?php echo $list['bank_name']." (".$list['bank_account_no'].")";?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label">备注信息</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" id="description" name="description" placeholder="输入备注信息" />
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">保存</button>
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
