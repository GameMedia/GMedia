<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_privilege_menu extends MY_Model 
 {
 		private $tablePrivilege_Menu = 'cms_privilege_menu';
		private $tablePrivilege = 'cms_privilege';
		private $tableMenu = 'cms_menu';
		private $tableUserType = 'cms_user_type';

 		public function __construct()
 		{
 			parent::__construct();
 			$this->loadDbCms();
 		}
		/*-------------------------------------------------------------------------------------------------*/

		public function loadMenuSelect($params = array())
		{
			$result = array();
					
			$this->dbCms->select('me.id, me.name, me.parent, me.url, me.status, me.sort, me.icon');
			//$this->dbCms->select('(SELECT sort FROM '.$this->tableMenu.' WHERE parent=me.parent AND me.sort > sort ORDER BY sort ASC LIMIT 1) AS sort_up');
			//$this->dbCms->select('(SELECT sort FROM '.$this->tableMenu.' WHERE parent=me.parent AND me.sort < sort ORDER BY sort ASC LIMIT 1) AS sort_down');
			$this->dbCms->select('(SELECT COUNT(1) FROM '.$this->tableMenu.' WHERE parent = me.id AND status != "-1") AS child');
			$this->dbCms->from($this->tableMenu.' me');
			$this->dbCms->where('me.status !=', '-1');
				
			if(isset($params['privilege'])){
				$this->dbCms->select('pm.id_privilege, pv.name AS name_privilege, pm.access');
				$this->dbCms->join($this->tablePrivilege_Menu.' pm', 'me.id = pm.id_menu');
				$this->dbCms->join($this->tablePrivilege.' pv', 'pv.id = pm.id_privilege');
				if(!empty($params['privilege']))
					$this->dbCms->where('pm.id_privilege', $params['privilege']);
				if(!empty($params['menu']))
					$this->dbCms->where('pm.id_menu', $params['menu']);
				if(!empty($params['name']))
					$this->dbCms->where('me.name', $params['name']);
				if(!empty($params['status']))
					$this->dbCms->where('me.status', $params['status']);
				if(!empty($params['icon']))
					$this->dbCms->where('me.icon', $params['icon']);
			}
		
			if($params['parent'] != '')
			$this->dbCms->where('me.parent', $this->dbCms->escape_str($params['parent']));
			$this->dbCms->order_by('me.sort', 'ASC');
			$query = $this->dbCms->get();
			
			$i=0;
			if($query->num_rows() != 0){
				$result['count'] = true;
				$level = !empty($params['level'])?$params['level']:0;
				foreach($query->result_array() as $row) {
					$result['rows'][$level][$i]['id'] = $row['id'];
					$result['rows'][$level][$i]['name'] = $row['name'];
					$result['rows'][$level][$i]['parent'] = $row['parent'];
					$result['rows'][$level][$i]['url'] = $row['url'];
					$result['rows'][$level][$i]['status'] = $row['status'];
					$result['rows'][$level][$i]['level'] = $level;
					$result['rows'][$level][$i]['icon'] = $row['icon'];
					$result['rows'][$level][$i]['child'] = $row['child'];
					$result['rows'][$level][$i]['id_privilege'] = isset($row['id_privilege'])?$row['id_privilege']:'';;
					$result['rows'][$level][$i]['name_privilege'] = isset($row['name_privilege'])?$row['name_privilege']:'';
					$result['rows'][$level][$i]['access'] = isset($row['access'])?$row['access']:'0';
					if(!empty($row['child'])){
						$result['rows'][$row['id']] = $this->loadMenuChildSelect(array('parent' => $row['id'], 'level' => $level+1), $params);
						foreach($result['rows'][$row['id']] as $key => $val){
							if($val['child'])
								$result['rows'][$val['id']] = $this->loadMenuChildSelect(array('parent' => $val['id'], 'level' => $level+2), $params);
						}
					}
					$i++;
				}
			} else {
				$result['count'] = false;
				$result['title'] = DB_TITLE_RESULT;
				$result['message'] = DB_NULL_RESULT;
			}
			
			return $result;
		}
		/*-------------------------------------------------------------------------------------------------*/

		public function loadMenuChildSelect($params = array(), $paramsPost = array())
		{
			$result = array();
					
			$this->dbCms->select('me.id, me.name, me.parent, me.url, me.status, me.sort, me.icon');
			//$this->dbCms->select('(SELECT sort FROM '.$this->tableMenu.' WHERE parent=me.parent AND me.sort > sort ORDER BY sort ASC LIMIT 1) AS sort_up');
			//$this->dbCms->select('(SELECT sort FROM '.$this->tableMenu.' WHERE parent=me.parent AND me.sort < sort ORDER BY sort ASC LIMIT 1) AS sort_down');
			$this->dbCms->select('(SELECT COUNT(1) FROM '.$this->tableMenu.' WHERE parent = me.id AND status != "-1") AS child');
			$this->dbCms->from($this->tableMenu.' me');
			$this->dbCms->where('me.status !=', '-1');
			
			
			if(isset($paramsPost['privilege'])){
				$this->dbCms->select('pv.name AS name_privilege, pm.access, pm.id_privilege');
				$this->dbCms->join($this->tablePrivilege_Menu.' pm', 'me.id = pm.id_menu');
				$this->dbCms->join($this->tablePrivilege.' pv', 'pv.id = pm.id_privilege');
				if(!empty($paramsPost['privilege']))
					$this->dbCms->where('pm.id_privilege', $paramsPost['privilege']);
				if(!empty($paramsPost['menu']))
					$this->dbCms->where('pm.id_menu', $paramsPost['menu']);
				if(!empty($paramsPost['name']))
					$this->dbCms->where('me.name', $paramsPost['name']);
				if(!empty($paramsPost['status']))
					$this->dbCms->where('me.status', $paramsPost['status']);
				if(!empty($paramsPost['icon']))
					$this->dbCms->where('me.icon', $paramsPost['icon']);
			}
			
			if($params['parent'] != '')
				$this->dbCms->where('me.parent', $this->dbCms->escape_str($params['parent']));
			
			$this->dbCms->order_by('me.sort', 'ASC');
			$query = $this->dbCms->get();
					
			$i=0;
			if($query->num_rows() != 0){
				#$result['count'] = true;
				$level = !empty($params['level'])?$params['level']:1;
				foreach($query->result_array() as $row) {
					$result[$i]['id'] = $row['id'];
					$result[$i]['name'] = $row['name'];
					$result[$i]['parent'] = $row['parent'];
					$result[$i]['url'] = $row['url'];
					$result[$i]['status'] = $row['status'];
					//$result[$i]['sort'] = $row['sort'];
					$result[$i]['level'] = $level;
					$result[$i]['child'] = $row['child'];
					//$result[$i]['sort_up'] = $row['sort_up'];
					//$result[$i]['sort_down'] = $row['sort_down'];
					$result[$i]['icon'] = $row['icon'];
					$result[$i]['id_privilege'] = isset($row['id_privilege'])?$row['id_privilege']:'';
					$result[$i]['name_privilege'] = isset($row['name_privilege'])?$row['name_privilege']:'';
					$result[$i]['access'] = isset($row['access'])?$row['access']:'0';
					$i++;
				}
			} else {
				$result['count'] = false;
				$result['title'] = DB_TITLE_RESULT;
				$result['message'] = DB_NULL_RESULT;
			}
			return $result;
		}
		/*-------------------------------------------------------------------------------------------------*/

		public function getMenuAll($params = array())
		{
			$this->dbCms->select('id, url, name, description, icon, parent, status');
			$this->dbCms->from($this->tableMenu);
			$query = $this->dbCms->get();
			$result = array();
			if($query->num_rows() !=0)
			{
				$result['count'] = true;
				$i=0;
				foreach ($query->result_array() as $row) 
				{
					$result[$i]['id'] = $row['id'];
					$result[$i]['url'] = $row['url'];
					$result[$i]['name'] = $row['name'];
					$result[$i]['description'] = $row['description'];
					$result[$i]['parent'] = $row['parent'];
					$result[$i]['icon'] = $row['icon'];
					$result[$i]['status'] = (int) $row['status'];
					$i++;
				}
			}
		}
 }

/* End of file Model_privilege_menu.php */
/* Location: .//C/xampp/htdocs/Gmedia/app/models/backend/user-management/Model_privilege_menu.php */