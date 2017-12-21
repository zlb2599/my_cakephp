<?php
/**
 * 家长财务记录详情订单（出账）表模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-10-05 17:58
 * @author biguangfu<biguangfu@xiaohe.com>
 */
class ParentAccountRecordDetailOrder extends AppModel
{
    public $name        = 'ParentAccountRecordDetailOrder'; //模型名
    public $useTable    = 'parent_account_record_detail_orders'; //模型使用的数据表
    public $useDbConfig = 'finance_center'; //使用的数据库连接

    /**
     * 家长财务记录详情订单（出账）详情
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @author biguangfu<biguangfu@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-10-05 17:58
     * ------------------------------------------------------------
     */
    public function getParentAccountRecordDetailOrder($id)
    {
        $id  = implode("','", (array) $id);
        $sql = "SELECT `id`,`platform_id`,`campus_id`,`account_record_ids`,`trade_no`,`student_id`,`parent_id`,`merchant_id`,`total_amount`,`debt_amount`,`current_balances`,`is_online`,`status`,`order_type`,`creator_id`,`created`,`modifier_id`,`modified`,`is_comment`,`is_usable`,`is_delete`,`data_enter_type`,`real_amount` FROM `finance_center`.`parent_account_record_detail_orders` AS `ParentAccountRecordDetailOrder` WHERE `id` IN ('{$id}') ";
        return $this->query($sql);
    }

    /**
     * 家长财务记录详情订单（出账）详情
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @author wangjunjie<wangjunjie@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-10-26 14:14
     * ------------------------------------------------------------
     */
    public function getHandleFlowParentAccountRecordDetailOrder()
    {
        $sql = " SELECT `id`,`order_type`,`real_amount`,`merchant_id`,`platform_id`,`campus_id`,`parent_id`,`status`,`is_online`,`creator_id`,`created`,`data_enter_type` FROM `finance_center`.`parent_account_record_detail_orders` AS ParentAccountRecordDetailOrder";
        $sql .= " WHERE order_type IN ('1', '2', '1,2', '3') AND `status` NOT IN (2, 4) AND total_amount >= 0";

        // $sql .= " AND merchant_id='4720d109e612723b137db83b53c024bd' ";

        return $this->query($sql);
    }

    /**
     * 家长财务记录详情订单（出账）详情
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @author biguangfu<biguangfu@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-10-05 17:58
     * ------------------------------------------------------------
     */
    public function getParentAccountRecordDetailOrderByAccountRecordId($id)
    {
        $sql = "SELECT `id` FROM `finance_center`.`parent_account_record_detail_orders` AS `ParentAccountRecordDetailOrder` WHERE `account_record_ids` LIKE '%{$id}%' ";
        return $this->query($sql);
    }

    /**
     * Get parent order column information.
     *
     * @param  array $array
     * @param string $column
     * @return int
     */
    public function getTableJoinStatisticsInfo(array $array, $column)
    {
        $condition = array_map(function ($key, $val) {
            if ($key === 'b.phone not in') {
                $phone = self::decrypt('phone');

                if (is_array($val)) {
                    $val = "'" . implode("','", $val) . "'";
                }

                return "AND {$phone} NOT IN ({$val})";
            } else {
                return "AND {$key}'{$val}' ";
            }
        }, array_keys($array), array_values($array));
        $condition = implode('', $condition);

        $sql = '';
        $sql .= "SELECT {$column} ";
        $sql .= "FROM finance_center.parent_account_record_detail_orders AS a ";
        $sql .= "LEFT JOIN member_center.uc_parents AS b ON a.parent_id = b.id ";
        $sql .= "WHERE TRUE {$condition}";
        $result = $this->query($sql);

        return $result;
    }
}
