<?php
/**
 * 渠道列表
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-30 10:56
 * @author houguopeng<houguopeng@xiaohe.com>
 */
class Channel extends AppModel {
	public $name 	    = 'Channel'; 	  	 //模型名
	public $useTable    = 'bc_channels';  	 //模型使用的数据表
	public $useDbConfig = 'business_center'; //使用的数据库连接

	/**
	 * 获取课渠道
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author houguopeng<houguopeng@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2016-09-30 10:56
	 * ------------------------------------------------------------
	 */
	public function getChannel() {
		$sql  = "SELECT `id`,`name` FROM `business_center`.`bc_channels` ";
		$sql .= "WHERE name IN ('幼儿园','公立校','其他教育者')";
		$sql .= "AND `is_usable`=1 AND `is_delete`=2 ";
		return $this->query($sql);
	}
}