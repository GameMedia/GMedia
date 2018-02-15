<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller_Admin extends MY_Controller {

	protected $folder 			= 'backend/';
	protected $folderlayout		= 'backend/layout/';
	protected $folderview		= 'backend/metronic/';
	/*-------------------------------------------------------------------------------------------------*/
	public function __construct()
	 {
		parent::__construct();
		$this->isLogin();
		$this->isAdmin(); #cek request user
		$this->data['folder']		= $this->folder;		#setbackend folder
		$this->data['folderlayout']	= $this->folderlayout;	#setbackend folder layout
		$this->data['folderview']	= $this->folderview;	#setbackend folder view
		$this->getUriString();
		$this->getAccess();
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	 {
	 }
	/*-------------------------------------------------------------------------------------------------*/
	private function isAdmin()
	 {
	 	$_sessProfile			= $this->session->userdata('profile');
	 	$this->profile 			= $_sessProfile;
	 	$this->data['profile']	= $_sessProfile;

	 	if(!$_sessProfile['isAdmin'])
	 		redirect($this->data['base_url_index'].'backend', 'location', 301);

	 	return true;
	 }
	/*-------------------------------------------------------------------------------------------------*/
	protected function isLogin()
	 {
	 	$_sessProfile = $this->session->userdata('profile');  	#mengambil session data
	 	$_sessLocked = $this->session->userdata('isLocked');  	#mengambil data session privilege

	 	if(!isset($_sessProfile))
	 	{
	 		if($this->input->is_ajax_reques())
	 		{
	 			echo json_encode(array('succes'=>'out','url'=>$this->data['base_url_index'].$this->folder));
	 			die();
	 		} else
	 		{
	 			redirect($this->data['base_url_index'].$this->folder,'location', 301);	
	 		}
	 	}else
	 	{
	 		if($_sessLocked) #menampilkan menu lockscreen
	 		{
	 			redirect($this->data['base_url_index'].'backend/lockscreen','location', 301);
	 		}	
	 	}
	 }
	/*-------------------------------------------------------------------------------------------------*/
	protected function loadMenu()
	 {
		$_sessProfile=$this->session->userdata('profile');
		$_sessPrivilege=$this->session->userdata('privilege');
		$_sessIsLogged=$this->session->userdata['isLogged'];

		if(!$_sessProfile['isAdmin'])
		{
			return false;
		}

		$_modelMenu=$this->load->model('mode_menu');
		$this->data['parentList']		=$this->mode_menu->loadParentList($this->uri_string,$_sessPrivilege['privilege_id']);
		$this->data['menu']				=$this->model_menu->load_menu($_sessPrivilege['menu']);
		$this->data['pageTitle']		=$this->data['parentList']['name'][0];
		$this->data['pageDescription']	=$this->data['parentList']['description'][0];
		return true;
	 }
	/*-------------------------------------------------------------------------------------------------*/
	protected function getAccess() #perhitungan biner untuk Hak Aksess
	 {
	 	$_sessProfile=$this->session->userdata('profile');
	 	$_sessPrivilege=$this->session->userdata('privilege');
	 	$_sessIsLogged=$this->session->usedata('isLogged');

	 	if(!$_sessProfile['isAdmin'])
	 		return false;
	 	$_modelMenu=$this->load->model('model_menu');
	 	$this->data['parentList']=$this->model_menu->loadParentList($this->uri_string, $_sessPrivilege['privilege_id']);
	 	$access=$this->data['parentList']['access'];
	 	$this->data['accessView']=(!(1&$access) !=0)?0:1;
	 	$this->data['accessAdd']=(!(2&$access)) !=0)?0:1;
		$this->data['accessEdit']=(!(4&$access)) !=0)?0:1;
		$this->data['accessDelete']=(!(8&$access)) !=0)?0:1;
		return true;
	 }

	/*-------------------------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------------------------*/


	/*-------------------------------------------------------------------------------------------------*/




}

/* End of file mY_Controller_Admin.php */
/* Location: ./application/controllers/mY_Controller_Admin.php */