<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                应收录入
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
                    创建新的应收
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
                            <form role="form" method="POST" action="<?=base_url('admin/accounter/deposit_list/create')?>" id="deposit_mng_frm">

                                <div class="form-group">
                                    <label>应收账户</label>
                                    <select class="form-control" id="bank_id" name="bank_id">
                                        <?php foreach ($banks as $bank): ?>
                                            <option value="<?=$bank['id']?>"><?=$bank['bank_name']."(".$bank['bank_account_no'].")"?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>应收金额</label>
                                    <input class="form-control" placeholder="输入应收金额" id="withdraw_amount" name="withdraw_amount">
                                </div>

                                <div class="form-group">
                                    <label>分类</label>
                                    <select class="form-control" id="payment_type_id" name="payment_type_id">
                                        <?php foreach ($payment_types as $type): ?>
                                            <option value="<?=$type['id']?>"><?=$type['type_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>备注信息</label>
                                    <input class="form-control" placeholder="输入备注信息" id="description" name="description">
                                </div>

                                <div class="form-group" id="deposit_user_id_wrapper" style="display: none">
                                    <label>用户</label>
                                    <select class="form-control" id="deposit_user_id" name="deposit_user_id">
                                        <option value="-1" selected="selected">请选择用户</option>
                                        <?php foreach ($agencies as $agency): ?>
                                            <option value="<?=$agency->id?>"><?=$agency->nickname?></option>
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
