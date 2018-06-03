<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                文章
                <a  href="<?= base_url('admin/posts') ?>" class="btn btn-warning">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    创建新的文章
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
                        <div class="">
                            <form role="form" method="POST" action="<?=base_url('admin/posts/create')?>" id="posts_mng_frm" class="form-horizontal" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">标题</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入标题" id="title" name="title">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">关键词</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入关键词" id="keyword" name="keyword">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">描述</label>
                                    <div class="col-xs-8">
                                        <input class="form-control" placeholder="输入描述" id="description" name="description">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-2 control-label">内容</label>
                                    <div class="col-xs-8">
                                        <textarea id="contents" name="contents" cols="50" role="20"></textarea>
                                    </div>
                                </div>

                                <div class="" style="text-align: center">
                                    <button type="submit" class="btn btn-primary">创建</button>
                                    <button type="reset" class="btn btn-default">重置</button>
                                </div>
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
