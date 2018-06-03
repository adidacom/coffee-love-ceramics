$(document).ready(function() {

    if( $("#product_description").length > 0) {
        CKEDITOR.replace('product_description', {
            extraPlugins: 'imageuploader'
        });
    }

    if( $("#loss_description").length > 0) {
        CKEDITOR.replace('loss_description', {
            extraPlugins: 'imageuploader'
        });
    }

    if( $("#posts_mng_frm #contents").length > 0) {

        CKEDITOR.replace('contents', {
            extraPlugins: 'imageuploader'
        });
    }

    if ( $("#order_user_select").length > 0){
        $("#order_user_select").select2({
            placeholder: '请选择用户',
            language: "zh-CN",
            ajax: {
                url: "../../admin/users/get_by_name_or_phone",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                //cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    }

    /*$("#deposit_user_id").select2({
        placeholder: '请选择用户',
        language: "zh-CN",
        ajax: {
            url: window.base_url+"admin/users/get_deposit_users",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            //cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepo, // omitted for brevity, see the source of this page
        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    });*/

    if ( $("#product_information_id").length > 0){
        $("#product_information_id").select2({
            placeholder: '请选择产品编号和色系',
            language: "zh-CN",
            ajax: {
                url: window.base_url+"admin/product_information/get_by_sn_or_color",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                //cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepoPI, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelectionPI // omitted for brevity, see the source of this page
        });
    }

    if( $("#orders_customer_datatable").length > 0){
        drawOrdersCustomerTable(0);
    }

    /*$("#product_information_id").change(function(){
        var id = $(this).val();
        var url = "../../admin/product_information/get/"+id;

        if($("#is_product_edit").length > 0)
            url = "../../../admin/product_information/get/"+id;

        $.ajax({
            type: "GET",
            url: url,
            contentType: "application/x-www-form-urlencoded;",
            dataType: "json",
            async: false,
            success: function(data){
                $("#product_kind_id").val(data.kind_name);
                $("#color_id").val(data.color_name);
                $("#product_type_no").val(data.product_type_no);
                $("#product_license_no").val(data.product_license_no);
                $("#tiles_per_box_quantity").val(data.tiles_per_box_quantity);
                $("#size").val(data.size_width + " x " + data.size_height);
                $("#weight").val(data.weight);
                $("#loading_fee").val(data.loading_fee);
                $("#production_price").val(data.production_price);
                $("#sale_price").val(data.sale_price);
                $("#bulk_sale_price").val(data.bulk_sale_price);
                $("#internet_price").val(data.internet_price);
                $("#stock").val(data.stock);

                $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'box_quantity');
                /!*$('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'tiles_per_box_quantity');*!/
            }
        });
    })*/

    $("#order_transporter_mng_frm #order_id").change(function(){
        var id = $(this).val();

        var url = window.base_url+"admin/orders_customer/get_order_transporter/"+id;
        $.ajax({
            type: "GET",
            url: url,
            contentType: "application/x-www-form-urlencoded;",
            dataType: "json",
            async: false,
            success: function(data){
                $("#order_total_quantity").val(data.quantity);
                $("#already_ordered_quantity").val(data.already_transported);
                $("#selected_order_limit").val(data.possible_quantity);
                $("#tiles_per_box_quantity").val(data.tiles_per_box_quantity);

                $('#order_transporter_mng_frm').formValidation('revalidateField', 'quantity');
            }
        });
    })

    $("#status_id").change(function(){
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'customer_name');
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'deposit_bank');
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'deposit_amount');
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'deposit_date');
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'deposit_time');
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'deposit_item');

        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'customer_name_70');
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'deposit_bank_70');
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'deposit_amount_70');
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'deposit_date_70');
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'deposit_time_70');
        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'deposit_item_70');
    })

    $('#user-list-dataTable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '用户',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4,5,6]
                }
            }
        ]
    });

    $('#tile-category-dataTable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '瓷砖类别',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1]
                }
            }
        ]
    });

    $('#colors-list-dataTable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '色彩',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1]
                }
            }
        ]
    });

    $('#product-kind-list-dataTable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '产品系列',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1]
                }
            }
        ]
    });

    $('#stores-list-dataTable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '仓库',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1]
                }
            }
        ]
    });

    $('#shops-list-dataTable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '咖啡店',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4]
                }
            }
        ]
    });


    $(".datepicker").datepicker({
        language: 'zh-CN',
        format: "yyyy-mm-dd",
        autoclose: true
    })

    $(".timepicker").timepicker({
        showInputs: false
    });

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#zoom-product-qr-code').on('show.bs.modal', function(e) {
        var product_id = $(e.relatedTarget).data('id');

        $("#product_qr_zoomed").html("");
        new QRCode(document.getElementById("product_qr_zoomed"), {
            text: "http://www.kafeilian.com/app/product/"+product_id,
            width: 300,
            height: 300
        });
    });

    $('#products-informations-dataTables').DataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '产品信息',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]
                }
            }
        ]
    });

    $('#products-list-dataTables').DataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '仓储查询',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4,5,6,7,8,9,10,11,12]
                }
            }
        ]
    });

    $('#mst-dataTables').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
    });

    $('#products-loss-list-dataTables').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '产品损耗',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4,5,6,7]
                }
            }
        ]
    });

    var history_tbl = $('#payment_history_table').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '订单存款',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4,5,6,7]
                }
            }
        ],
        "fnDrawCallback": function( oSettings ) {
            var sum = 0;
            var tbl_data = history_tbl.fnGetData();
            for(var i=0; i<tbl_data.length; i++){
                sum = sum + parseFloat(tbl_data[i][3].replace(/,/g,''));
            }

            $("#total_price").html(Number(sum.toFixed(2)).toLocaleString());

        }
    });

    $('#orders_transporter_table').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '提货查询信息',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4,5,6]
                }
            }
        ]
    });

    $('#banks_list_datatable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '银行账户查询',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4,5,6]
                }
            }
        ]
    });

    $('#deposit_list_datatable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '应收查询',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4]
                }
            }
        ]
    });

    $('#withdraw_list_datatable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '应付查询',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4]
                }
            }
        ]
    });

    $('#deposit_paymenttype_list_datatable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '收入分类查询',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0]
                }
            }
        ]
    });

    $('#withdraw_paymenttype_list_datatable').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        dom: "<'row'<'col-sm-6'<'col-sm-4'l><'col-sm-7'B>><'col-sm-6'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                title: '支出分类查询',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0]
                }
            }
        ]
    });

    $('#mst-orders-customer-history-dataTables').dataTable({
        aLengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        language: {
            "url": "../../../assets/admin/js/Chinese.lang"
        },
        responsive: true,
        scrollX: true,
        order: [[ 21, "desc" ]]
    });

    $('#color_mng_frm, #product_kinds_mng_frm, #accounting_kinds_mng_frm, #units_mng_frm, #tile_category_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: '请输入此字段。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        // Prevent form submission
        //e.preventDefault();

        // Retrieve instances
        //var $form = $(e.target),        // The form instance
        //    fv    = $(e.target).data('formValidation'); // FormValidation instance

        // Do whatever you want here ... ajax request

    });

    $('#accounter_orders_payment_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            order_id: {
                validators: {
                    notEmpty: {
                        message: '请选择订单号。'
                    }
                }
            },
            payer_name: {
                validators: {
                    notEmpty: {
                        message: '请输入汇款人名称。'
                    }
                }
            },
            payer_bank: {
                validators: {
                    notEmpty: {
                        message: '请输入汇款银行。'
                    }
                }
            },
            amount: {
                validators: {
                    notEmpty: {
                        message: '请输入汇款额。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    },
                }
            },
            paid_date: {
                validators: {
                    notEmpty: {
                        message: '请输入汇款时间。'
                    }
                }
            },
            receiver_bank: {
                validators: {
                    notEmpty: {
                        message: '请输入储蓄银行。'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: '请输入备注信息。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
    });

    $('#orders_payment_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            payer_name: {
                validators: {
                    notEmpty: {
                        message: '请输入汇款人名称。'
                    }
                }
            },
            payer_bank: {
                validators: {
                    notEmpty: {
                        message: '请输入汇款银行。'
                    }
                }
            },
            amount: {
                validators: {
                    notEmpty: {
                        message: '请输入汇款额。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    },
                }
            },
            paid_date: {
                validators: {
                    notEmpty: {
                        message: '请输入汇款时间。'
                    }
                }
            },
            receiver_bank: {
                validators: {
                    notEmpty: {
                        message: '请输入储蓄银行。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
    });

    $('#shops_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: '请输入此字段。'
                    }
                }
            },
            address: {
                validators: {
                    notEmpty: {
                        message: '请输入此字段。'
                    }
                }
            },
            contact_person: {
                validators: {
                    notEmpty: {
                        message: '请输入此字段。'
                    }
                }
            },
            contact_phone: {
                validators: {
                    notEmpty: {
                        message: '请输入此字段。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {


    });
    $('#order_transporter_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            order_id: {
                validators: {
                    notEmpty: {
                        message: '请选择订单号。'
                    }
                }
            },
            transporter_name: {
                validators: {
                    notEmpty: {
                        message: '请输入名字。'
                    }
                }
            },
            transporter_phone: {
                validators: {
                    notEmpty: {
                        message: '请输入手机号码。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            transporter_card_no: {
                validators: {
                    notEmpty: {
                        message: '请输入身份证号码。'
                    }
                }
            },
            transporter_car_no: {
                validators: {
                    notEmpty: {
                        message: '请输入车号码。'
                    }
                }
            },
            quantity: {
                validators: {
                    notEmpty: {
                        message: '请输入数量。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    },
                    callback:{
                        message: '提货数量不能超过订单数量。',
                        callback: function(value, validator, $field) {
                            var selected_limit = $('#order_transporter_mng_frm').find('[name="selected_order_limit"]').val();
                            var tiles_per_box_quantity = $('#order_transporter_mng_frm').find('[name="tiles_per_box_quantity"]').val();

                            return ( value*tiles_per_box_quantity <= parseInt(selected_limit)) ? true : false;
                        }
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {


    });

    $('#bank_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            bank_name: {
                validators: {
                    notEmpty: {
                        message: '请输入账户名称。'
                    }
                }
            },
            bank_account_no: {
                validators: {
                    notEmpty: {
                        message: '请输入账号。'
                    }
                }
            },
            balance: {
                validators: {
                    notEmpty: {
                        message: '请输入当前余额。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            basic_balance: {
                validators: {
                    notEmpty: {
                        message: '请输入期初余额。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            bank_account_type: {
                validators: {
                    notEmpty: {
                        message: '请输入账户类型。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {


    });

    $('#payment_type_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            type_name: {
                validators: {
                    notEmpty: {
                        message: '请输入付款分类名。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {


    });

    $('#withdraw_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            withdraw_amount: {
                validators: {
                    notEmpty: {
                        message: '请输入付款分类名。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: '请输入备注信息。'
                    }
                }
            },
            payment_type_id: {
                validators: {
                    notEmpty: {
                        message: '请输入分类。'
                    }
                }
            },
            deposit_user_id: {
                enabled: false,
                validators: {
                    notEmpty: {
                        message: '请输入用户。'
                    },
                    greaterThan: {
                        value:0.9,
                        message: '请输入用户。'
                    },
                }
            }
        }
    }).on('success.form.fv', function(e) {


    });

    $('#deposit_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            withdraw_amount: {
                validators: {
                    notEmpty: {
                        message: '请输入付款分类名。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: '请输入备注信息。'
                    }
                }
            },
            deposit_user_id: {
                enabled: false,
                validators: {
                    notEmpty: {
                        message: '请输入用户。'
                    },
                    greaterThan: {
                        value:0.9,
                        message: '请输入用户。'
                    },
                }
            },
        }
    }).on('success.form.fv', function(e) {


    });

    $("#deposit_mng_frm #payment_type_id").change(function(){
        var type_name = $("#payment_type_id option:selected").text();
        if (type_name == '咖啡加盟金'){
            $("#deposit_user_id_wrapper").show();
            $('#deposit_mng_frm').formValidation('enableFieldValidators', 'deposit_user_id', true)
        } else {
            $("#deposit_user_id_wrapper").hide();
            $('#deposit_mng_frm').formValidation('enableFieldValidators', 'deposit_user_id', false)
        }
    })

    $("#withdraw_mng_frm #payment_type_id").change(function(){
        var type_name = $("#payment_type_id option:selected").text();
        if (type_name == '咖啡加盟金'){
            $("#deposit_user_id_wrapper").show();
            $('#withdraw_mng_frm').formValidation('enableFieldValidators', 'deposit_user_id', true)
        } else {
            $("#deposit_user_id_wrapper").hide();
            $('#withdraw_mng_frm').formValidation('enableFieldValidators', 'deposit_user_id', false)
        }
    })

    $('#groups_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: '请输入此字段。'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: '请输入此字段。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {

    });

    $('#products_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            product_information_id: {
                validators: {
                    notEmpty: {
                        message: '请选择产品编号。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请选择产品编号。'
                    },
                }
            },
            product_type_no: {
                validators: {
                    notEmpty: {
                        message: '请输入产品型号。'
                    }
                }
            },
            product_sn: {
                validators: {
                    notEmpty: {
                        message: '请输入产品编号。'
                    }
                }
            },
            product_license_no: {
                validators: {
                    notEmpty: {
                        message: '请输入产品包装码。'
                    }
                }
            },
            tiles_per_box_quantity: {
                validators: {
                    notEmpty: {
                        message: '请输入箱/片。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            size_width: {
                validators: {
                    notEmpty: {
                        message: '请输入规格。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            size_height: {
                validators: {
                    notEmpty: {
                        message: '请输入规格。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            weight: {
                validators: {
                    notEmpty: {
                        message: '请输入重量。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:0.1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            production_price: {
                validators: {
                    notEmpty: {
                        message: '请输入开单价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            bulk_sale_price: {
                validators: {
                    notEmpty: {
                        message: '请输入工程价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            sale_price: {
                validators: {
                    notEmpty: {
                        message: '请输入店面价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            internet_price: {
                validators: {
                    notEmpty: {
                        message: '请输入网上价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            discount_price: {
                validators: {
                    notEmpty: {
                        message: '请输入折扣。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    }
                }
            },
            loading_fee: {
                validators: {
                    notEmpty: {
                        message: '请输入装车费。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:0.1,
                        message: '请输入一个数大于0.1。'
                    }
                }
            }/*,
            photo_1: {
                validators: {
                    notEmpty: {
                        message: '请输入产品图片。'
                    },
                    file: {
                        extension: 'jpeg,png,jpg',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: '所选的文件是无效的。'
                    }
                }
            },
            photo_2: {
                validators: {
                    notEmpty: {
                        message: '请输入产品图片。'
                    },
                    file: {
                        extension: 'jpeg,png,jpg',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: '所选的文件是无效的。'
                    }
                }
            },
            photo_3: {
                validators: {
                    notEmpty: {
                        message: '请输入产品图片。'
                    },
                    file: {
                        extension: 'jpeg,png,jpg',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: '所选的文件是无效的。'
                    }
                }
            },
            photo_4: {
                validators: {
                    notEmpty: {
                        message: '请输入产品图片。'
                    },
                    file: {
                        extension: 'jpeg,png,jpg',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: '所选的文件是无效的。'
                    }
                }
            },
            photo_5: {
                validators: {
                    notEmpty: {
                        message: '请输入产品图片。'
                    },
                    file: {
                        extension: 'jpeg,png,jpg',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: '所选的文件是无效的。'
                    }
                }
            }*/
        }
    }).on('success.form.fv', function(e) {

    });

    $('#products_detail_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            product_information_id: {
                validators: {
                    notEmpty: {
                        message: '请选择产品编号。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请选择产品编号。'
                    },
                }
            },
            product_license_no: {
                validators: {
                    notEmpty: {
                        message: '请输入批次码。'
                    }
                }
            },
            box_quantity: {
                validators: {
                    notEmpty: {
                        message: '请输入箱。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            /*tiles_per_box_quantity: {
                validators: {
                    notEmpty: {
                        message: '请输入箱/片。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            }*/
        }
    }).on('success.form.fv', function(e) {

    });

    $('#products_loss_detail_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            product_information_id: {
                validators: {
                    notEmpty: {
                        message: '请选择产品编号。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于1。'
                    },
                }
            },
            product_license_no: {
                validators: {
                    notEmpty: {
                        message: '请输入批次码。'
                    }
                }
            },
            box_quantity: {
                validators: {
                    notEmpty: {
                        message: '请输入箱。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    } ,
                    callback:{
                        message: '订单数量不能超过库存。',
                        callback: function(value, validator, $field) {
                            var stock = $('#products_loss_detail_mng_frm').find('[name="stock"]').val();
                            if(stock != "") {
                                var box_quantity = value;
                                var tiles_per_box_quantity = $('#tiles_per_box_quantity').val();
                                var inputed_stock = box_quantity * tiles_per_box_quantity;
                                return (inputed_stock < stock) ? true : false;
                            } else
                                return true;
                        }
                    }
                }
            },
            /*tiles_per_box_quantity: {
             validators: {
             notEmpty: {
             message: '请输入箱/片。'
             },
             numeric: {
             message: '请输入一个恒定值。'
             }
             }
             }*/
        }
    }).on('success.form.fv', function(e) {

    });

    $('#products_loss_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            product_type_no: {
                validators: {
                    notEmpty: {
                        message: '请输入产品型号。'
                    }
                }
            },
            product_sn: {
                validators: {
                    notEmpty: {
                        message: '请输入产品编号。'
                    }
                }
            },
            product_license_no: {
                validators: {
                    notEmpty: {
                        message: '请输入产品包装码。'
                    }
                }
            },
            quantity: {
                validators: {
                    notEmpty: {
                        message: '请输入数量。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            production_price: {
                validators: {
                    notEmpty: {
                        message: '请输入开单价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            bulk_sale_price: {
                validators: {
                    notEmpty: {
                        message: '请输入工程价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            sale_price: {
                validators: {
                    notEmpty: {
                        message: '请输入市场价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            discount_price: {
                validators: {
                    notEmpty: {
                        message: '请输入折扣。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            price: {
                validators: {
                    notEmpty: {
                        message: '请输入金额。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            loss_description: {
                validators: {
                    notEmpty: {
                        message: '请输入损耗描述。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {

    });

    $('#orders_production_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            product_type_no: {
                validators: {
                    notEmpty: {
                        message: '请输入产品型号。'
                    }
                }
            },
            product_sn: {
                validators: {
                    notEmpty: {
                        message: '请输入产品编号。'
                    }
                }
            },
            product_license_no: {
                validators: {
                    notEmpty: {
                        message: '请输入产品包装码。'
                    }
                }
            },
            quantity: {
                validators: {
                    notEmpty: {
                        message: '请输入数量。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            production_price: {
                validators: {
                    notEmpty: {
                        message: '请输入开单价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            bulk_sale_price: {
                validators: {
                    notEmpty: {
                        message: '请输入工程价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            sale_price: {
                validators: {
                    notEmpty: {
                        message: '请输入市场价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            discount_price: {
                validators: {
                    notEmpty: {
                        message: '请输入折扣。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            price: {
                validators: {
                    notEmpty: {
                        message: '请输入金额。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            reservation_amount: {
                validators: {
                    notEmpty: {
                        message: '请输入排产定金。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {

    });

    $("#orders_customer_saler_mng_frm").formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            product_information_id: {
                validators: {
                    notEmpty: {
                        message: '请选择产品编号。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请选择产品编号。'
                    }
                }
            },
            color_id: {
                validators: {
                    notEmpty: {
                        message: '请选择色号。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请选择色号。'
                    }
                }
            },
            box_quantity: {
                validators: {
                    notEmpty: {
                        message: '请输入箱。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    },
                    callback:{
                        message: '订单数量不能超过库存。',
                        callback: function(value, validator, $field) {
                            var stock = $('#orders_customer_saler_mng_frm').find('[name="stock"]').val();
                            if(stock != "") {
                                var box_quantity = value;
                                var tiles_per_box_quantity = $('#tiles_per_box_quantity').val();
                                var inputed_stock = box_quantity * tiles_per_box_quantity;
                                return (inputed_stock <= stock) ? true : false;
                            } else
                                return true;
                        }
                    }
                }
            },
            /*tiles_per_box_quantity: {
                validators: {
                    notEmpty: {
                        message: '请输入箱/片。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    },
                    callback:{
                        message: '订单数量不能超过库存。',
                        callback: function(value, validator, $field) {
                            var stock = $('#orders_customer_saler_mng_frm').find('[name="stock"]').val();
                            if(stock != "") {
                                var tiles_per_box_quantity = value;
                                var box_quantity = $('#box_quantity').val();
                                var inputed_stock = box_quantity * tiles_per_box_quantity;
                                return (inputed_stock < stock) ? true : false;
                            } else
                                return true;
                        }
                    }
                }
            },*/
            item_price: {
                validators: {
                    notEmpty: {
                        message: '请输入价格。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:1,
                        message: '请输入一个数大于0。'
                    },
                }
            },
            order_user_select:{
                validators: {
                    notEmpty: {
                        message: '请选择用户。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    },
                    greaterThan: {
                        value:0,
                        message: '请选择用户。'
                    },
                }
            }
            /*total_price: {
                validators: {
                    notEmpty: {
                        message: '请输入价格。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            customer_name: {
                validators: {
                    callback: {
                        message: '请输入姓名。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 3) ? true : (value !== '');
                        }
                    }
                }
            },
            deposit_bank: {
                validators: {
                    callback: {
                        message: '请输入打款银行。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 3) ? true : (value !== '');
                        }
                    }
                }
            },
            deposit_amount: {
                validators: {
                    callback: {
                        message: '请输入打款金额。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 3) ? true : (value !== '');
                        }
                    }
                }
            },
            deposit_date: {
                validators: {
                    callback: {
                        message: '请输入打款时间。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 3) ? true : (value !== '');
                        }
                    }
                }
            },
            deposit_time: {
                validators: {
                    callback: {
                        message: '请输入打款时间。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 3) ? true : (value !== '');
                        }
                    }
                }
            },
            deposit_item: {
                validators: {
                    callback: {
                        message: '请输入付款款项。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 3) ? true : (value !== '');
                        }
                    }
                }
            },
            customer_name_70: {
                validators: {
                    callback: {
                        message: '请输入姓名。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 5) ? true : (value !== '');
                        }
                    }
                }
            },
            deposit_bank_70: {
                validators: {
                    callback: {
                        message: '请输入打款银行。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 5) ? true : (value !== '');
                        }
                    }
                }
            },
            deposit_amount_70: {
                validators: {
                    callback: {
                        message: '请输入打款金额。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 5) ? true : (value !== '');
                        }
                    }
                }
            },
            deposit_date_70: {
                validators: {
                    callback: {
                        message: '请输入打款时间。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 5) ? true : (value !== '');
                        }
                    }
                }
            },
            deposit_time_70: {
                validators: {
                    callback: {
                        message: '请输入打款时间。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 5) ? true : (value !== '');
                        }
                    }
                }
            },
            deposit_item_70: {
                validators: {
                    callback: {
                        message: '请输入付款款项。',
                        callback: function(value, validator, $field) {
                            var status_id = $('#orders_customer_saler_mng_frm #status_id').val();

                            return (status_id != 5) ? true : (value !== '');
                        }
                    }
                }
            }*/
        }
    }).on('success.form.fv', function(e) {
        var ordered_user = $("#ordered_user_id").val();
        if(ordered_user == 0){

        }
    });

    $('#orders_customer_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            product_information_id: {
                validators: {
                    notEmpty: {
                        message: '请输入产品编号。'
                    }
                }
            },
            quantity: {
                validators: {
                    notEmpty: {
                        message: '请输入数量。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            }/*,
            sale_price: {
                validators: {
                    notEmpty: {
                        message: '请输入市场价。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            customer_name: {
                validators: {
                    notEmpty: {
                        message: '请输入姓名。'
                    }
                }
            },
            shipping_address: {
                validators: {
                    notEmpty: {
                        message: '请输入发货地址。'
                    }
                }
            },
            loading_fee: {
                validators: {
                    notEmpty: {
                        message: '请输入装车费。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            customer_phone: {
                validators: {
                    notEmpty: {
                        message: '请输入联系手机。'
                    }
                }
            },
            deposit_bank: {
                validators: {
                    notEmpty: {
                        message: '请输入打款银行。'
                    }
                }
            },
            deposit_amount: {
                validators: {
                    notEmpty: {
                        message: '请输入打款金额。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            deposit_item: {
                validators: {
                    notEmpty: {
                        message: '请输入付款款项。'
                    }
                }
            }*/
        }
    }).on('success.form.fv', function(e) {

    });

    $('#permission_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            nom: {
                validators: {
                    notEmpty: {
                        message: '请输入页面名称。'
                    }
                }
            },
            ctrl: {
                validators: {
                    notEmpty: {
                        message: '请输入模块名称。'
                    }
                }
            },
            ssctrl: {
                validators: {
                    notEmpty: {
                        message: '请输入控件名称。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
    });

    $(".droit").click(function(){
        url = "permissions/rmPerm";
        if($(this).is(':checked')){
            url = "permissions/addPerm";
        }
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_action: $(this).attr('data-action'),
                id_group: $(this).attr('data-group'),
            }
        });
    });

    $('#distribution_level_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            level_name: {
                validators: {
                    notEmpty: {
                        message: '请输入等级名称。'
                    }
                }
            },
            distribution_ratio: {
                validators: {
                    notEmpty: {
                        message: '请输入1级分销比例。'
                    },
                    numeric: {
                        message: '请输入一个恒定值。'
                    }
                }
            },
            upgrade_condition: {
                validators: {
                    notEmpty: {
                        message: '请输入升级条件。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {


    });

    $('#distributions_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            recommended_person: {
                validators: {
                    notEmpty: {
                        message: '请输入推荐人。'
                    }
                }
            },
            recommended_name: {
                validators: {
                    notEmpty: {
                        message: '请输入姓名。'
                    }
                }
            },
            recommended_phone: {
                validators: {
                    notEmpty: {
                        message: '请输入手机号码。'
                    }
                }
            },
            cumulative_comission: {
                validators: {
                    notEmpty: {
                        message: '请输入累计佣金。'
                    }
                }
            },
            total: {
                validators: {
                    notEmpty: {
                        message: '请输入总计。'
                    }
                }
            },
            status: {
                validators: {
                    notEmpty: {
                        message: '请输入状态。'
                    }
                }
            },
            commissioned: {
                validators: {
                    notEmpty: {
                        message: '请输入已经体现佣金。'
                    }
                }
            },
            no_commission: {
                validators: {
                    notEmpty: {
                        message: '请输入未提现佣金。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {


    });

    $('#posts_mng_frm').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            title: {
                validators: {
                    notEmpty: {
                        message: '请输入标题。'
                    }
                }
            },
            keyword: {
                validators: {
                    notEmpty: {
                        message: '请输入关键词。'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: '请输入描述。'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {


    });

    $('#products_mng_frm .product_photo').change(function(e){
        //if( $('#products_mng_frm').data('formValidation').isValidField($(this).attr("name")) ) {
            var preview_id = "#" + $(this).attr("name") + "_preview";
            //var preview_preview_id = preview_id+"_preview";
            readURL(this, preview_id);
            //readURL(this, preview_preview_id);

            var attr_id = $(this).attr("id");
            var attr = attr_id.split("_");

            var next_id = parseInt(attr[1], 10) + 1;

            if( $(".photo_"+next_id).css("display") == 'none' )
                $(".photo_"+next_id).slideDown(300);

            if ( $("#is_photo_ids").length >0 ){
                var current_id = parseInt(attr[1],10);
                var photo_ids = $("#is_photo_ids").val();
                if(photo_ids != "")
                    photo_ids_arr = photo_ids.split(",").map(Number);
                else
                    photo_ids_arr = [];

                if( photo_ids_arr.indexOf(current_id) === -1 ){
                    photo_ids_arr.push(current_id);
                }

                photo_ids = photo_ids_arr.join(",");
                $("#is_photo_ids").val(photo_ids);
            }
        //}
    });

    $(".user_avatar").change(function(e){
        var preview_id = "#avatar_preview";
        readURL(this, preview_id);
    })

});

function readURL(input, display_id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(display_id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function cancelProductPhoto(photo_ind){

    //$('#products_mng_frm').formValidation('removeField', $(".photo_"+photo_ind).find("[name='photo_"+photo_ind+"']"));
    $(".photo_"+photo_ind).slideUp("300",
        function(){
            $("#photo_"+photo_ind+"_preview").attr("src", $("#default_photo").attr("src"));
            $("#photo_"+photo_ind).val("");

            if ( $("#is_photo_ids").length >0 ){
                var photo_ids = $("#is_photo_ids").val();
                photo_ids_arr = photo_ids.split(",").map(Number);
                if( photo_ids_arr.indexOf(photo_ind) > -1 ){
                    photo_ids_arr.splice(photo_ids_arr.indexOf(photo_ind),1);
                }
                photo_ids = photo_ids_arr.join(",");
                $("#is_photo_ids").val(photo_ids);
            }
        });

}

function addProductPhoto(photo_ind){
    if( $(".photo_"+photo_ind).css("display") == 'none' )
        $(".photo_"+photo_ind).slideDown(300);
}

function calcSalerOrderTotalPrice(){
    var box_quantity = $("#box_quantity").val();
    var tiles_per_box_quantity = $("#tiles_per_box_quantity").val();
    var item_price = $("#item_price").val();

    var total_price = box_quantity * tiles_per_box_quantity * item_price;
    $("#total_price").val(total_price);
    $("#prepay_price").html(total_price*0.3);
    $("#final_price").html(total_price*0.7);

    $("#deposit_amount").val(total_price*0.3);
    $("#deposit_amount_70").val(total_price*0.7);
}

function checkUserRelation(obj){
    var phone = $(obj).val();
    var url = "../../admin/users/get_by_phone/"+phone;

    if(!isNaN(phone)) {
        $.ajax({
            type: "GET",
            url: url,
            contentType: "application/x-www-form-urlencoded;",
            dataType: "json",
            async: false,
            success: function (data) {
                console.log(data);
                if(data.status == "fail"){
                    console.log('here');
                    $("#ratailer_wrap").removeClass("hidden");
                } else
                    $("#ratailer_wrap").addClass("hidden");
            }
        });
    }
}


function drawOrdersCustomerTable(order_type){
    order_dt = $('#orders_customer_datatable').dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "../admin/orders_customer/get_orders_by_type?order_type="+order_type,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "aaSorting": [[0, 'desc']],  // sort desc
        "bInfo": true,
        "bAutoWidth": true,
        "iDisplayLength": 10,
        "destroy": true,
		responsive: true,
        scrollX: true,
        "dom": "<'row'<'col-sm-4'<'col-sm-6'l><'col-sm-6'B>><'#custom_filter.col-sm-4'><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "所有"]],
        "language": {
            "url": "../assets/admin/js/Chinese.lang"
        },
        buttons: [
            {
                extend: 'excelHtml5',
                title: '订单查询',
                text: '下载 Excel',
                className: 'btn btn-success buttons-excel',
                exportOptions: {
                    columns:[0,1,2,3,4,5,6,7,8]
                }
            }
        ],
        "fnServerData": function ( sSource, aoData, fnCallback ) {
            $.getJSON( sSource, aoData, function (json) {
                /* Do whatever additional processing you want on the callback, then tell DataTables */
                var status_sel1='',status_sel2='',status_sel3='';
                if(order_type == 0)
                    status_sel1 = "selected";
                else if (order_type == 1)
                    status_sel2 = "selected";
                else if (order_type == 2)
                    status_sel3 = "selected";

                var custom_filter_html = '<div class="dataTables_length"><label>订单类型: <select onchange="reload_orders_by_type(this)" class="form-control input-sm" id="order_type_filter"><option value="0" '+status_sel1+'>所有</option><option value="1" '+status_sel2+'>用户订单</option><option value="2" '+status_sel3+'>跟单员订单</option></select></label></div>';
                $("#custom_filter").html(custom_filter_html);
                fnCallback(json)
            } );
        }
    });
}

function reload_orders_by_type(obj){
    var type = $(obj).val();
    drawOrdersCustomerTable(type);
}

function formatRepo (repo) {
    if (repo.loading) return repo.text;

    var markup = "<div class='select2-result-repository'>"+repo.nickname+"("+repo.phone+")</div>";

    return markup;
}

function formatRepoSelection (repo) {

    if(repo.id == "-1") return repo.text;

    $("#ordered_user_id").val(repo.id);
    $("#customer_name").val(repo.nickname);
    $("#customer_phone").val(repo.phone);
    return repo.nickname + "(" + repo.phone + ")";
}

function formatRepoPI (repo) {

    if (repo.loading) return repo.text;

    //var markup = "<div class='select2-result-repository'>"+repo.product_sn+"("+repo.color_name+")</div>";
    var markup = "<div class='select2-result-repository'>"+repo.product_sn+"</div>";

    return markup;
}

function formatRepoSelectionPI (repo) {
    console.log('selection pi', repo);

    if(repo.selected == true) return repo.text;


    /*if(repo.id != "-1" ){
        return repo.text;
    }
    else {*/

        $("#product_kind_id").val(repo.kind_name);
        //$("#color_id").val(repo.color_name);
        $("#product_type_no").val(repo.product_type_no);
        //$("#product_license_no").val(repo.product_license_no);
        $("#tiles_per_box_quantity").val(repo.tiles_per_box_quantity);
        $("#size").val(repo.size_width + " x " + repo.size_height);
        $("#weight").val(repo.weight);
        $("#loading_fee").val(repo.loading_fee);
        $("#production_price").val(repo.production_price);
        $("#sale_price").val(repo.sale_price);
        $("#bulk_sale_price").val(repo.bulk_sale_price);
        $("#internet_price").val(repo.internet_price);
        $("#stock").val(repo.stock);
        $("#stock_box").val(repo.stock / repo.tiles_per_box_quantity);

        $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'box_quantity');

        if( $("#orders_customer_saler_mng_frm #color_id").length > 0 ) {
            var url = window.base_url + "admin/products/get_product_colors/" + repo.id;
            $.ajax({
                type: "GET",
                url: url,
                contentType: "application/x-www-form-urlencoded;",
                dataType: "json",
                async: false,
                success: function (data) {
                    $('#color_id').html("");
                    for (var i = 0; i < data.length; i++) {
                        $('#color_id')
                            .append($("<option></option>")
                                .attr("value", data[i].color_id)
                                .text(data[i].color_name));
                    }
                    $('#orders_customer_saler_mng_frm').formValidation('revalidateField', 'color_id');
                }
            });
        }

        //return repo.product_sn + "(" + repo.color_name + ")";
        return repo.product_sn;
    //}
}

function showPaymentHistoryWraper(){
    $("#new_pay_history_wrapper").slideDown();
}

function hidePaymentHistoryWraper(){
    $("#new_pay_history_wrapper").slideUp();
}

function changeOrderPaymentHistoryConfirmStatus(obj, history_id){
    $("#order_payment_confirm_sattus_change_frm #history_id").val(history_id);
    $("#order_payment_confirm_sattus_change_frm #confirm_status").val($(obj).val());
    $("#order_payment_confirm_sattus_change_frm").submit();
}

function showProductDetail(product_id){
    var url = window.base_url + "/admin/product_information/get/"+product_id;
    $.ajax({
        type: "GET",
        url: url,
        contentType: "application/x-www-form-urlencoded;",
        dataType: "json",
        async: false,
        success: function (data) {
            $("#product_sn_detail_mdl #category_name").html(data.category_name);
            $("#product_sn_detail_mdl #kind_name").html(data.kind_name);
            //$("#product_sn_detail_mdl #color_name").html(data.color_name);
            $("#product_sn_detail_mdl #level").html('优等');
            $("#product_sn_detail_mdl #product_type_no").html(data.product_type_no);
            $("#product_sn_detail_mdl #product_sn").html(data.product_sn);
            $("#product_sn_detail_mdl #product_license_no").html(data.product_license_no);
            $("#product_sn_detail_mdl #size").html(data.size_width + " x " + data.size_height);
            $("#product_sn_detail_mdl #weight").html(data.weight);

            $("#product_sn_detail_mdl").modal();
        }
    });
}