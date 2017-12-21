<?php
/**
 * 统计用户订单操作
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-30 10:56
 * @author gaoxiang<gaoxiang@xiaohe.com>
 */
class ParentOrderStatistic extends AppModel {
	public $name 	    = 'ParentOrderStatistic'; 	  	 //模型名
	public $useTable    = 'bi_parent_order_statistics';  	 //模型使用的数据表
	public $useDbConfig = 'bi_center'; //使用的数据库连接


}