<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller_Admin {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	{
		$this->loadMenu();		#load menu dari my_controller_admin
		$this->laodModel();		#load fungsi model dari self
		$this->data['user_type']= $this->model_user_type->loadUser_TypeSelect();
		$this->data['privilege']['title']= "Privilege";
		$this->data['privilege']['url']= "user-management/privilege/loadPrivilegesSelect";

		$this->data['pageTitle']= 'Employees'; #tampilan header merah
		$this->data['pageTemplete']= 'user-management/view_employees'; # tabel employee
		$this->load->view($this->folderLayout.'main',$this->data);  #load view main layout	
	}
	/*-------------------------------------------------------------------------------------------------*/
	private function loadModel()
	{
		$this->load->model('backend/user-management/model_employee');
		$this->load->model('backend/parameters/model_user_type');
		return true;
	}
	/*-------------------------------------------------------------------------------------------------*/
	public function loadEmployees()
	{
		$this->isAjax(404);
		$result=array();
		$this->loadModel();

		$params=$_POST;
		$data=$this->model_employees->loadEmployees($params);
		if($data['count'])
		{
			for($i=0;$i<count($data['rows']);$i++)
			{
				$result['data'][$i][]=$params['start']+($i+1);
				$result['data'][$i][]=$data['rows'][$i]['name_user_type'];
				$result['data'][$i][]=$data['rows'][$i]['name_privilege'];
				$result['data'][$i][]=$data['rows'][$i]['name'];
				$result['data'][$i][]=$data['rows'][$i]['email'];
				$result['data'][$i][]=$data['rows'][$i]['phone'];
				$result['data'][$i][]=($data['rows'][$i]['status'])?
				'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';

					$buttonView=$this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')','data-target="#formAdd" data-toggle="model"'); #untuk pop up view data employee
				
					$buttonDelete="";
					if($this->data['accessDelete'])
						$buttonDelete=$this->createElementButtonDelete($data['rows'][$i]['id'], 'user-management/employees/deleteEmployees','datatable'); #fungsi self
				$result['data'][$i][]=$buttonView.' '.$buttonDelete;
			}
		}else
			$result['data'] = array();
		$result["draw"]				= $params['draw'];
		$result["recordsTotal"]		= $params['total'];
		$result["recordsFiltered"]	= $data['total'];

		echo json_encode($result);
	}
	/*-------------------------------------------------------------------------------------------------*/
	public function getEmployeesData()  #mengambil data pop up detail view
	{
		$this->isAjax(404);
		if(sizeof($_POST))
		{
			$this->loadModel();
			$params=$_POST;
			$result=$this->model_employees->getEmployeesData($params);
			echo json_encode($result);
		}
	}
	/*-------------------------------------------------------------------------------------------------*/
	public function deleteEmployees() #untuk memproses penghapusan data
	{
		$this->isAjax(404);
		if(sizeof($_POST))
		{
			$table='cms_employee';
			$this->load->model('backend/model_globals');
			$params=$_POST;
			$paramsData=array('status'=>'-1');
			$paramsKey=array('id'=>$params['id']);
			$result=$this->model_globals->delet($table,$paramsData,$paramsKey);

			#Adding to action history
			$paramsAct=array(
							'id_user'	=>$this->profile['id'],
							'action'	=>ACTION_HISTORY_DELETE,
							'data'		=>($result['success'])?json_encode($params):'',
							'result'	=>json_encode($result));
			$this->addActionHistory($paramsAct);
			echo json_encode($result);
		}
	}
	/*-------------------------------------------------------------------------------------------------*/
	public function saveEmployees()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table 		= 'cms_employee';
	 		$tableuser 	= 'cms_user';
	 		$this->load->model('backend/model_globals');
	 		$params 	= $_POST;
	 		$paramsData	= array(
	 						'name'		=> $params['name'],
	 						'address'	=> $params['address'],
	 						'email'		=> $params['email'],
	 						'phone'		=> $params['phone'],
	 						'status'	=> $params['status']);
	 		$paramsKey	= array('id'	=> $params['id']);
	 		$result		= $this->model_globals->checkUI($table, $paramsData, $paramsKey)
	 		if($result)
	 		{
				$result = $this->model_globals->update($table, $paramsData, $paramsKey);
	 			#cek update userdata
	 			if($result['success'])
	 			{
	 				if(empty($params['password']))
	 				{
	 					$ParamsDataUser = array(
											'id_user_type' 	=> $params['id_user_type'],
											'id_privilege' 	=> $params['id_privilege'],
											'username' 		=> $params['username'],
											'status'		=> $params['status']);
	 				} else
	 				{
	 					$ParamsDataUser = array(
											'id_user_type' 	=> $params['id_user_type'],
											'id_privilege' 	=> $params['id_privilege'],
											'username' 		=> $params['username'],
											'userpass' 		=> md5($params['password']),
											'status'		=> $params['status']);		
	 				}
	 				$paramsKeyUser = array('id_employee' => $params['id'])
	 				$this->model_globals->update($tableuser, $ParamsDataUser, $paramsKeyUser);
	 			}
	 			$paramsAct = array(
	 							'id_user'	=>$this->profile['id'],
	 							'action'	=>ACTION_HISTORY_UPDATE,
	 							'data'		=>($result['success'])?json_encode($params):'',
	 							'result'	=>json_encode($result));
	 			$this->addActionHistory($paramsAct);
	 		}else
	 		{
	 			$result	= $this->model_globals->insert($table, $paramsData);
	 			#cek untuk insert userdata
	 			if($result['success'])
	 			{
	 				$ParamsDataUser = array(
	 									'id_employee'	=> $result['id'],
	 									'id_user_type'	=> $params['id_user_type'],
	 									'id_privilege'	=> $params['id_privilege'],
	 									'username'		=> $params['username'],
	 									'userpass'		=> md5($params['password']),
	 									'status'		= $params['status']);
	 				$this->model_globals->insert($tableuser, $ParamsDataUser)
	 			}
	 			#add action history
	 			$paramsAct = array(
	 							'id_user'	=>	$this->profile['id'],
	 							'action'	=>	ACTION_HISTORY_SAVE,
	 							'data'		=>	($result['success'])?json_encode($params):'',
	 							'result'	=> json_encode($result));
		 		$this->addActionHistory($paramsAct)
		 	}
	 	echo json_encode($result);
		}
	 }
	/*-------------------------------------------------------------------------------------------------
	public function cloneEmployees()
	{
		$this->isAjax(404);
		if(sizeof($_POST))
		{
			$table='cms_employee';
			$tableuser='cms_user';
			$this->load->model('backend/model_globals');
			$params=$_POST;
			$paramsData = array(
							'account_type',
							array('name','(Copy)'), #nama harus unik
							'account_id',
							'address',
							array('email','(Copy)'),
							'phone',
							'status'
							);
			$paramsKey = array('id' => $params['id'] );
			$result = $this->model_globals->cloneRecord($table,$paramsData,$paramsKey);  #mengambil status sukses/gagal di modelglobal
			if($result['success'])
			{
				$paramsUser = array(
								'id_employee',
								'id_user_type',
								'id_privilege',
								array('username','(Copy)'),
								'userpass',
								'status'
								);
				$this->model_globals->cloneRecord($tablePrivilegeMenu,$paramsAct);
			}

			#menambah data history
			$paramsAct	= array(
							'id_user'=>$this->profile['id'],
							'action'=>ACTION_HISTORY_CLONE,
							'data'=>($result['success'])?
								json_encode($params):'',
							'result'=>json_encode($result)
							);
			$this->addActionHistory($paramsAct);
			echo json_encode($result);
		}
	}
	-------------------------------------------------------------------------------------------------*/

}

/* End of file employee.php */
/* Location: ./application/controllers/employee.php */