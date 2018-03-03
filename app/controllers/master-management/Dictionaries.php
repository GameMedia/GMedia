<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dictionaries extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model('backend/master-management/model_dictionaries');
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	 { 
		//load menu
		$this->loadMenu();
		//model Country
	 	$this->load->model('backend/master-management/model_countries');
	 	//countries
	 	$this->data['countries'] = $this->model_countries->loadCountriesSelect();
	 	$this->data['pageTitle'] = 'Dictionaries';
	 	$this->data['pageTemplate'] = 'master-management/view_dictionaries';
	 	$this->load->view($this->folderLayout.'main', $this->data);
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function loadDictionaries()
	 {
	 	$this->isAjax(404);
	 	$result = array();

	 	$params = $_POST;
	 	$data = $this->model_dictionaries->loadDictionaries($params);
	 	if($data['count'])
	 	{
	 		for($i=0; $i<count($data['rows']); $i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['name_country'];
	 			$result['data'][$i][] = $data['rows'][$i]['id'];
	 			$result['data'][$i][] = $data['rows'][$i]['dictionary']
	 		}
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/


	/*-------------------------------------------------------------------------------------------------*/


	/*-------------------------------------------------------------------------------------------------*/


	/*-------------------------------------------------------------------------------------------------*/
}

/* End of file dictionaries.php */
/* Location: ./application/controllers/dictionaries.php */
/* Muhammad Iqbal */