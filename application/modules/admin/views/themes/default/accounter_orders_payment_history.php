<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header users-header">
                <h2>
                    订单存款跟踪
                    <!--<button class="btn btn-primary" onclick="showPaymentHistoryWraper()">存款添加</button>-->
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
            <div class="panel-default panel " id="new_pay_history_wrapper" style="display:none;">
                <div class="panel-body">
                    <form role="form" method="POST" action="<?=base_url('admin/orders_customer/regist_payment_history')?>" id="orders_payment_mng_frm" class="form-horizontal">

                        <div class="col-sm-12">

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
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-xs-4 control-label"> 储蓄银行</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" type="text" id="receiver_bank" name="receiver_bank" placeholder="输入储蓄银行" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">保存</button>
                            <button type="button" class="btn btn-default" onclick="hidePaymentHistoryWraper()">取消</button>
                            <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_customer->id?>"/>
                        </div>

                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    订单存款清单
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="payment_history_table">
                            <thead>
                                <tr>
                                    <th>订单ID</th>
                                    <th>汇款人名称</th>
                                    <th>汇款银行</th>
                                    <th>汇款额(元)</th>
                                    <th>汇款时间</th>
                                    <th>汇款形式</th>
                                    <th>储蓄银行</th>
                                    <th>入金状态</th>
                                    <th>财务</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($payment_history)){ ?>
                                    <?php foreach ($payment_history as $key => $list): ?>
                                        <tr class="even gradeX?>">
                                            <td><a href="<?=base_url('admin/accounter/order_payments/history/'.$list->order_id)?>"><?=$list->order_id?></a></td>
                                            <td><?=$list->payer_name?></td>
                                            <td><?=$list->payer_bank?></td>
                                            <td><?=number_format($list->amount,2)?> </td>
                                            <td><?=$list->paid_date?></td>
                                            <td><?php if($list->paid_type=='prepay') echo '预付'; else if($list->paid_type=='finalpay') echo '尾付'; else if($list->paid_type=='totalpay') echo '全款'?> </td>
                                            <td><?=$list->receiver_bank_name." (".$list->bank_account_no.")"?></td>
                                            <td>
                                                <?php
                                                    if($this->logged_in_role == "accounter" && $list->pay_confirm_status=="no"){ ?>
                                                        <select onchange="changeOrderPaymentHistoryConfirmStatus(this, '<?php echo $list->id?>')">
                                                            <option value="yes" <?php if($list->pay_confirm_status == 'yes') echo 'selected';?> >确认</option>
                                                            <option value="no" <?php if($list->pay_confirm_status == 'no') echo 'selected';?> >未确认</option>
                                                        </select>
                                                    <?php } else {
                                                        if ($list->pay_confirm_status == 'yes')
                                                            echo '确认';
                                                        else
                                                            echo '未确认';
                                                    }
                                                ?>
                                            </td>
                                            <td><?=$list->confirmer_name?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <th colspan="3" align="right" style="text-align:right;">总金额 : </th>
                                <th colspan="6"><span id="total_price"></span></th>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /#page-wrapper -->

<form id="order_payment_confirm_sattus_change_frm" method="POST"  action="<?=base_url('admin/accounter/regist_payment_history')?>" class="hidden">
    <input type="hidden" id="history_id" name="history_id" value="0">
    <input type="hidden" id="confirm_status" name="confirm_status" value="">
</form>