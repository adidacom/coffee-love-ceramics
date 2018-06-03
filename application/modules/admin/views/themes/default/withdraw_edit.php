<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                应付录入
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
                    更新应付
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
                            <form role="form" method="POST" action="<?=base_url('admin/accounter/withdraw_list/edit/'.$withdraw->id)?>" id="withdraw_mng_frm">

                                <div class="form-group">
                                    <label>应付账户</label>
                                    <select class="form-control" id="bank_id" name="bank_id">
                                        <?php foreach ($banks as $bank):
                                            if($withdraw->bank_id == $bank['id'])
                                                $selected = "selected";
                                            else
                                                $selected = "";
                                            ?>
                                            <option value="<?=$bank['id']?>" <?php echo $selected?> ><?=$bank['bank_name']."(".$bank['bank_account_no'].")"?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>应付金额</label>
                                    <input class="form-control" placeholder="输入付款金额" id="withdraw_amount" name="withdraw_amount" value="<?php echo $withdraw->withdraw_amount?>" >
                                </div>

                                <div class="form-group">
                                    <label>分类</label>
                                    <select class="form-control" id="payment_type_id" name="payment_type_id">
                                        <?php foreach ($payment_types as $type):
                                            if($withdraw->payment_type_id == $type['id'])
                                                $selected = "selected";
                                            else
                                                $selected = "";
                                            ?>
                                            <option value="<?=$type['id']?>" <?php echo $selected?> ><?=$type['type_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>备注信息</label>
                                    <input class="form-control" placeholder="输入备注信息" id="description" name="description" value="<?php echo $withdraw->description?>" >
                                </div>

                                <?php
                                if ($withdraw->type_name == "咖啡加盟金")
                                    $show_user = "display: block";
                                else
                                    $show_user = "display: none";

                                ?>
                                <div class="form-group" id="deposit_user_id_wrapper" style="<?php echo $show_user?>">
                                    <label>用户</label>
                                    <select class="form-control" id="deposit_user_id" name="deposit_user_id">
                                        <option value="-1" selected="selected">请选择用户</option>
                                        <?php foreach ($agencies as $agency):
                                            if($withdraw->join_fee_user_id == $agency->id)
                                                $selected = "selected";
                                            else
                                                $selected = "";
                                            ?>
                                            <option value="<?=$agency->id?>" <?php echo $selected?> ><?=$agency->nickname?></option>
                                        <?php endforeach; ?>
                                    </select>
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
