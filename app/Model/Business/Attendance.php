<?php
/**
 * 考勤
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2017-7-01 14:30
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class Attendance extends AppModel {
	public $name        = 'Attendance'; 	  	 //模型名
	public $useTable    = 'fc_attendances';  	 //模型使用的数据表
	public $useDbConfig = 'business_center'; //使用的数据库连接
}