<?php
/**
 * 商家学员表操作
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2017-02-05 15:33
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class MerchantStudent extends AppModel {
	public $name        = 'MerchantStudent'; //模型名
	public $useTable    = 'uc_merchant_student'; //模型使用的数据表
	public $useDbConfig = 'member_center'; //使用的数据库连接

	/**
	 * 获取商家学员
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-02-05 15:33
	 * ------------------------------------------------------------
	 */
	public function getMerchantStudent($conditions = array()){
		$sql = "SELECT merchant_id, student_id, creator_id, created, modifier_id, modified, data_enter_type FROM `member_center`.`uc_merchant_student` AS `merchant_student` WHERE TRUE";
		return $this->query($sql);
	}

	/**
	 * [getStudentCount description]
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function getStudentCount(array $data)
	{
		$sql = '';
		$sql .= 'SELECT COUNT(id) AS num ';
		$sql .= 'FROM member_center.uc_merchant_student AS a ';
		$sql .= 'WHERE TRUE ';

		if (!empty($campus_id = $data['id'])) {
			$sql .= "AND a.campus_id='{$campus_id}' ";
		}

		// if (isset($data['merchant_id'])) {
		// 	$merchant_id = $data['merchant_id'];
		// 	$sql .= "AND a.merchant_id='{$merchant_id}' ";
		// }

		$entity = $this->query($sql);
		$count = isset($entity[0][0]['num']) ? $entity[0][0]['num'] : 0;

		return $count;
	}
}