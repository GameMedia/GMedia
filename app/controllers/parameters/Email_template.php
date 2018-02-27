<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class email_template extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model('backend/parameters/model_email');
		$this->load->model('backend/parameters/model_email_template');
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	 {
		//load menu
		$this->loadMenu();

		//mengambil list email
		$this->data['email'] = $this->model_email->loadEmailSelect();
		$this->data['pageTitle'] = 'Email Template';
		$this->data['pageTemplate'] = 'parameters/view_email_template';
		$this->load->view($this->folderLayout.'main', $this->data);
		
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function loadEmail_Template()
	 {
	 	$this->isAjax(404);
	 	$result = array();

	 	$params = $_POST;
	 	$data = $this->model_email_template->loadEmail_Template($params);

	 	if($data['count'])
	 	{
	 		for($i=0; $i<count($data['rows']);$i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['name_email'];
	 			$result['data'][$i][] = $data['rows'][$i]['code'];
	 			$result['data'][$i][] = $data['rows'][$i]['name'];
	 			$result['data'][$i][] = $data['rows'][$i]['title'];
	 			$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';

	 			$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target=#formAdd" data-toggle="modal"');
	 			$buttonDelete ="";
	 			if($this->data['accessDelete'])
	 				$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'parameters/email_template/deleteEmail_Template', 'datatable');

	 			$result['data'][$i][] = $buttonView.' '.$buttonDelete;
	 		}
	 	} else
	 	{
	 		$result['data'] = array();
	 	}
	 	$result["draw"] = $params['draw'];
	 	$result["recordsTotal"] = $data['total'];
	 	$result["recordsFiltered"] = $data['total'];

	 	echo json_encode($result);
	 }


	/*-------------------------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------------------------*/


}

/* End of file emailtemplate.php */
/* Location: ./application/controllers/emailtemplate.php */