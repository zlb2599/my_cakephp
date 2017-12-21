<?php
/**
 * 预约试听
 *
 * PHP versions 5.6
 *
 * @copyright Copyright 2012-2015, BAONAHAO Software Foundation, Inc.( http://www.baonahao.com/ )
 * @link http://www.baonahao.com baonahao(tm) Project
 * @package crontab
 * @subpackage crontab/app/Console
 * @author majinyun <majinyun@xiaohe.com>
 */
class Audition extends AppModel
{
	public $name 	    = 'Audition'; 
	public $useTable    = 'mc_auditions';
	public $useDbConfig = 'business_center';

	/**
	 * [getAuditionCount description]
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function getAuditionCount(array $data)
	{
		$sql = '';
		$sql .= "SELECT COUNT(a.id) AS num ";
		$sql .= "FROM business_center.mc_auditions AS a ";
		$sql .= "WHERE TRUE ";

		if (!empty($campus_id = $data['id'])) {
			$sql .= "AND a.campus_id='{$campus_id}' ";
		}

		// if (isset($data['merchant_id'])) {
		// 	$merchant_id = $data['merchant_id'];
		// 	$sql .= "AND a.merchant_id='{$merchant_id}' ";
		// }
		$sql .= "AND a.is_usable='1' AND a.is_delete='2' AND a.`status` IN(1,2,3)";
		$entity = $this->query($sql);

		return isset($entity[0][0]['num']) ? $entity[0][0]['num'] : 0;
	}
}
