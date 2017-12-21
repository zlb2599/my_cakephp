<?php
/**
 * 推送记录
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @author zhaodongjuan <zhaodongjuan@xiaohe.com>
 */
class PushMessageLog extends AppModel
{
    public $name 	    = 'PushMessageLog';
    public $useTable    = 'bc_push_message_logs';
    public $useDbConfig = 'business_center';

    /**
	 * 查询推送数据
	 * ------------------------------------------------------------
	 * @access public
	 * ------------------------------------------------------------
	 * @author houguopeng<houguopeng@xiaohe.com>
	 * ------------------------------------------------------------
	 * @date 2017-08-19 12:49
	 * ------------------------------------------------------------
	 */
    public function todayMessage($data = array()){
        $date      = getArrVal($data,'date',date('Y-m-d'));
        $app_type  = getArrVal($data, 'app_type', '2');//应用类型(1:家长端 2:机构端)
        $push_type = getArrVal($data, 'push_type', '1');//推送类型(1:课程 2:考勤)
        $app_key   = getArrVal($data, 'app_key');//应用对应极光key 

        $sql = "SELECT id,app_type,created,user_id,app_key FROM `business_center`.`bc_push_message_logs` WHERE app_type ={$app_type} AND push_type={$push_type} AND is_delete =2 AND is_usable=1 AND SUBSTRING(created,1,10) = '{$date}'";

        if (!empty($app_key)) {
        	$sql .= " AND app_key='{$app_key}'";
        }
        
        $result = $this->query($sql);
        $result = !empty($result) ? array_column($result, 'bc_push_message_logs') : array();
        return $result;
    }

}
