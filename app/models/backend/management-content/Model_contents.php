<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_contents extends MY_Model 
 {
 	private $tableContentTypes	= 'content_types';
 	private $tableGalleries	= 'galleries';
 	private $tableCountries = 'countries';
 	private $tableContents 	= 'contents';

 	/*-------------------------------------------------------------------------------------------------*/ 
 	public function __construct()
 	 {
 		parent::__construct();
 		$this->loadDbCms();
 	 }

 	/*-------------------------------------------------------------------------------------------------*/  
 	public function loadContent($params)
 	 {
 	 	$result = array();
 	 	$ColumnOrder = array(
 	 					'1' => 'c.id_content_type',
 	 					'2' => 'c.parent',
 	 					'3' => 'c.name',
 	 					'4' => 'c.publish_time',
 	 					'5' => 'c.status');

 	 	//select Count Data
 	 	$this->dbCms->select(' COUNT(1) AS count ');
 	 	$this->dbCms->from($this->tableContents.' c');
 	 	$this->dbCms->join($this->tableContentTypes.' ct', 'c.id_content_type = ct.id');
 	 	$this->dbCms->join($this->tableCountries.' cu', 'c.id_country = cu.id');
 	 	$this->dbCms->join($this->tableGalleries.' g', 'c.id_gallery = g.id');

 	 	if(!empty($params['search_id_content_type']))
			$this->dbCms->where("c.id_content_type", $this->dbCms->escape_str($params['search_id_content_type']));
		if(!empty($params['search_parent']))
			$this->dbCms->where("c.parent LIKE '%".$this->dbCms->escape_str($params['search_parent'])."%'");
		if(!empty($params['search_name']))
			$this->dbCms->where("c.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
		if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("c.status", $this->dbCms->escape_str($params['search_status']));

		//data not deleted
		$this->dbCms->where("c.status !=","-1");
		$query = $this->dbCms->get();
		$result['total'] = 0;
		foreach ($query->result_array() as $row ) 
		{
			$result['total'] = $row['count'];
		}

		//select main data
		$this->dbCms->select('c.id, c.parent, c.name, c.status, c.publish_time, c.entry_time, c.update_time');
		$this->dbCms->select('ct.name AS name_content_type');
		$this->dbCms->select('cu.name AS name_country');
		$this->dbCms->select('g.url_thumb, g.url_ori');
		$this->dbCms->from($this->tableContents.' c');
		$this->dbCms->join($this->tableContentTypes.' ct', 'c.id_content_type = ct.id');
		$this->dbCms->join($this->tableCountries.' cu', 'c.id_country = cu.id');
		$this->dbCms->join($this->tableGalleries.' g', 'c.id_gallery = g.id');

		if(!empty($params['search_id_content_type']))
			$this->dbCms->where("c.id_content_type", $this->dbCms->escape_str($params['search_id_content_type']));
		if(!empty($params['search_parent']))
			$this->dbCms->where("c.parent LIKE '%".$this->dbCms->escape_str($params['search_parent'])."%'");
		if(!empty($params['search_name']))
			$this->dbCms->where("c.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
		if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("c.status", $this->dbCms->escape_str($params['search_status']));

		//data not deleted
		$this->dbCms->where("c.status !=","-1");
		$this->dbCms->where("ct.status !=","-1");
		$this->dbCms->where("cu.status !=","-1");
		$this->dbCms->where("g.status !=","-1");

 	 }
	
	/*-------------------------------------------------------------------------------------------------*/ 

 }

/* End of file model_content.php */
/* Location: ./application/models/model_content.php */