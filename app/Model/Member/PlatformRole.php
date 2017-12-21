<?php
/**
 * 平台角色表操作
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
class PlatformRole extends AppModel {
    public $name 	    = 'PlatformRole'; 	  	 //模型名
    public $useTable    = 'mc_platform_roles';  	 //模型使用的数据表
    public $useDbConfig = 'member_center'; //使用的数据库连接

    /**
     * 获取平台角色
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @author xinjianhua<xinjianhua@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-11-04 09:51
     * ------------------------------------------------------------
     */
    public function getMerchantPlatformRole($param) {

        $condition  = "WHERE `employeeRole`.`is_usable` = 1 AND `employeeRole`.`is_delete` = 2 ";
        $condition .= "AND `platformRole`.`is_usable` = 1 AND `platformRole`.`is_delete` = 2";

        if (!empty($param['merchant_id'])) {
            $condition .= " AND `platformRole`.`merchant_id` = '{$param['merchant_id']}'";
        }

        if (!empty($param['platform_id'])) {
            $condition .= " AND `platformRole`.`platform_id` = '{$param['platform_id']}'";
        }

        if (!empty($param['member_id'])) {
            $condition .= " AND `employess`.`member_id` = '{$param['member_id']}'";
        }

        $sql  = "SELECT `employess`.`id` AS employess_id,`member`.`id` AS member_id,`platformRole`.`id` ";
        $sql .= "FROM `member_center`.`mc_employees` AS employess ";
        $sql .= "LEFT JOIN `member_center`.`mc_members` AS member ON `employess`.`member_id` = `member`.`id`";
        $sql .= "LEFT JOIN `member_center`.`mc_employee_role` AS employeeRole ON `employess`.`id` = `employeeRole`.`employee_id`";
        $sql .= "LEFT JOIN `member_center`.`mc_platform_roles` AS platformRole ON `employeeRole`.`role_id` = `platformRole`.`id` $condition";

        return $this->query($sql);
    }

    /**
     * 执行SQL
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @author xinjianhua<xinjianhua@xiaohe.com>
     * ------------------------------------------------------------
     * @param $sqls
     * ------------------------------------------------------------
     * @return array
     * @date 2016-11-07 09:51
     * ------------------------------------------------------------
     */
    public function addData($sqls) {
        $dataSource = $this->getDataSource();
        $dataSource->begin();

        foreach ($sqls as $sql) {
            try {
                $this->query($sql);
            } catch (Exception $e) {
                $dataSource->rollback($this);
                return array('status' => false, 'message' => sprintf("sql=>%s message=>%s", $sql, $e->getMessage()));
            }
        }

        $dataSource->commit($this);
        return array('status' => true);
    }
}