<?php

/**
 * 机构登录日志模型
 *
 * PHP versions 5.6
 *
 * @copyright  Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link       http://www.baonahao.com baonahao(tm) Project
 * @package    crontab
 * @subpackage crontab/app/Model/System
 * @author     majinyun <majinyun@xiaohe.com>
 */

class UCLoginLog extends AppModel
{
    public $name        = 'UCLoginLog'; // 模型名
    public $useTable    = 'uc_login_logs'; // 模型使用的数据表
    public $useDbConfig = 'system_center'; // 使用的数据库连接

    /**
     * Get parent column information.
     *
     * @param  array  $array
     * @param  string $column
     * @return int
     */
    public function getColumnInfo(array $array, $column)
    {
        if (isset($array['date'])) {
            unset($array['date']);
        }
        $condition = array_map(function ($key, $val) {
            if ($key === 'platform_id in') {
                if (is_array($val)) {
                    $val = "'" . implode("','", $val) . "'";
                }

                return "AND {$key}({$val})";
            } else {
                return "AND {$key}'{$val}' ";
            }
        }, array_keys($array), array_values($array));
        $condition = implode('', $condition);

        $sql = '';
        $sql .= "SELECT {$column} ";
        $sql .= "FROM system_center.ec_login_logs ";
        $sql .= "WHERE TRUE {$condition}";
        $result = $this->query($sql);

        return $result;
    }
}
