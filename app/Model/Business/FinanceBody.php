<?php
/**
 * 发票主体
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
class FinanceBody extends AppModel {
    public $name 	    = 'FinanceBody'; 	  //模型名
    public $useTable    = 'bc_finance_bodys';  	  //模型使用的数据表
    public $useDbConfig = 'business_center'; //使用的数据库连接
}