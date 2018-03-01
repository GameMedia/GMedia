<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_galleries extends MY_Model {

	private $tableGalleries = 'galleries';

	public function __construct()
	 {
		parent::__construct();
		$this->loadDbCms();
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadGalleries($params)
	 {
	 	$result = array();
	 	$columnOrder = array(
	 						'1' => 'g.type',
	 						'2' => 'g.name',
	 						'4' => 'g.status');
	 	$types = array('News', 'Banner', 'Team');

	 	//select count data
	 	$this->dbCms->select(' COUNT(1) AS count ');
	 	$this->dbCms->from($this->tableGalleries.' g');

	 	if(!empty($params['search_type']))
	 		$this->dbCms->where("g.type", $this->dbCms->escape_str($params['search_type']));
	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("g.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
	 	if(isset($params['search_status']) && $params['search_status'] !="")
	 		$this->dbCms->where("g.status", $this->dbCms->escape_str($params['search_status']));

	 	$this->dbCms->where_in('g.type', $types);
	 	//data not deleted
	 	$this->dbCms->where("g.status !=", "-1");
	 	$query = $this->dbCms->get();

	 	$result['total'] = 0;
	 	foreach ($query->result_array() as $row) 
	 		$result['total'] = $row['count'];

	 	//main data
	 	$this->dbCms->select('g.id, g.type, g.name, g.url_thumb, g.url_ori, g.status, g.entry_time, g.update_time');
	 	$this->dbCms->from($this->tableGalleries.' g');

	 	if(!empty($params['search_type']))
	 		$this->dbCms->where("g.type", $this->dbCms->escape_str($params['search_type']));
	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("g.name LIKE '%".$this->dbCms->escape_str($params['search_name']));
	 	if(isset($params['search_status']) && $params['search_status'] !="")
	 		$this->dbCms->where("g.status", $this->dbCms->escape_str($params['search_status']));
		
		$this->dbCms->where_in('g.type', $types);
		//data not deleted
		$this->dbCms->where("g.status !=", "-1");
		$this->dbCms->limit($params['length'], $params['start']);
		
		//order by params from datatable
		$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);
		$query = $this->dbCms->get();

		$i=0;
		if($query->num_rows() !=0)
		{
			$result['count'] = true;
			foreach ($query->result_array() as $row) 
			{
					$result['rows'][$i]['id'] = $row['id'];
					$result['rows'][$i]['type'] = $row['type'];
					$result['rows'][$i]['name'] = $row['name'];
					$result['rows'][$i]['url_ori'] = $row['url_ori'];
					$result['rows'][$i]['url_thumb'] = $row['url_thumb'];
					$result['rows'][$i]['status'] = $row['status'];
					$result['rows'][$i]['entry_time'] = $row['entry_time'];
					$result['rows'][$i]['update_time'] = $row['update_time'];
					$i++;					
			}
		} else
		{
			$result['count'] = false;
			$result['message'] = DB_NULL_RESULT;
		}	 	
		return $result;
	 }


	/*-------------------------------------------------------------------------------------------------*
	public function loadGalleriesSelect($params)
	 {

	 }

	/*-------------------------------------------------------------------------------------------------*/ 


	/*-------------------------------------------------------------------------------------------------*/ 


	/*-------------------------------------------------------------------------------------------------*/ 
	

}

/* End of file model_galleries.php */
/* Location: ./application/models/model_galleries.php */