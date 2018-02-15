<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
	protected $data			= array();
	protected $profile 		= array();
	protected $uri_string 	= NULL;
	
	function __construct()
	{
		parent::__construct();
				
		#Set data to display on View
		$this->data['base_url'] = $this->config->item('base_url');
		$this->data['base_url_index'] = $this->config->item('base_url_index');

		#Set data to display on View
		$this->data['globalParameter'] = $this->model_global_parameter->loadGlobalParameter();
    }
    /*-------------------------------------------------------------------------------------------------*/
    #Ajax Checking
    protected function isAjax($responseCode = 404){
		if (!$this->input->is_ajax_request())
			die(http_response_code($responseCode));
	}
	/*-------------------------------------------------------------------------------------------------*/
	#Getting URI STRING
	protected function getUriString()
	{
		#Creating URI String (Menu)
		$url = explode('/', $this->uri->uri_string());
		if(count($url) > 2)
		{
			$this->uri_string = $url[0].'/'.$url[1];
		} else
			$this->uri_string = $this->uri->uri_string();
	}
	/*-------------------------------------------------------------------------------------------------*/
    
}
