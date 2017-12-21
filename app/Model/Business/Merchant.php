<?php
/**
 * 商家模型
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @date 2016-09-26 17:00
 * @author xinjianhua<xinjianhua@xiaohe.com>
 */
class Merchant extends AppModel
{
    public $name        = 'Merchant'; //模型名
    public $useTable    = 'mc_merchants'; //模型使用的数据表
    public $useDbConfig = 'business_center'; //使用的数据库连接

    /**
     * 获取商家信息
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @param $param
     * ------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------
     * @author xinjianhua<xinjianhua@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-11-04 11:01
     * ------------------------------------------------------------
     */
    public function getMerchant($param)
    {
        $condition = "WHERE `is_delete`='2' AND `is_usable` = 1";

        if (isset($param['is_test']) && !empty($param['is_test'])) {
            $is_test = $param['is_test'];
            $condition .= " AND is_test = '{$is_test}' ";
        }

        if (isset($param['merchant_id']) && !empty($param['merchant_id'])) {
            $merchant_id = is_array($param['merchant_id']) ? $param['merchant_id'] : (array) $param['merchant_id'];
            $condition .= " AND `id` IN ('" . implode("','", $merchant_id) . "')";
        }

        if (isset($param['phone']) && !empty($param['phone'])) {
            $merchant_phone = is_array($param['phone']) ? $param['phone'] : (array) $param['phone'];
            $condition .= " AND DECODE(`phone`,'I8feVXtTO0mv42QB9omOjvV9JyunNrZb') IN ('" . implode("','", $merchant_phone) . "')";
        }

        if (isset($param['is_auth']) && !empty($param['is_auth'])) {
            $condition .= " AND `is_auth` IN ('" . implode("','", (array) $param['is_auth']) . "')";
        }

        $sql = "SELECT `id`,DECODE(`name`,'I8feVXtTO0mv42QB9omOjvV9JyunNrZb') AS name,";
        $sql .= "DECODE(`phone`,'I8feVXtTO0mv42QB9omOjvV9JyunNrZb') AS phone,`member_id`, ";
        $sql .= "`leal_person`,`province_id`,`city_id`,`email`,`qq`,`address` ";
        $sql .= "FROM `business_center`.`mc_merchants` $condition";
        $result = $this->query($sql);

        $data = array();

        foreach ($result as $key => $value) {
            $data[$key]['id']          = $value['mc_merchants']['id'];
            $data[$key]['member_id']   = $value['mc_merchants']['member_id'];
            $data[$key]['leal_person'] = $value['mc_merchants']['leal_person'];
            $data[$key]['province_id'] = $value['mc_merchants']['province_id'];
            $data[$key]['city_id']     = $value['mc_merchants']['city_id'];
            $data[$key]['email']       = $value['mc_merchants']['email'];
            $data[$key]['address']     = $value['mc_merchants']['address'];
            $data[$key]['qq']          = $value['mc_merchants']['qq'];
            $data[$key]['name']        = $value['0']['name'];
            $data[$key]['phone']       = $value['0']['phone'];
        }

        return $data;
    }

    /**
     * 获取商家信息
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @param $param
     * ------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------
     * @author xinjianhua<xinjianhua@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-11-04 11:01
     * ------------------------------------------------------------
     */
    public function getMerchantFirst($param)
    {
        $condition = "WHERE `is_delete`='2' AND `is_usable` = 1";
        if (!empty($param['merchant_id'])) {
            $merchant_id = is_array($param['merchant_id']) ? $param['merchant_id'] : (array) $param['merchant_id'];
            $condition .= " AND `id` IN ('" . implode("','", $merchant_id) . "')";
        }

        if (!empty($param['phone'])) {
            $merchant_phone = is_array($param['phone']) ? $param['phone'] : (array) $param['phone'];
            $condition .= " AND DECODE(`phone`,'I8feVXtTO0mv42QB9omOjvV9JyunNrZb') IN ('" . implode("','", $merchant_phone) . "')";
        }

        $sql = "SELECT `id`,DECODE(`name`,'I8feVXtTO0mv42QB9omOjvV9JyunNrZb') AS name,";
        $sql .= "DECODE(`phone`,'I8feVXtTO0mv42QB9omOjvV9JyunNrZb') AS phone,`member_id` ";
        $sql .= "FROM `business_center`.`mc_merchants` $condition LIMIT 1";

        $result = $this->query($sql);

        $data = array();

        foreach ($result as $key => $value) {
            $data['id']        = $value['mc_merchants']['id'];
            $data['member_id'] = $value['mc_merchants']['member_id'];
            $data['name']      = $value['0']['name'];
            $data['phone']     = $value['0']['phone'];
        }

        return $data;
    }

    /**
     * Get merchant column information.
     *
     * @param  array $array
     * @return int
     */
    public function getColumnInfo(array $array, $column, $isDelete = false)
    {
        $condition = array_map(function ($key, $val) {
            if ($key === 'phone not in') {
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

        if ($isDelete) {
            $condition .= "AND is_delete='2' ";
        }

        $sql = '';
        $sql .= "SELECT {$column} ";
        $sql .= "FROM business_center.mc_merchants ";
        $sql .= "WHERE TRUE {$condition}";
        $result = $this->query($sql);

        return $result;
    }
}
