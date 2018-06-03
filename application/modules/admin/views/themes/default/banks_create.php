<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                银行账户
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
                    创建新的银行账户
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
                            <form role="form" method="POST" action="<?=base_url('admin/banks/create')?>" id="bank_mng_frm">

                                <div class="form-group">
                                    <label>账户名称</label>
                                    <input class="form-control" placeholder="输入账户名称" id="bank_name" name="bank_name">
                                </div>

                                <div class="form-group">
                                    <label>账号</label>
                                    <input class="form-control" placeholder="输入账号" id="bank_account_no" name="bank_account_no">
                                </div>

                                <div class="form-group">
                                    <label>当前余额</label>
                                    <input class="form-control" placeholder="输入当前余额" id="balance" name="balance">
                                </div>

                                <div class="form-group">
                                    <label>期初余额</label>
                                    <input class="form-control" placeholder="输入期初余额" id="basic_balance" name="basic_balance">
                                </div>

                                <div class="form-group">
                                    <label>账户类型</label>
                                    <input class="form-control" placeholder="输入账户类型" id="bank_account_type" name="bank_account_type">
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
