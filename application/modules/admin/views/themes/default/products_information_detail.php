<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                产品信息
                <a  href="javascript:void(0)" class="btn btn-warning" onclick="goBack()">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    产品信息
                </div>
                <div class="panel-body">
                    <div class="">
                        <?php if ($this->session->flashdata('message')): ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=$this->session->flashdata('message')?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="">


                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="">
                                        <thead>
                                        <tr>
                                            <th>瓷砖类别</th>
                                            <th>产品系列</th>
                                            <!--<th>色号</th>-->
                                            <th>产品型号</th>
                                            <th>产品编号</th>
                                            <!--<th>产品包装码</th>-->
                                            <th>规格</th>
                                            <th>重量</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="even gradeX">
                                                <td><?=$product->category_name?></td>
                                                <td><?=$product->kind_name?></td>
                                                <!--<td><?/*=$product->color_name*/?></td>-->
                                                <td><?=$product->product_type_no?></td>
                                                <td><?=$product->product_sn?></td>
                                                <!--<td><?/*=$product->product_license_no*/?></td>-->
                                                <td><?=$product->size_width." x ".$product->size_height?></td>
                                                <td><?=$product->weight?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

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

<script type="text/javascript">
    function goBack(){
        history.go(-1);
    }
</script>