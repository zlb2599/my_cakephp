<?php
/**
 * 家长学员表操作
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
class ParentStudent extends AppModel {
	public $name        = 'ParentStudent'; //模型名
	public $useTable    = 'uc_parent_student'; //模型使用的数据表
	public $useDbConfig = 'member_center'; //使用的数据库连接

	/**
	 * 获取家长学员
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author wangjunjie<wangjunjie@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-02-05 15:33
	 * ------------------------------------------------------------
	 */
	public function getParentStudent($conditions = array()){
		$sql = "SELECT parent_id FROM `member_center`.`uc_parent_student` AS `parent_student` WHERE TRUE";
		if ($student_id = getArrVal($conditions, 'student_id')) {
			$sql .= " AND student_id='{$student_id}' ";
		}
		return $this->query($sql);
	}
}