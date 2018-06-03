</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/admin/js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/formValidation.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/framework/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/plugins/datatable/dataTables.buttons.min.js"></script>
<!--<script src="<?/*= base_url() */?>assets/admin/js/plugins/datatable/buttons.flash.min.js"></script>-->
<script src="<?= base_url() ?>assets/admin/js/plugins/datatable/jszip.min.js"></script>
<!--<script src="<?/*= base_url() */?>assets/admin/js/plugins/datatable/pdfmake.min.js"></script>-->
<!--<script src="<?/*= base_url() */?>assets/admin/js/plugins/datatable/vfs_fonts.js"></script>-->
<script src="<?= base_url() ?>assets/admin/js/plugins/datatable/buttons.html5.min.js"></script>
<!--<script src="<?/*= base_url() */?>assets/admin/js/plugins/datatable/buttons.print.min.js"></script>-->

<!-- Datepicker JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/admin/js/bootstrap-timepicker.js"></script>
<script src="<?= base_url() ?>assets/admin/js/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>

<!-- CKEditor -->
<script src="<?= base_url() ?>assets/admin/js/plugins/ckeditor/ckeditor.js"></script>

<!-- Select2 -->
<script src="<?= base_url() ?>assets/admin/js/plugins/select2/select2.full.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?= base_url() ?>assets/admin/js/sb-admin-2.js"></script>
<script src="<?= base_url() ?>assets/admin/js/scripts.js"></script>


<div class="modal fade" id="product_sn_detail_mdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1>查看详细</h1>
            </div>
            <div class="modal-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="">
                        <thead>
                        <tr>
                            <th>瓷砖类别</th>
                            <th>产品系列</th>
                            <!--<th>色号</th>-->
                            <th>等级</th>
                            <th>产品型号</th>
                            <th>产品编号</th>
                            <!--<th>产品包装码</th>-->
                            <th>规格</th>
                            <th>重量</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="even gradeX">
                            <td id="category_name"></td>
                            <td id="kind_name"></td>
                            <!--<td id="color_name"></td>-->
                            <td id="level"></td>
                            <td id="product_type_no"></td>
                            <td id="product_sn"></td>
                            <!--<td id="product_license_no"></td>-->
                            <td id="size"></td>
                            <td id="weight"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?>;
    function toggleSideMenu(){
        var sidebar_width = parseInt($(".sidebar").css("width"));

        if(sidebar_width > 0) {
            $(".sidebar").animate({
                width: 0
            }, function () {
                $(".sidebar").hide()
                $("#toogleSideMenuIcon").html(">>")
                $(window).trigger('resize');
            })

            $("#page-wrapper").animate({
                marginLeft:0
            })
        } else {
            $(".sidebar").show()
            $(".sidebar").animate({
                width: 250
            }, function(){
                $("#toogleSideMenuIcon").html("<<")
                $(window).trigger('resize');
            })

            $("#page-wrapper").animate({
                marginLeft:250
            })
        }
    }
</script>

</body>

</html>
