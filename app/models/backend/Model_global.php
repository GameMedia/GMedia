<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_global extends MY_Model 
 {
	public function __construct()
	 {
		parent::__construct();
		$this->laodDbCms();
	 }
	/*-------------------------------------------------------------------------------------------------*/
	#cek status insert/update
	public function cekiu($table, $paramsData=array(), $paramsKey=array(),$db='dbCms')
	 {
	 	foreach ($paramsKey as $key => $value) 
	 	{
	 		$this->$db->select($key);
	 		$this->$db->where($key,$this->$db->escape_str($value));
	 	}
	 	$this->$db->from($table);
	 	$data=$this->$db->get();
	 	if($data->num_rows() != 0)
	 	{
	 		$result=true;
	 	}else
	 	{
	 		$result=false;
	 	}
	 	return $result;
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function insert($table,$paramsData=array(),$db='dbCms')
	 {
	 	$result= array();
		$input_by= $this->profile['id'];
		$input_time= date('Y-m-d H:i:s');

		$insert= array();
		foreach ($paramsData as $key => $value) 
		{
			if(is_array($value))
			{
				if(!$value[1])
				{
					$insert[$key]= $value[0];
				} else
				{
					$insert[$key]= $this->$db->escape_str($val[0]);
				}
			}else
			{
				$insert[$key]= $this->$db->escape_str($value);
			}
		}
		$insert['entry_by'] = $this->$db->escape_str($input_by);
		$insert['entry_time'] = $this->$db->escape_str($input_time);
		$this->$db->insert($table, $insert);
	 }

	/*-------------------------------------------------------------------------------------------------*/


	/*-------------------------------------------------------------------------------------------------*/
 }

/* End of file model_Global.php */
/* Location: ./application/models/model_Global.php */