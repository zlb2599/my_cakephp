<?php
/**
 * 用户表操作
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
class Member extends AppModel
{
    public $name        = 'Member'; //模型名
    public $useTable    = 'mc_members'; //模型使用的数据表
    public $useDbConfig = 'member_center'; //使用的数据库连接

    /**
     * 添加用户
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @author houguopeng<houguopeng@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-09-30 10:56
     * ------------------------------------------------------------
     */
    public function addMember($sql)
    {
        $re = '';
        if (!empty($sql)) {
            $re = $this->query($sql);
        }

        return $re;
    }

    /**
     * 通过会员ID获取会员数据
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @param $member_id
     * ------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------
     * @author xinjianhua<xinjianhua@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-11-04 13:48
     * ------------------------------------------------------------
     */
    public function getMemberById($member_id)
    {
        $sql = "SELECT `id` FROM mc_members WHERE `id` = '{$member_id} 'LIMIT 1";
        $res = $this->query($sql);

        return isset($res[0]['mc_members']) ? $res[0]['mc_members'] : array();
    }

    /**
     * Get member column information.
     *
     * @param  array   $array
     * @param  string  $column
     * @param  boolean $isDelete
     * @return array
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
            } elseif ($key === 'data_enter_type in') {
                if (is_array($val)) {
                    $val = "'" . implode("','", $val) . "'";
                }

                return "AND {$key} ({$val})";
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
        $sql .= "FROM member_center.mc_members ";
        $sql .= "WHERE TRUE {$condition}";
        $result = $this->query($sql);

        return $result;
    }
}
