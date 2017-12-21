<?php
/**
 * 商家财务记录详情订单（出账）应用详情表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-11-04 09:51
 * @author xinjianhua<xinjianhua@xiaohe.com>
 */
class MerchantAccountRecordDetailOrderApp extends AppModel {
    public $name 	    = 'MerchantAccountRecordDetailOrderApp'; 	  	 //模型名
    public $useTable    = 'merchant_account_record_detail_orders';  	 //模型使用的数据表
    public $useDbConfig = 'finance_center'; //使用的数据库连接

    /**
     * 商家财务记录详情订单（出账）详情
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @author xinjianhua<xinjianhua@xiaohe.com>
     * ------------------------------------------------------------
     * @param string $platform_id
     * @param string $platform_version_id
     * @param array $merchant_id
     * ------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------
     * @date 2016-11-04 09:51
     * ------------------------------------------------------------
     */
    public function getMerchantAccountRecordDetailOrderApp($platform_id = '', $platform_version_id = '', $merchant_id = array()) {
        $condition = "WHERE `is_usable` = 1 AND order_type IN (1,4) AND status = 1";

        if (!empty($merchant_id)) {
            $condition .= " AND `order_app`.`merchant_id` IN ('".implode("','", $merchant_id)."')";
        }

        if (!empty($platform_id)) {
            $condition .= " AND `order_app`.`platform_id` = '{$platform_id}' ";
        }

        if (!empty($platform_version_id)) {
            $condition .= " AND `order_app`.`platform_version_id` = '{$platform_version_id}' ";
        }

        $sql  = " SELECT `order_app`.`id` AS `app_order_id`,`order_app`.`order_id`,`order_app`.`merchant_id`,";
        $sql .= "`order_app`.`platform_id`,`order_app`.`platform_version_id`,`order_app`.`service_deadline`,";
        $sql .= "`order_app`.`modified`,`order_app`.`merchant_id` FROM (SELECT * FROM `finance_center`.`merchant_account_record_detail_order_apps` ";
        $sql .= " ORDER BY `modified` DESC ) AS order_app";
        $sql .= " LEFT JOIN `finance_center`.`merchant_account_record_detail_orders` AS orders ";
        $sql .= "ON order_app.order_id = orders.id  $condition GROUP BY orders.merchant_id";

        return $this->query($sql);
    }
}