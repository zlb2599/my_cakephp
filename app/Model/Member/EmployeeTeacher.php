<?php
/**
 * 商家老师表操作
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @author majinyun <majinyun@xiaohe.com>
 */
class EmployeeTeacher extends AppModel
{
	public $name        = 'EmployeeTeacher'; //模型名
	public $useTable    = 'mc_employee_teachers'; //模型使用的数据表
	public $useDbConfig = 'member_center'; //使用的数据库连接

	/**
	 * [getTeacherCount description]
	 * @param  array  $sql [description]
	 * @return [type]      [description]
	 */
	public function getTeacherCount(array $data)
	{
		$campus_id = $data['id'];
		$sql = '';
		$sql .= "SELECT COUNT(B.id) AS num FROM member_center.mc_employee_teachers as A ";
		$sql .= "left join member_center.mc_employees as B ON A.employee_id=B.id ";
		$sql .= "WHERE TRUE ";
		$sql .= " AND B.is_usable='1' AND B.is_delete='2' ";
		if (!empty($campus_id = $data['id'])) {
			$sql .= "AND A.campus_id like '%{$campus_id}%'";
		}
		$entity = $this->query($sql);

		return isset($entity[0][0]['num']) ? $entity[0][0]['num'] : 0;
	}
}