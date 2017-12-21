<?php
/**
 * 提现申请日志模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-28 14:25
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class WithdrawApplyLog extends AppModel {
	public $name 	    = 'WithdrawApplyLog'; //模型名
	public $useTable    = 'sc_withdraw_apply_logs'; //模型使用的数据表
	public $useDbConfig = 'system_center'; //使用的数据库连接

	/**
	 * 获取可以提现的申请日志
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-09-28 14:26
	 * ------------------------------------------------------------
	 */
	public function getWithdrawApplyLog($type, $date) {
		$sql  = "SELECT `id`,`applicant_id`,`withdraw_apply_detail_id`,`msg`,`type`,`status`,`handle_date_1`,`handle_date_2`,`handle_date_3`,`handle_date_4`,`merchant_id`,`platform_id`,`bank_card_id`,`money`,`pay_pwd_is_right`,`is_usable`,`is_delete`";
		$sql .= "FROM `system_center`.`sc_withdraw_apply_logs` AS `WithdrawApplyLog` ";
		$sql .= "WHERE `type`='{$type}' AND `handle_date_1`<='{$date}' ";
		$sql .= "AND `status`='1' AND `is_usable`='1' AND `is_delete`='2' AND `is_reviewed`='1' ";
		$sql .= "ORDER BY `handle_date_1`";
		return $this->query($sql);
	}

	/**
	 * 更新提现的申请日志
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author biguangfu<biguangfu@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-10-02 12:01
	 * ------------------------------------------------------------
	 */
	public function updateWithdrawApplyLog($id, $jdpay_send_data, $jdpay_return_data_1, $withdraw_log) {
		$jdpay_send_data	 = json_encode($jdpay_send_data);
		$jdpay_return_data_1 = json_encode($jdpay_return_data_1);
		$sql  = "UPDATE `system_center`.`sc_withdraw_apply_logs` ";
		$sql .= "SET `handle_date_2`=NOW(), `status`='2', ";
		$sql .= "`jdpay_send_data`='{$jdpay_send_data}',`jdpay_return_data_1`='{$jdpay_return_data_1}', ";
		$sql .= "`crontab_log_file`='{$withdraw_log}' ";
		$sql .= "WHERE `id`='{$id}'";
		return $this->query($sql);
	}
}