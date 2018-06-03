<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">数据汇总</h1>
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



        <div class="col-lg-12 col-md-6">

            <div class="panel panel-red">
           
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                           <h1><i class="fa fa-pie-chart"></i> 财务统计</h1>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div></div>
                        </div>
                    </div>
                </div>
       
                <div class="row" style="padding:0;margin:0;">
                    <?php foreach($banks as $key=>$bank): ?>
                    <div class="col-lg-4 col-md-6" style="padding:10px 10px 10px 10px;margin:0;">
                        <div class="list-group" style="margin-bottom: 0;">
                            <div class="list-group-item">
                                <span class="pull-left"><?php echo $bank['bank_name']."<br/>(".$bank['bank_account_no'].")"?></span>
                                <!--<span class="pull-right btn btn-primary">¥<?php /*echo number_format($bank['ordered_sum'],2)*/?> 元</span>-->
                                <span class="pull-right btn btn-primary">¥<?php echo number_format($bank['balance'],2)?> 元</span>
                                <div class="clearfix"></div>
                            </div>

                            <?php foreach($bank['deposit_sum'] as $deposit):?>
                            <div class="list-group-item">
                                <span class="pull-left"><?php echo $deposit->type_name;?></span>
                                <span class="pull-right btn btn-success">+ <?php echo number_format($deposit->ordered_sum,2)?> 元</span>
                                <div class="clearfix"></div>
                            </div>
                            <?php endforeach;?>

                            <?php foreach($bank['withdraw_sum'] as $withdraw):?>
                                <div class="list-group-item">
                                    <span class="pull-left"><?php echo $withdraw->type_name;?></span>
                                    <span class="pull-right btn btn-danger">- <?php echo number_format($withdraw->ordered_sum,2)?> 元</span>
                                    <div class="clearfix"></div>
                                </div>
                            <?php endforeach;?>

                        </div>
                    </div>
                    <?php endforeach;?>

                </div>
             </div>
        </div>

        <div class="col-lg-12 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row"> 
                        <div class="col-xs-6">
                            <h1><i class="fa fa-pie-chart"></i> 系统统计</h1>
                        </div>

                        <div class="col-xs-6 text-right" >
                            <div class="huge"></div>
                            <div></div>
                        </div>
                    </div>
                </div>
             
                 
                       
                <div class="list-group" style="margin:0;padding:10px 10px 10px 10px;">
                         <div class="list-group-item"> <span class="pull-left">订单总数</span>
                        <span class="pull-right"><?php echo $total_ordered_quantity?> 张</span><div class="clearfix"></div></div>
                        
                        <div class="list-group-item"> <span class="pull-left">经销商</span>
                        <span class="pull-right"><?php echo $aggencies_user_cnt ?> 个</span><div class="clearfix"></div></div>
                          <div class="list-group-item"> <span class="pull-left">业务员</span>
                        <span class="pull-right"><?php echo $business_user_cnt ?> 个</span><div class="clearfix"></div></div>
                          <div class="list-group-item"> <span class="pull-left">消费者</span>
                        <span class="pull-right"><?php echo $consumer_user_cnt ?> 个</span><div class="clearfix"></div></div>
                         <div class="list-group-item"> <span class="pull-left">平台总用户数</span>
                        <span class="pull-right"><?php echo $total_users_cnt ?> 个</span><div class="clearfix"></div></div>
                </div>

            </div>
        </div>

    </div>

</div>
<!-- /#page-wrapper -->