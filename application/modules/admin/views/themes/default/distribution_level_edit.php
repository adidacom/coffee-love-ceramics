<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                分销商等级配置
                <a  href="<?= base_url('admin/distribution_level') ?>" class="btn btn-warning">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    更新分销商等级
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
                            <form role="form" method="POST" action="<?=base_url('admin/distribution_level/edit/'.$distribution_level->id)?>" id="distribution_level_mng_frm">

                                <div class="form-group">
                                    <label>等级名称</label>
                                    <input class="form-control" value="<?=$distribution_level->level_name?>" placeholder="输入等级名称" id="level_name" name="level_name">
                                </div>

                                <div class="form-group">
                                    <label>1级分销比例</label>
                                    <input class="form-control"  value="<?=$distribution_level->distribution_ratio?>" placeholder="输入1级分销比例" id="distribution_ratio" name="distribution_ratio">
                                </div>

                                <div class="form-group">
                                    <label>升级条件</label>
                                    <input class="form-control"  value="<?=$distribution_level->upgrade_condition?>" placeholder="输入升级条件" id="upgrade_condition" name="upgrade_condition">
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
