<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>咖啡恋陶瓷</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url() ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?= base_url() ?>assets/admin/css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="<?= base_url() ?>assets/admin/css/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="<?= base_url() ?>assets/admin/css/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= base_url() ?>assets/admin/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?= base_url() ?>assets/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- Form Validation -->
        <link href="<?= base_url() ?>assets/admin/css/formValidation.min.css" rel="stylesheet" type="text/css">

        <!-- DatePicker -->
        <link href="<?= base_url() ?>assets/admin/css/datepicker.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>assets/admin/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css">

        <!-- Select2 -->
        <link href="<?= base_url() ?>assets/admin/css/select2.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

        <!-- QR Code  -->
        <script src="<?= base_url() ?>assets/admin/js/qrcode.js"></script>

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= base_url('admin/dashboard') ?>">欢迎 <?=$this->logged_in_name?> | 咖啡恋陶瓷 </a>
                    <a class="navbar-brand" href="#" id="toogleSideMenuIcon" onclick="toggleSideMenu()"> << </a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> 用户信息</a></li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> 设置</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?=  base_url('auth/logout')?>"><i class="fa fa-sign-out fa-fw"></i> 登出</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <!--<li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </li>-->
                            <li><a href="<?= base_url('admin/dashboard') ?>">仪表板</a></li>

                            <?php if ($this->acl->hasPermission("admin","product_information") ): ?>
                            <li>
                                <a href="#">产品管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="<?= base_url('admin/product_information/create') ?>">产品信息添加</a></li>
                                    <li><a href="<?= base_url('admin/product_information') ?>">产品信息管理</a></li>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if ($this->acl->hasPermission("admin","products") || $this->acl->hasPermission("admin","orders/order_transporter_create") || $this->acl->hasPermission("admin","orders/order_transporter_list") ): ?>
                            <li>
                                <a href="#">仓库管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <?php if ($this->acl->hasPermission("admin","products")): ?>
                                    <li><a href="<?= base_url('admin/products/create') ?>">仓储入库</a></li>
                                    <li><a href="<?= base_url('admin/products') ?>">仓储查询</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","orders/order_transporter_create")): ?>
                                    <li><a href="<?= base_url('admin/orders/order_transporter_create') ?>">提货授权录入</a></li>
                                    <?php endif; ?>
                                    <?php if ($this->acl->hasPermission("admin","orders/order_transporter_list")): ?>
                                    <li><a href="<?= base_url('admin/orders/order_transporter_list') ?>">提货授权查询</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","products")): ?>
                                    <li><a href="<?= base_url('admin/product_loss/create') ?>">产品损耗录入</a></li>
                                    <li><a href="<?= base_url('admin/product_loss') ?>">产品损耗查询</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if ($this->acl->hasPermission("admin","orders_customer/saler_create") || $this->acl->hasPermission("admin","orders_customer") ): ?>
                            <li>
                                <a href="#">订单管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <?php if ($this->acl->hasPermission("admin","orders_customer/saler_create") ): ?>
                                    <li><a href="<?= base_url('admin/orders_customer/saler_create') ?>">跟单员订单录入</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","orders_customer") ): ?>
                                    <li><a href="<?= base_url('admin/orders_customer') ?>">订单查询管理</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php /*if ($this->acl->hasPermission("admin","users/distribution") ): */?><!--
                            <li>
                                <a href="#">分销管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li><a href="<?/*= base_url('admin/users/distribution_create') */?>">分销商配置</a></li>
                                    <li><a href="<?/*= base_url('admin/users/distribution_list') */?>">分销商配置管理</a></li>
                                </ul>
                            </li>
                            --><?php /*endif; */?>

                            <?php if ($this->acl->hasPermission("admin","banks") || $this->acl->hasPermission("admin","accounter/orders") || $this->acl->hasPermission("admin","accounter/payment_type") || $this->acl->hasPermission("admin","accounter/withdraw_mng")): ?>
                            <li>
                                <a href="#">财务管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <?php if ($this->logged_in_role == "admin" ): ?>
                                    <li><a href="<?= base_url('admin/banks/create') ?>">银行帐户配置</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","banks") ): ?>
                                    <li><a href="<?= base_url('admin/banks/list') ?>">银行帐户查询</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","accounter/orders") ): ?>
                                    <!--<li><a href="<?/*= base_url('/#') */?>">结算方式配置</a></li>-->
                                    <!--<li><a href="<?/*= base_url('/#') */?>">款项配置</a></li>-->
                                    <li><a href="<?= base_url('admin/accounter/order_payments') ?>">订单收款查询</a></li>
                                    <li><a href="<?= base_url('admin/accounter/regist_order_payment') ?>">订单收款录入</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","accounter/withdraw_mng") ): ?>
                                    <li>
                                        <a href="#">记账管理<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level collapse">
                                            <li><a href="<?= base_url('admin/accounter/deposit_list') ?>">收入</a></li>
                                            <li><a href="<?= base_url('admin/accounter/withdraw_list') ?>">支出</a></li>
                                            <!--<li><a href="<?/*= base_url('admin/accounter/withdraw_create') */?>">付款录入</a></li>-->
                                        </ul>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","accounter/deposit_payment_type") ): ?>
                                        <li><a href="<?= base_url('admin/accounter/deposit_payment_type_list') ?>">收入分类查询</a></li>
                                        <li><a href="<?= base_url('admin/accounter/deposit_payment_type_create') ?>">收入分类配置</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","accounter/withdraw_payment_type") ): ?>
                                        <li><a href="<?= base_url('admin/accounter/withdraw_payment_type_list') ?>">支出分类查询</a></li>
                                        <li><a href="<?= base_url('admin/accounter/withdraw_payment_type_create') ?>">支出分类配置</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if ($this->acl->hasPermission("admin","user-groups") || $this->acl->hasPermission("admin","users") || $this->is_admin ): ?>
                            <li>
                                <a href="#">用户管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <?php if ($this->acl->hasPermission("admin","user-groups") ): ?>
                                    <li><a href="<?= base_url('admin/user-groups') ?>"><i class="fa fa-sitemap fa-fw"></i> 用户组</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","users") ): ?>
                                    <li><a href="<?= base_url('admin/users') ?>"><i class="fa fa-user fa-fw"></i> 用户</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","backend_users") ): ?>
                                        <li><a href="<?= base_url('admin/backend_users') ?>"><i class="fa fa-user fa-fw"></i> 员工</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->is_admin): ?>
                                    <li><a href="<?= base_url('admin/permissions') ?>"><i class="fa fa-eye fa-fw"></i> 权限</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <?php if ($this->acl->hasPermission("admin","colors") || $this->acl->hasPermission("admin","product_kinds") || $this->acl->hasPermission("admin","accounting_kinds") || $this->acl->hasPermission("admin","units") || $this->acl->hasPermission("admin","shops") || $this->acl->hasPermission("admin","shops") ): ?>
                            <li>
                                <a href="#">系统管理<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">

                                    <?php if ($this->acl->hasPermission("admin","tile_category") ): ?>
                                        <li><a href="<?= base_url('admin/tile_category') ?>"><i class="fa fa-circle-o fa-fw"></i> 瓷砖类别</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","colors") ): ?>
                                        <li><a href="<?= base_url('admin/colors') ?>"><i class="fa fa-circle-o fa-fw"></i> 色号配置</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","product_kinds") ): ?>
                                        <li><a href="<?= base_url('admin/product_kinds') ?>"><i class="fa fa-circle-o fa-fw"></i> 产品系列配置</a></li>
                                    <?php endif; ?>

                                    <?php /*if ($this->acl->hasPermission("admin","accounting_kinds") ): */?><!--
                                        <li><a href="<?/*= base_url('admin/accounting_kinds') */?>"><i class="fa fa-circle-o fa-fw"></i> 财务明细类型配置</a></li>
                                    --><?php /*endif; */?>

                                    <?php /*if ($this->acl->hasPermission("admin","units") ): */?><!--
                                        <li><a href="<?/*= base_url('admin/units') */?>"><i class="fa fa-circle-o fa-fw"></i> 单位配置</a></li>
                                    --><?php /*endif; */?>

                                    <?php if ($this->acl->hasPermission("admin","stores") ): ?>
                                        <li><a href="<?= base_url('admin/stores') ?>"><i class="fa fa-circle-o fa-fw"></i> 仓库配置</a></li>
                                    <?php endif; ?>

                                    <?php if ($this->acl->hasPermission("admin","shops") ): ?>
                                        <li><a href="<?= base_url('admin/shops') ?>"><i class="fa fa-circle-o fa-fw"></i> 咖啡店管理</a></li>
                                    <?php endif; ?>

                                </ul>
                            </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>