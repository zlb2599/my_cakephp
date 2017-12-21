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
 * @date 2016-11-22 15:40
 * @author wangjunjie<wangjunjie@xiaohe.com>
 */
class Parents extends AppModel
{
    public $name        = 'Parents'; //模型名
    public $useTable    = 'uc_parents'; //模型使用的数据表
    public $useDbConfig = 'member_center'; //使用的数据库连接

    /**
     * 获取家长实体
     * ------------------------------------------------------------
     * @access public
     * ------------------------------------------------------------
     * @author wangjunjie<wangjunjie@xiaohe.com>
     * ------------------------------------------------------------
     * @date 2016-11-22 15:40
     * ------------------------------------------------------------
     */
    public function getParentEntity($conditions = array())
    {
        $sql = " SELECT `id`, DECODE(`phone`, 'I8feVXtTO0mv42QB9omOjvV9JyunNrZb') AS `phone`, `name` FROM `member_center`.`uc_parents` WHERE TRUE ";
        if (isset($conditions['id']) && !empty($conditions['id'])) {
            $sql .= " AND `id`='{$conditions['id']}' ";
        }
        $result = $this->query($sql);
        $entity = array();
        if (isset($result[0])) {
            $entity = array_merge($result[0]['uc_parents'], $result[0][0]);
        }
        return $entity;
    }

    /**
     * Get parent column information.
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
        $sql .= "FROM member_center.uc_parents ";
        $sql .= "WHERE TRUE {$condition}";
        $result = $this->query($sql);

        return $result;
    }
}
