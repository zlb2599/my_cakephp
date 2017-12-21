<?php
/**
 * 发票模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-26 18:10
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class FinanceInvoice extends AppModel {
    public $name 	    = 'FinanceInvoice'; 	  //模型名
    public $useTable    = 'bc_finance_invoices';  	  //模型使用的数据表
    public $useDbConfig = 'business_center'; //使用的数据库连接

    /**
     * 更新发票是否发送邮件
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @param $invoices_id string 发票ID
     * ------------------------------------------------------------
     * @param is_send_email int 是否已发送邮件(1:是 2:否)
     * ------------------------------------------------------------
     * @author zhaodongjuan<zhaodongjuan@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2017-05-17 18:11
     * ------------------------------------------------------------
     */
    public function updateComprehensiveSort($invoices_id, $is_send_email) {
        $sql = "UPDATE `business_center`.`bc_finance_invoices` SET `is_send_email` = '{$is_send_email}' WHERE `id` = '{$invoices_id}'";
        return $this->query($sql);
    }
}