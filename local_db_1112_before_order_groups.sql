/*
SQLyog Ultimate v8.3 
MySQL - 5.6.16 : Database - code
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`code` /*!40100 DEFAULT CHARACTER SET utf8 */;

/*Table structure for table `acl_action` */

DROP TABLE IF EXISTS `acl_action`;

CREATE TABLE `acl_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(200) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `acl_action` */

insert  into `acl_action`(`id`,`path`,`description`) values (1,'admin/products','产品入库'),(2,'admin/product_loss','产品损耗'),(3,'admin/orders_production','后台生产订单'),(5,'admin/user-groups','用户组'),(6,'admin/users','用户'),(7,'admin/colors','色号配置'),(8,'admin/product_kinds','产品序列配置'),(9,'admin/accounting_kinds','财务明细类型配置'),(10,'admin/units','单位配置'),(11,'admin/shops','咖啡店管理'),(12,'admin/distribution_level','分销商等级配置'),(13,'admin/distributions','分销商管理'),(14,'admin/posts','文章管理'),(15,'admin/product_information','产品信息'),(16,'admin/tile_category','瓷砖类别'),(17,'admin/stores','仓库管理'),(19,'admin/banks','银行帐户配置'),(20,'admin/orders/order_transporter_create','提货授权'),(21,'admin/orders_customer/saler_create','跟单员订单录入'),(22,'admin/orders_customer','订单查询管理'),(23,'admin/users/distribution','分销管理'),(24,'admin/accounter/orders','收款'),(25,'admin/orders/order_transporter_list',' 提货授权查询'),(26,'admin/accounter/payment_type','付款分类'),(27,'admin/accounter/withdraw_mng','付款管理'),(28,'admin/backend_users','员工'),(29,'admin/accounter/deposit_payment_type','收入分类查询'),(30,'admin/accounter/withdraw_payment_type','支出分类查询');

/*Table structure for table `brands` */

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `created_from_ip` varchar(100) NOT NULL,
  `updated_from_ip` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `brands` */

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `created_from_ip` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

insert  into `categories`(`id`,`description`,`created_from_ip`,`date_created`,`date_updated`) values (1,'aa1','','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `group_action` */

DROP TABLE IF EXISTS `group_action`;

CREATE TABLE `group_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_group` int(11) DEFAULT NULL,
  `id_action` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

/*Data for the table `group_action` */

insert  into `group_action`(`id`,`id_group`,`id_action`) values (1,1,1),(10,1,5),(12,1,8),(13,1,11),(14,1,2),(16,1,3),(17,1,10),(18,1,9),(19,1,7),(20,1,6),(39,1,12),(40,1,13),(42,1,14),(43,1,15),(44,1,16),(45,1,17),(49,1,19),(51,1,20),(52,1,21),(53,1,22),(54,1,23),(55,1,24),(56,6,21),(59,6,24),(60,6,19),(61,6,22),(62,6,25),(63,1,25),(64,1,26),(66,3,26),(67,1,27),(68,3,27),(69,1,28),(70,1,29),(71,1,30);

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `user_type` enum('frontend','backend') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`,`user_type`) values (1,'admin','系统管理人员','backend'),(2,'agency','总经销商','frontend'),(3,'accounter','财务人员','backend'),(4,'consumer','消费者','frontend'),(5,'business_user','业务员','frontend'),(6,'saler','跟单员','backend'),(7,'sub_agency','分销商','frontend'),(8,'store_manager','仓库管理者','backend'),(9,'processor','工程客户','frontend');

/*Table structure for table `groups_permissions` */

DROP TABLE IF EXISTS `groups_permissions`;

CREATE TABLE `groups_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `value` tinyint(4) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roleID_2` (`group_id`,`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `groups_permissions` */

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `login_attempts` */

/*Table structure for table `mst_accounting_kinds` */

DROP TABLE IF EXISTS `mst_accounting_kinds`;

CREATE TABLE `mst_accounting_kinds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kind_name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mst_accounting_kinds` */

/*Table structure for table `mst_banks` */

DROP TABLE IF EXISTS `mst_banks`;

CREATE TABLE `mst_banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_account_no` varchar(100) DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `basic_balance` double DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `bank_account_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1003 DEFAULT CHARSET=utf8;

/*Data for the table `mst_banks` */

insert  into `mst_banks`(`id`,`bank_name`,`bank_account_no`,`balance`,`basic_balance`,`reg_date`,`bank_account_type`) values (1000,'人民银行','189984930293087',152,1000,'2016-10-19 03:42:05','颇通账户'),(1002,'工商银行','123883928485',187,100,'2016-10-19 04:29:56','用户账户');

/*Table structure for table `mst_colors` */

DROP TABLE IF EXISTS `mst_colors`;

CREATE TABLE `mst_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `mst_colors` */

insert  into `mst_colors`(`id`,`name`) values (1,'红色'),(2,'蓝色'),(3,'绿色'),(4,'黄色');

/*Table structure for table `mst_order_status` */

DROP TABLE IF EXISTS `mst_order_status`;

CREATE TABLE `mst_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) DEFAULT NULL,
  `description` text,
  `show_level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `mst_order_status` */

insert  into `mst_order_status`(`id`,`status_name`,`description`,`show_level`) values (1,'未支付',NULL,1),(2,'待支付预付款',NULL,1),(3,'已支付预付款','30% paid',1),(4,'带支付尾款',NULL,2),(5,'已支付尾款','70% paid',2),(6,'撤销','order canceled\r\n',1),(7,'带发货','same as 5',3),(8,'已发货','final staths',3);

/*Table structure for table `mst_order_type` */

DROP TABLE IF EXISTS `mst_order_type`;

CREATE TABLE `mst_order_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `mst_order_type` */

insert  into `mst_order_type`(`id`,`type_name`) values (1,'消费者订单'),(2,'普通订单'),(3,'工程订单');

/*Table structure for table `mst_payment_types` */

DROP TABLE IF EXISTS `mst_payment_types`;

CREATE TABLE `mst_payment_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  `kind` enum('deposit','withdraw') DEFAULT 'deposit',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `mst_payment_types` */

insert  into `mst_payment_types`(`id`,`type_name`,`kind`) values (1,'比如采购123','deposit'),(2,'加盟金1','deposit'),(5,'withdraw','deposit'),(6,'test','withdraw'),(7,'sdfs1','withdraw'),(8,'咖啡加盟金','withdraw'),(9,'咖啡加盟金','deposit');

/*Table structure for table `mst_product_kinds` */

DROP TABLE IF EXISTS `mst_product_kinds`;

CREATE TABLE `mst_product_kinds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kind_name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `mst_product_kinds` */

insert  into `mst_product_kinds`(`id`,`kind_name`,`description`) values (1,'金刚釉系列',NULL),(2,'金刚微晶石系列',NULL),(3,'大理石系列',NULL),(4,'大理石Ⅱ系列',NULL),(5,'仿古水泥砖系列',NULL),(6,'田园风系列',NULL);

/*Table structure for table `mst_shops` */

DROP TABLE IF EXISTS `mst_shops`;

CREATE TABLE `mst_shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(100) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `mst_shops` */

insert  into `mst_shops`(`id`,`shop_name`,`address`,`contact_person`,`contact_phone`,`reg_date`) values (1,'aaa1','a','a','a','2016-11-08 07:56:12');

/*Table structure for table `mst_stores` */

DROP TABLE IF EXISTS `mst_stores`;

CREATE TABLE `mst_stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `mst_stores` */

insert  into `mst_stores`(`id`,`store_name`) values (1,'仓库1'),(2,'仓库2');

/*Table structure for table `mst_tile_category` */

DROP TABLE IF EXISTS `mst_tile_category`;

CREATE TABLE `mst_tile_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `mst_tile_category` */

insert  into `mst_tile_category`(`id`,`category_name`) values (1,'Category1'),(2,'Category2');

/*Table structure for table `mst_units` */

DROP TABLE IF EXISTS `mst_units`;

CREATE TABLE `mst_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `mst_units` */

insert  into `mst_units`(`id`,`unit_name`,`description`) values (1,'片',NULL),(2,'箱',NULL);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_key` varchar(30) NOT NULL,
  `perm_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permKey` (`perm_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `permissions` */

/*Table structure for table `tbl_bonus_history` */

DROP TABLE IF EXISTS `tbl_bonus_history`;

CREATE TABLE `tbl_bonus_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bonus_amount` double DEFAULT NULL,
  `bonus_date` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_bonus_history` */

/*Table structure for table `tbl_deposit_history` */

DROP TABLE IF EXISTS `tbl_deposit_history`;

CREATE TABLE `tbl_deposit_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) DEFAULT NULL,
  `withdraw_amount` double DEFAULT NULL,
  `payment_type_id` int(11) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `description` text,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_deposit_history` */

insert  into `tbl_deposit_history`(`id`,`bank_id`,`withdraw_amount`,`payment_type_id`,`reg_date`,`description`,`user_id`) values (1,1000,60,2,'2016-10-22 11:45:43','ttt',7),(2,1000,20,2,'2016-10-22 11:48:30','test',8),(3,1002,30,1,'2016-10-23 02:18:32','23',-1),(4,1000,34,1,'2016-10-23 02:19:07','sf',-1),(6,1000,34,1,'2016-10-23 02:20:39','sf',-1),(7,1000,60,1,'2016-10-23 02:20:46','sdfg',-1),(8,1002,1,5,'2016-10-30 02:15:34','广泛',-1);

/*Table structure for table `tbl_distribution_level` */

DROP TABLE IF EXISTS `tbl_distribution_level`;

CREATE TABLE `tbl_distribution_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(255) DEFAULT NULL,
  `distribution_ratio` double DEFAULT NULL,
  `upgrade_condition` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_distribution_level` */

/*Table structure for table `tbl_distributions` */

DROP TABLE IF EXISTS `tbl_distributions`;

CREATE TABLE `tbl_distributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recommended_person` varchar(100) DEFAULT NULL,
  `recommended_name` varchar(100) DEFAULT NULL,
  `recommended_phone` varchar(100) DEFAULT NULL,
  `distribution_level_id` int(11) DEFAULT NULL,
  `cumulative_comission` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `reg_time` varchar(20) DEFAULT NULL,
  `commissioned` varchar(255) DEFAULT NULL,
  `no_commission` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_distributions` */

/*Table structure for table `tbl_orders_customer` */

DROP TABLE IF EXISTS `tbl_orders_customer`;

CREATE TABLE `tbl_orders_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) DEFAULT NULL,
  `box_quantity` int(11) DEFAULT '0',
  `tiles_per_box_quantity` int(11) DEFAULT '0',
  `sale_price` double DEFAULT NULL,
  `total_price` double DEFAULT '0',
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_name_70` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(100) DEFAULT NULL,
  `deposit_bank` varchar(255) DEFAULT NULL,
  `deposit_bank_70` varchar(255) DEFAULT NULL,
  `deposit_amount` double DEFAULT NULL,
  `deposit_amount_70` double DEFAULT NULL,
  `deposit_date` varchar(20) DEFAULT NULL,
  `deposit_date_70` varchar(20) DEFAULT NULL,
  `deposit_time` varchar(20) DEFAULT NULL,
  `deposit_time_70` varchar(20) DEFAULT NULL,
  `deposit_item` varchar(255) DEFAULT NULL,
  `deposit_item_70` varchar(255) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `order_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT '1',
  `order_type_id` int(11) NOT NULL DEFAULT '1',
  `creator_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_orders_customer` */

insert  into `tbl_orders_customer`(`id`,`quantity`,`box_quantity`,`tiles_per_box_quantity`,`sale_price`,`total_price`,`customer_name`,`customer_name_70`,`shipping_address`,`customer_phone`,`deposit_bank`,`deposit_bank_70`,`deposit_amount`,`deposit_amount_70`,`deposit_date`,`deposit_date_70`,`deposit_time`,`deposit_time_70`,`deposit_item`,`deposit_item_70`,`status_id`,`order_date`,`user_id`,`product_id`,`color_id`,`order_type_id`,`creator_id`) values (2,10,0,0,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2016-10-04 17:23:04',6,5,1,1,0),(3,4,0,0,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,'2016-10-04 17:24:19',6,3,1,1,0),(4,5,0,0,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2016-10-04 17:28:10',6,4,1,1,0),(5,5,0,0,120,NULL,'全哥','全哥','广州 ','123454','人民银行','人民银行',30,70,'2016-10-06','2016-10-12','05:45 PM','05:45 PM','美','美',8,'2016-10-06 08:37:33',7,9,1,1,0),(6,12,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2016-10-06 18:25:58',4,6,1,1,0),(7,5,0,0,130,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2016-10-07 07:20:39',6,3,1,1,0),(8,4,0,0,130,NULL,'全','','','','工商银行','',140,0,'2016-10-10','','01:30 PM','01:30 PM','呵','',3,'2016-10-07 07:41:47',6,3,1,1,0),(9,10,0,0,130,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2016-10-07 17:01:17',6,9,1,1,0),(10,5,0,0,95,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2016-10-07 17:10:06',6,1,1,1,0),(11,5,0,0,90,NULL,'a','b','test','test','a','bb',45,23,'2016-10-07','2016-10-25','11:45 PM','12:30 AM','aa','bbb',8,'2016-10-07 18:01:25',1,1,1,1,0),(12,NULL,0,0,120,NULL,'',NULL,'','','',NULL,0,NULL,'2016-10-12',NULL,'10:30 AM',NULL,'',NULL,1,'2016-10-12 04:37:26',1,9,1,1,0),(13,50,0,0,120,NULL,'QuanTest','QuanTest','test','58638449','工商银行','工商银行',1575,1575,'2016-10-12','2016-10-12','12:30 PM','12:30 PM','呵','呵',2,'2016-10-12 06:40:16',27,9,1,3,0),(14,1,1,1,105,105,NULL,NULL,'','3234542',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'2016-10-13 14:44:25',6,9,1,2,0),(15,200,10,20,120.5,24100,'陈明','沉沉','','13123451234','人民银行','人民银行',7230,16870,'2016-10-14','2016-10-14','09:00 AM','09:00 AM','30%','70%',8,'2016-10-14 03:01:41',6,9,1,3,0),(16,100,5,20,105,10500,'','','','','','',3150,7350,'2016-10-14','','11:45 AM','11:45 AM','','',8,'2016-10-14 05:55:33',8,9,1,2,0),(17,1,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'2016-10-19 19:19:29',6,1,1,2,4),(18,23,1,23,15,345,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'2016-10-21 10:13:59',4,16,1,2,1),(19,10,1,10,25,250,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'2016-10-21 11:11:19',6,10,1,2,1),(21,2,2,1,3,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'2016-11-10 15:16:56',4,18,1,2,1),(22,10,1,10,15,150,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'2016-11-10 16:43:30',11,10,1,2,1),(23,10,1,10,18,180,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'2016-11-10 16:54:08',28,10,3,2,1);

/*Table structure for table `tbl_orders_customer_history` */

DROP TABLE IF EXISTS `tbl_orders_customer_history`;

CREATE TABLE `tbl_orders_customer_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `modify_date` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_orders_customer_history` */

insert  into `tbl_orders_customer_history`(`id`,`order_id`,`status_id`,`modify_date`,`user_id`) values (1,1,1,NULL,1),(2,1,1,'2016-09-28 17:34:40',1),(3,1,3,'2016-09-28 17:48:29',1),(9,8,3,'2016-10-07 07:46:03',1),(10,11,1,'2016-10-07 18:40:19',1),(11,11,8,'2016-10-07 19:03:33',1),(19,5,8,'2016-10-08 08:04:36',1),(20,13,2,'2016-10-12 07:12:47',1),(31,16,3,'2016-10-14 10:14:07',1),(32,16,4,'2016-10-14 10:15:20',1),(33,16,5,'2016-10-14 10:16:03',1),(34,16,7,'2016-10-14 10:16:31',1),(35,16,8,'2016-10-14 10:17:30',1),(37,15,3,'2016-10-14 14:49:57',1),(38,15,5,'2016-10-14 14:50:29',1),(39,15,8,'2016-10-14 14:50:42',1),(40,14,2,'2016-10-16 04:29:07',1);

/*Table structure for table `tbl_orders_customer_transporters` */

DROP TABLE IF EXISTS `tbl_orders_customer_transporters`;

CREATE TABLE `tbl_orders_customer_transporters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `transporter_name` varchar(200) DEFAULT NULL,
  `transporter_phone` varchar(50) DEFAULT NULL,
  `transporter_card_no` varchar(100) DEFAULT NULL,
  `transporter_car_no` varchar(100) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `send_status` enum('yes','no') DEFAULT 'no',
  `creator_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_orders_customer_transporters` */

insert  into `tbl_orders_customer_transporters`(`id`,`order_id`,`transporter_name`,`transporter_phone`,`transporter_card_no`,`transporter_car_no`,`quantity`,`send_status`,`creator_id`) values (1,16,'张华','19883472748','磁能737840303','辽B-37347',40,'no',0),(2,15,'张华','344563','34654234','辽B-3221',50,'no',0);

/*Table structure for table `tbl_orders_payment_history` */

DROP TABLE IF EXISTS `tbl_orders_payment_history`;

CREATE TABLE `tbl_orders_payment_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `paid_date` varchar(20) DEFAULT NULL,
  `paid_type` enum('prepay','finalpay','totalpay') DEFAULT NULL,
  `payer_name` varchar(200) DEFAULT NULL,
  `payer_bank` varchar(200) DEFAULT NULL,
  `pay_confirm_status` enum('yes','no') DEFAULT 'no',
  `receiver_bank` int(11) DEFAULT NULL,
  `confirmer_id` int(11) DEFAULT '0',
  `creator_id` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_orders_payment_history` */

insert  into `tbl_orders_payment_history`(`id`,`order_id`,`amount`,`paid_date`,`paid_type`,`payer_name`,`payer_bank`,`pay_confirm_status`,`receiver_bank`,`confirmer_id`,`creator_id`,`description`) values (1,14,1200,'2016-10-16 10:50 AM','prepay','咚咚','人民银行','yes',1000,3,1,NULL),(2,14,100,'2016-10-16 11:45 AM','prepay','咚咚','人民银行','yes',1000,3,1,NULL),(3,13,800,'2016-10-16 12:45 PM','prepay','朝朝','工商银行','yes',1002,3,3,NULL),(4,14,100,'2016-10-16 02:00 PM','prepay','咚咚','人民银行','yes',1002,3,1,NULL),(5,10,100,'2016-10-19 10:45 AM','prepay','阿华润','人民银行','yes',1002,3,1,NULL),(6,10,100,'2016-10-19 10:45 AM','prepay','10','人民银行','yes',1000,3,1,'广泛'),(7,9,1000,'2016-10-19 10:00 PM','totalpay','咚咚','人民银行','no',1000,0,1,'广泛');

/*Table structure for table `tbl_orders_production` */

DROP TABLE IF EXISTS `tbl_orders_production`;

CREATE TABLE `tbl_orders_production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_kind_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `product_type_no` varchar(255) DEFAULT NULL,
  `product_sn` varchar(255) DEFAULT NULL,
  `product_license_no` varchar(255) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `production_price` double DEFAULT NULL,
  `bulk_sale_price` double DEFAULT NULL,
  `sale_price` double DEFAULT NULL,
  `discount_price` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `reservation_amount` double DEFAULT NULL,
  `reservation_date` varchar(20) DEFAULT NULL,
  `reservation_time` varchar(20) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_orders_production` */

/*Table structure for table `tbl_posts` */

DROP TABLE IF EXISTS `tbl_posts`;

CREATE TABLE `tbl_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` text,
  `contents` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_posts` */

/*Table structure for table `tbl_products` */

DROP TABLE IF EXISTS `tbl_products`;

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_information_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `box_quantity` int(11) DEFAULT NULL,
  `tiles_per_box_quantity` int(11) DEFAULT NULL,
  `product_license_no` varchar(100) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `reg_time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_products` */

insert  into `tbl_products`(`id`,`product_information_id`,`color_id`,`box_quantity`,`tiles_per_box_quantity`,`product_license_no`,`store_id`,`reg_date`,`reg_time`) values (3,9,1,4,20,NULL,2,'2016-10-07','01:00 PM'),(4,9,1,3,45,NULL,1,'2016-10-07','11:15 PM'),(5,1,4,4,25,NULL,1,'2016-10-07','11:30 PM'),(6,9,1,30,30,NULL,1,'2016-10-14','03:45 PM'),(7,9,1,10,10,NULL,1,'2016-10-19','07:15 PM'),(8,15,3,5,10,NULL,1,'2016-10-21','01:15 PM'),(9,16,1,5,NULL,'SN-20161007-021',1,'2016-10-21','03:30 PM'),(10,16,1,4,23,'SN-20161007-02',1,'2016-10-21','03:45 PM'),(11,10,1,3,10,'TK12312312312',1,'2016-10-21','05:00 PM'),(12,18,2,2,1,'2',1,'2016-11-08','06:00 PM'),(14,18,4,3,1,'2',1,'2016-11-10','11:15 PM'),(15,10,3,5,10,'6df',1,'2016-11-10','11:45 PM');

/*Table structure for table `tbl_products_copy` */

DROP TABLE IF EXISTS `tbl_products_copy`;

CREATE TABLE `tbl_products_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_kind_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `product_type_no` varchar(255) DEFAULT NULL,
  `product_sn` varchar(255) DEFAULT NULL,
  `product_license_no` varchar(255) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `production_price` double DEFAULT NULL,
  `bulk_sale_price` double DEFAULT NULL,
  `sale_price` double DEFAULT NULL,
  `internet_price` double DEFAULT NULL,
  `discount_price` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `loading_fee` double DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `photo_1` varchar(255) DEFAULT NULL,
  `photo_1_mimetype` varchar(20) DEFAULT NULL,
  `photo_2` varchar(255) DEFAULT NULL,
  `photo_2_mimetype` varchar(20) DEFAULT NULL,
  `photo_3` varchar(255) DEFAULT NULL,
  `photo_3_mimetype` varchar(20) DEFAULT NULL,
  `photo_4` varchar(255) DEFAULT NULL,
  `photo_4_mimetype` varchar(20) DEFAULT NULL,
  `photo_5` varchar(255) DEFAULT NULL,
  `photo_5_mimetype` varchar(20) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_products_copy` */

insert  into `tbl_products_copy`(`id`,`product_kind_id`,`color_id`,`product_type_no`,`product_sn`,`product_license_no`,`unit_id`,`quantity`,`production_price`,`bulk_sale_price`,`sale_price`,`internet_price`,`discount_price`,`price`,`loading_fee`,`reg_date`,`photo_1`,`photo_1_mimetype`,`photo_2`,`photo_2_mimetype`,`photo_3`,`photo_3_mimetype`,`photo_4`,`photo_4_mimetype`,`photo_5`,`photo_5_mimetype`,`description`) values (1,1,1,'1','234','3',1,11,302,252,5,5,22,23,8,'2016-09-30 04:32:42','1_1.PNG','image/png','','','','','','','','','<p>product 1</p>\r\n'),(2,2,1,'1234','2345','SN-27812',1,11,302,16,17,5,22,23,8,'2016-10-04 06:31:38','2_1.PNG','image/png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'<p>product 2</p>\r\n'),(3,3,1,'123','2','SN-27817',1,11,15,22,5,5,22,23,8,'2016-10-04 06:32:18','3_1.PNG','image/png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'<p>product 3</p>\r\n'),(4,4,1,'123','2','SN-27812',1,11,11,252,5,5,22,292,0.52,'2016-10-04 06:32:51','4_1.PNG','image/png','','','','','','','','','<p>product 4</p>\r\n\r\n<p><img alt=\"\" src=\"http://www.quanweblocal.com/coffee_love_ceramics/assets/admin/images/355386f.png\" style=\"height:985px; width:1758px\" /></p>\r\n'),(5,1,1,'DKSL-82234','234','SN-27812',1,11,15,16,17,5,22,23,8,'2016-10-04 12:10:10','5_1.PNG','image/png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'<p>product 1-1</p>\r\n'),(6,1,1,'碎花瓷砖','SKU-P-01','SN-20161007-01',NULL,NULL,80,85,95,100,5,NULL,10,'2016-10-06 18:08:26','6_1.PNG','image/png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'<p>Product Information 1</p>\r\n');

/*Table structure for table `tbl_products_informations` */

DROP TABLE IF EXISTS `tbl_products_informations`;

CREATE TABLE `tbl_products_informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tile_category_id` int(11) DEFAULT NULL,
  `product_kind_id` int(11) DEFAULT NULL,
  `product_type_no` varchar(255) DEFAULT NULL,
  `product_sn` varchar(255) DEFAULT NULL,
  `tiles_per_box_quantity` double DEFAULT '0',
  `size_width` double DEFAULT NULL,
  `size_height` double DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `production_price` double DEFAULT NULL,
  `bulk_sale_price` double DEFAULT NULL,
  `sale_price` double DEFAULT NULL,
  `internet_price` double DEFAULT NULL,
  `discount_price` double DEFAULT NULL,
  `loading_fee` double DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `photo_1` varchar(255) DEFAULT '',
  `photo_1_mimetype` varchar(20) DEFAULT NULL,
  `photo_2` varchar(255) DEFAULT '',
  `photo_2_mimetype` varchar(20) DEFAULT NULL,
  `photo_3` varchar(255) DEFAULT '',
  `photo_3_mimetype` varchar(20) DEFAULT NULL,
  `photo_4` varchar(255) DEFAULT '',
  `photo_4_mimetype` varchar(20) DEFAULT NULL,
  `photo_5` varchar(255) DEFAULT '',
  `photo_5_mimetype` varchar(20) DEFAULT NULL,
  `description` text,
  `stock` int(11) DEFAULT '0',
  `real_stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_products_informations` */

insert  into `tbl_products_informations`(`id`,`tile_category_id`,`product_kind_id`,`product_type_no`,`product_sn`,`tiles_per_box_quantity`,`size_width`,`size_height`,`weight`,`production_price`,`bulk_sale_price`,`sale_price`,`internet_price`,`discount_price`,`loading_fee`,`reg_date`,`photo_1`,`photo_1_mimetype`,`photo_2`,`photo_2_mimetype`,`photo_3`,`photo_3_mimetype`,`photo_4`,`photo_4_mimetype`,`photo_5`,`photo_5_mimetype`,`description`,`stock`,`real_stock`) values (1,2,4,'碎花地砖1','SKU-01',0,500,500,0.8,80,85,90,95,7,20,'2016-10-06 18:17:03','1_1.PNG','image/png','1_2.PNG','image/png','','','','','','','<p>product information 1</p>\r\n',60,60),(9,1,1,'碎花地砖','SKU-02',15,800,800,0.6,100,110,120,130,6,10,'2016-10-07 02:35:18','9_1.PNG','image/png','',NULL,'',NULL,'',NULL,'',NULL,'',480,725),(10,2,4,'碎花地砖','JKY-6789',10,500,500,1,10,20,30,40,1,2,'2016-10-21 05:58:31','10_1.PNG','image/png','',NULL,'',NULL,'',NULL,'',NULL,'<p>ttt</p>\r\n',70,80),(15,1,1,'碎花地砖','JKY-6789',10,400,400,1,10,110,30,40,1,2,'2016-10-21 06:55:18','','','','','','','','','','','',50,50),(16,2,5,'碎花地砖','JKY-67891',23,400,500,1,10,20,30,40,1,2,'2016-10-21 09:31:52','','','','','','','','','','','',0,92),(17,1,1,'sgd','dfg',2,21,12,32,12,23,12,23,1,1,'2016-11-08 04:37:03','',NULL,'',NULL,'',NULL,'',NULL,'',NULL,'',0,NULL),(18,2,6,'碎花地砖','SKU-021',1,23,23,32,12,23,43,23,44,12,'2016-11-08 10:43:49','','','','','','','','','','','',5,5);

/*Table structure for table `tbl_products_loss` */

DROP TABLE IF EXISTS `tbl_products_loss`;

CREATE TABLE `tbl_products_loss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_information_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `box_quantity` int(11) DEFAULT NULL,
  `tiles_per_box_quantity` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `reg_time` varchar(20) DEFAULT NULL,
  `loss_description` text,
  `confirmed` enum('yes','no') DEFAULT 'no',
  `confirmer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_products_loss` */

insert  into `tbl_products_loss`(`id`,`product_information_id`,`color_id`,`box_quantity`,`tiles_per_box_quantity`,`store_id`,`reg_date`,`reg_time`,`loss_description`,`confirmed`,`confirmer_id`) values (2,9,3,6,15,1,'2016-10-22','04:30 PM','<p>test</p>\r\n','yes',1),(3,10,3,1,10,1,'2016-11-10','02:45 PM','<p>aa</p>\r\n','yes',1);

/*Table structure for table `tbl_products_loss_copy` */

DROP TABLE IF EXISTS `tbl_products_loss_copy`;

CREATE TABLE `tbl_products_loss_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_kind_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `product_type_no` varchar(255) DEFAULT NULL,
  `product_sn` varchar(255) DEFAULT NULL,
  `product_license_no` varchar(255) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `production_price` double DEFAULT NULL,
  `bulk_sale_price` double DEFAULT NULL,
  `sale_price` double DEFAULT NULL,
  `discount_price` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `loss_description` text,
  `reg_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_products_loss_copy` */

/*Table structure for table `tbl_users_bonus_history` */

DROP TABLE IF EXISTS `tbl_users_bonus_history`;

CREATE TABLE `tbl_users_bonus_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `order_history_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_users_bonus_history` */

insert  into `tbl_users_bonus_history`(`id`,`user_id`,`amount`,`order_history_id`) values (1,4,723,27),(2,6,630,28),(3,8,-38.456,28),(4,7,-3.344,28),(5,6,630,35),(6,8,-38.456,35),(7,7,-3.344,35),(8,4,723,39);

/*Table structure for table `tbl_withdraw_history` */

DROP TABLE IF EXISTS `tbl_withdraw_history`;

CREATE TABLE `tbl_withdraw_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) DEFAULT NULL,
  `withdraw_amount` double DEFAULT NULL,
  `payment_type_id` int(11) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `description` text,
  `join_fee_user_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_withdraw_history` */

insert  into `tbl_withdraw_history`(`id`,`bank_id`,`withdraw_amount`,`payment_type_id`,`reg_date`,`description`,`join_fee_user_id`) values (1,1000,1,1,'2016-10-20 09:02:20','test',0),(3,1000,150,1,'2016-10-20 09:07:29','test',0),(4,1000,150,1,'2016-10-20 09:08:05','test',0),(7,1002,60,2,'2016-10-22 11:56:05','test',0),(8,1000,35,7,'2016-11-11 09:05:42','aa',0),(9,1002,45,7,'2016-11-11 09:06:09','sdg',0),(10,1002,44,8,'2016-11-11 09:10:09','aa',0),(11,1002,55,8,'2016-11-11 09:59:57','red color1',0),(12,1000,70,6,'2016-11-11 10:12:34','aa',8);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `join_fee` double DEFAULT '0',
  `shares` double DEFAULT '0',
  `bonus` double DEFAULT '0',
  `balance` double DEFAULT '0',
  `benefit` double DEFAULT '0',
  `access_token` varchar(200) DEFAULT NULL,
  `expires_in` varchar(30) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `PhoneUnique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`nickname`,`company`,`phone`,`join_fee`,`shares`,`bonus`,`balance`,`benefit`,`access_token`,`expires_in`,`avatar`,`parent_id`) values (1,'127.0.0.1','ADMIN','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,'aGwZaX74Z9BSn8/Yqfygye',1268889823,1478922974,1,'Admin','istrator','张学','ADMIN','198201942',0,0,0,-193,0,'','','1475646160my_photo.png',0),(3,'127.0.0.1','test','$2y$08$iHZ1cUh234J/NXeMJ7UlLuAt8L0kndJ6PoOHAtJxarYYfA9vFVZx6',NULL,'accounter@test.com',NULL,NULL,NULL,NULL,1474618589,1476895171,1,'test','test','张三',NULL,'1',0,0,0,0,0,'289a07731a150bd2a8b06dae3ac3e59b','1475630763','1475649071jensleh.PNG',0),(4,'127.0.0.1','Saler','$2y$08$B00876bG22186Y9k0KtwMe3e3l3WWItKXETiIhMIA3AzYaLbasRUe',NULL,'sale@sale.com',NULL,NULL,NULL,NULL,1475065414,1478793798,1,'sale','sale','saler',NULL,'1234567',0,0,1447,0,0,'c52e27eaa3d8837ca50a4205806d7fd1','1478880199',NULL,0),(6,'127.0.0.1','张三6','$2y$08$wPeTQAa6QHD.qO0JRfhdHORNZYMVGjPIBHkXeayNdAwHvNskDQRaq',NULL,'cosumer@consumer.com',NULL,NULL,NULL,NULL,1475586999,1475945313,1,'Con','Sumer','张三6',NULL,'123456',0,0,1270,-15360,0,'9d3d047d7846639fc2da573438fb58ae','1476031713','1475646749quan.png',4),(7,'127.0.0.1','zhang','$2y$08$AwThAatJ1KAP12OD9Yn8QuSNjmdmJoCp.NBVlkuzaPHWepwGVcGV6',NULL,'agency@admin.com',NULL,NULL,NULL,NULL,1475644798,1475919230,1,'a','a','张7',NULL,'23234',0,0,0,-100,-6.688,'','','1475752831download.jpg',6),(8,'127.0.0.1','sad','$2y$08$t5Sz6oFuG01MbcPUzjSVZeyir4sPq2.acPhotXr8mPtdu3yE4X4K2',NULL,'admin@admin.com1',NULL,NULL,NULL,NULL,1475644923,NULL,1,'Account','sdfg','张',NULL,'43434',0,0,0,0,-76.912,NULL,NULL,'user_8.png',7),(9,'127.0.0.1','hehe','$2y$08$q5Clrqq3PlNBikQkGZ4RHOG97mM8uXvGdM0y3G/OYcF9XDD0fNUH.',NULL,'admin12@admin.com',NULL,NULL,NULL,NULL,1475646400,NULL,1,'gdf','dfg','张学ji',NULL,'2345434',0,0,0,0,0,NULL,NULL,NULL,0),(11,'127.0.0.1','ghjghj','$2y$08$ldYlqBln6C9dMee82FwTXOUG8WlAzmLiqjUPNOsOBdcAj0VIszZXK',NULL,'admin@admin.comfdfg',NULL,NULL,NULL,NULL,1475649224,NULL,1,'fgh','dfg','ghfgh',NULL,'34456754676',0,0,0,0,0,NULL,NULL,'1475649224medspeaks.PNG',0),(12,'192.168.50.123','gdfg','$2y$08$BiDPxAG.M0x15.HnmL.piuHP382szMM/q5twcj2Q0xoml1BRke9SS',NULL,'19s@sdf.cos',NULL,NULL,NULL,NULL,1475816543,NULL,1,'f','d','张',NULL,'344564456',0,0,0,0,0,NULL,NULL,'1475816543my_photo.png',0),(16,'192.168.50.123',NULL,'$2y$08$VvGM6rG2ak0TcOVPKGCfiO7s4K.lmFGYNPdMnKZfqXlUzxtPRCMuu',NULL,'',NULL,NULL,NULL,NULL,1475822815,1475919275,1,NULL,NULL,NULL,NULL,'45345432',0,0,0,0,0,'','',NULL,0),(17,'192.168.50.124',NULL,'$2y$08$iOnYrcI8KnC9RpwseE4nq.k0fG4IHZ/UoK3gHrPNNw8VZeCLtmDIq',NULL,'',NULL,NULL,NULL,NULL,1475822838,NULL,1,NULL,NULL,'sdfdsfds',NULL,'2341223',0,0,0,0,0,'','',NULL,0),(18,'192.168.50.124',NULL,'$2y$08$Nhvmrx52d246FXXG4ocBo.eILTCMozhnRVpuz0.mR92/k38XBBvRS',NULL,'',NULL,NULL,NULL,NULL,1475823463,NULL,1,NULL,NULL,NULL,NULL,'333',0,0,0,0,0,'','',NULL,0),(19,'192.168.50.124',NULL,'$2y$08$NpQq2ODLSECQnCqjUHAEWeayUtWcQiv9uVfHVx9t3XB4a/O9OyLOu',NULL,'',NULL,NULL,NULL,NULL,1475824960,NULL,1,NULL,NULL,NULL,NULL,'2222',0,0,0,0,0,'','',NULL,0),(20,'192.168.50.124',NULL,'$2y$08$TnPoFp1uQimj2xbPQPH45Ol8ycNFSPCy68m2fnCXzTdr0LTrxpjG2',NULL,'',NULL,NULL,NULL,NULL,1475825465,NULL,1,NULL,NULL,NULL,NULL,'111',0,0,0,0,0,'','',NULL,0),(21,'192.168.50.124',NULL,'$2y$08$..N7vqSbRQuysLQWdGpUvuspsscS6Lm2GkHAVAX.29DeAs5Y1uCgi',NULL,'',NULL,NULL,NULL,NULL,1475825636,NULL,1,NULL,NULL,NULL,NULL,'234',0,0,0,0,0,'','',NULL,6),(24,'192.168.50.124',NULL,'$2y$08$ojPGlgp2fPgQ0h9S0xOmte/FoO38iXKARe2EyLzzhgBAsk7IVtW.m',NULL,'',NULL,NULL,NULL,NULL,1475913749,NULL,1,NULL,NULL,'asdadsa',NULL,'3331',0,0,0,0,0,'','','user_24.png',0),(25,'192.168.50.124',NULL,'$2y$08$jEdgKUTHQPENsRfXV0NJvuH.6jTyHpWtB.khzGntQUdvkMU007Gbm',NULL,'',NULL,NULL,NULL,NULL,1475928004,NULL,1,NULL,NULL,NULL,NULL,'13123451234',0,0,0,0,0,'b685c9b36e27463d08def7ecc9c4ef2b','1476014404',NULL,0),(26,'192.168.50.124','','$2y$08$bvdZ6/31Q4Q10nxXHdxE1u.AECjBH6tuXqVStAJaVmwWsSANd.NNe',NULL,'',NULL,NULL,NULL,NULL,1475929297,NULL,1,'','','nick',NULL,'12312312311',0,0,0,0,0,'','','user_26.png',0),(27,'192.168.50.123',NULL,'$2y$08$t3jmhgz2ycdBF1875plv4Og5nWUSvIcTexDMBA4FgSOy63F9Rsrky',NULL,'',NULL,NULL,NULL,NULL,1476247159,NULL,1,NULL,NULL,'QuanTest',NULL,'58638449',0,0,0,0,0,NULL,NULL,NULL,6),(28,'192.168.50.123','','$2y$08$2zni2I2NT1PkGEncI3UpvOhuLLI1di2/CxxXKBc943saleTVIyl9K',NULL,'198201942',NULL,NULL,NULL,NULL,1476427567,NULL,1,'','','zhangshan6th',NULL,'4576543546',0,0,0,0,0,NULL,NULL,'1476427566download.jpg',NULL),(30,'192.168.50.123','','$2y$08$kt20QUeKKdw3u2XB.VGFNuqxQTNNdX255U9D9ejXRFlsCaBOxD0wC',NULL,'',NULL,NULL,NULL,NULL,1476427693,NULL,1,'','','4th56jj',NULL,'5756756567',0,0,0,0,0,NULL,NULL,NULL,3);

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values (21,1,1),(45,3,3),(59,4,6),(49,6,4),(50,7,2),(51,8,7),(52,9,7),(33,16,4),(34,17,4),(35,18,4),(36,19,4),(37,20,4),(38,21,4),(41,24,4),(42,25,4),(47,26,2),(44,27,5),(58,30,4);

/*Table structure for table `users_permissions` */

DROP TABLE IF EXISTS `users_permissions`;

CREATE TABLE `users_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userID` (`user_id`,`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users_permissions` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
