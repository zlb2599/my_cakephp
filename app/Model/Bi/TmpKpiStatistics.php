<?php

/**
 * 缓存之 KPI 统计数据
 *
 * PHP versions 5.6
 *
 * @copyright  Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link       http://www.baonahao.com baonahao(tm) Project
 * @package    crontab
 * @subpackage crontab/app/Console
 * @author     majinyun <majinyun@xiaohe.com>
 */
class TmpKpiStatistics extends AppModel
{
    public $name        = 'TmpKpiStatistics'; // 模型名
    public $useTable    = 'tmp_kpi_statistics'; // 模型使用的数据表
    public $useDbConfig = 'bi_center'; // 使用的数据库连接

    /**
     * Cache tmp kpi statistics.
     *
     * @param  array  $array
     * @param  string $date
     * @return mixed
     */
    public function cacheTmpKpiStatistics(array $array, $type, $date = '')
    {
        $sql = "REPLACE INTO bi_center.tmp_kpi_statistics (`year`,`type`,`name`,`value`,`created`) VALUES %s";
        $values = '';
        foreach ($array as $key => $val) {
            $datetime = date('Y-m-d H:i:s');
            $values .= "('{$date}','{$type}','{$key}','{$val}','{$datetime}'),";
        }
        $values = rtrim($values, ',');
        $sql = sprintf($sql, $values);

        return $this->query($sql);
    }
}
