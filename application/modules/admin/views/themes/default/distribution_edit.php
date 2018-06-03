<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                分销商配置
                <a  href="<?= base_url('admin/distributions') ?>" class="btn btn-warning">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    更新分销商
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
                            <form role="form" method="POST" action="<?=base_url('admin/distributions/edit/'.$distribution->id)?>" id="distributions_mng_frm">

                                <div class="form-group">
                                    <label>推荐人</label>
                                    <input class="form-control" placeholder="输入推荐人" id="recommended_person" name="recommended_person" value="<?php echo $distribution->recommended_person?>">
                                </div>

                                <div class="form-group">
                                    <label>姓名</label>
                                    <input class="form-control" placeholder="输入姓名" id="recommended_name" name="recommended_name" value="<?php echo $distribution->recommended_name?>">
                                </div>

                                <div class="form-group">
                                    <label>手机号码</label>
                                    <input class="form-control" placeholder="输入手机号码" id="recommended_phone" name="recommended_phone" value="<?php echo $distribution->recommended_phone?>">
                                </div>

                                <div class="form-group">
                                    <label>分销等级</label>
                                    <select class="form-control" id="distribution_level_id" name="distribution_level_id">
                                        <?php
                                        foreach ($distribution_level as $level):
                                            $select = "";
                                            if($level['id'] == $distribution->distribution_level_id)
                                                $select = "selected";
                                            ?>
                                            <option value="<?php echo $level['id'] ?>" <?php echo $select?> ><?php echo $level['level_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>累计佣金</label>
                                    <input class="form-control" placeholder="输入累计佣金" id="cumulative_comission" name="cumulative_comission" value="<?php echo $distribution->cumulative_comission?>">
                                </div>

                                <div class="form-group">
                                    <label>总计</label>
                                    <input class="form-control" placeholder="输入总计" id="total" name="total" value="<?php echo $distribution->total?>">
                                </div>

                                <div class="form-group">
                                    <label>状态</label>
                                    <input class="form-control" placeholder="输入状态" id="status" name="status" value="<?php echo $distribution->status?>">
                                </div>

                                <div class="form-group">
                                    <label>时间</label>
                                    <div>
                                        <div class="col-sm-5">
                                            <input class="form-control datepicker" placeholder="输入时间" id="reg_date" name="reg_date" value="<?php echo $distribution->reg_date?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="bootstrap-timepicker">
                                                <input class="form-control timepicker" placeholder="输入时间" id="reg_time" name="reg_time" value="<?php echo $distribution->reg_time?>">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>已经体现佣金</label>
                                    <input class="form-control" placeholder="输入已经体现佣金" id="commissioned" name="commissioned" value="<?php echo $distribution->commissioned?>">
                                </div>

                                <div class="form-group">
                                    <label>未提现佣金</label>
                                    <input class="form-control" placeholder="输入未提现佣金" id="no_commission" name="no_commission" value="<?php echo $distribution->no_commission?>">
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
