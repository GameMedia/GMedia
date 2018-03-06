<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends MY_Controller_Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('backend/management-content/model_contents');
		$this->load->model('backend/management-content/model_content_types');
		$this->load->model('backend/master-management/model_countries');
	}
	/*-------------------------------------------------------------------------------------------------*/ 
	public function index()
	 {
		//loadMenu
		$this->loadMenu();
		//load model content type
		$this->data['content_type'] = $this->model_content_types->loadContent_TypesSelect();

		//load model contry
		$this->data['countries'] = $this->model_countries->loadCountriesSelect();

		$this->data['pageTitle'] = 'Content';
		$this->data['pageTemplate'] = 'management-content/view_contents';
		$this->load->view($this->folderLayout.'main', $this->data);
	 }
	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadContents()
	 {
	 	$this->isAjax(404);
	 	$result = array();

	 	$params = $_POST;
	 	$data = $this->model_contents->loadContents($params);
	 	if($data['count'])
	 	{
	 		for($i=0; $i<count($data['rows']); $i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['name_content_type'];
	 			$result['data'][$i][] = $data['rows'][$i]['name_parent'];
	 			$result['data'][$i][] = $data['rows'][$i]['name'];
	 			$result['data'][$i][] = date('d M Y H:i', strtotime($data['rows'][$i]['publish_time']));
	 			$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';
	 			$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\');showView(1)', '');
	 			$buttonDelete = "";
	 			if($this->data['accessDelete'])
	 				$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'management-content/content/deleteContents', 'datatable');
	 			$result['data'][$i][] = $buttonView.' '.$buttonDelete;
	 		}
	 	} else
	 		$result['data'] = array();
	 	$result["draw"] = $params['draw'];
	 	$result["recordsTotal"] = $data['data'];
	 	$result["recordsFiltered"] = $data['total'];

	 	echo json_encode($result);
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadContentsSelect()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_contents->loadContentsSelect($params);
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function getContentsData()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_contents->getContentsData($params);
	 		$result['update_by'] = empty($result['entry_by'])?$result['update_by']:$result['entry_by'];
	 		$result['update_time'] = empty($result['entry_time'])?$result['update_time']:$result['entry_time'];

	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
}

/* End of file content.php */
/* Location: ./application/controllers/content.php */