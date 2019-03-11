<?php

class Controller_Main extends Controller
{
	function __construct(){
		$this->model = new Model_Main();
		$this->view = new View();
	}
	
	
	
	function action_index(){
	    $data['countries'] = $this->model->getCountrys('countries', array('cnt_id','cnt_title', 'cnt_code'), 'cnt_id');
	    $data['users'] = $this->model->getUsers('users', array('usr_id', 'usr_name'), 'usr_name');
	    $data['from_date'] = $data['to_date'] =  $this->model->getDataForCombo('send_log', 'log_created', 'log_created');
	
	   $this->view->generate('main_view.php', 'template_view.php',$data);
	}
	
	function action_showdata(){
	    $data['error'] = array();
	    $data['data'] = array();
	    $from_date = null;
	    $to_date = null;
	    $users = null;
	    $countries = null;
	   
	    if(!empty($_POST['from_date'] && !empty($_POST['to_date']))){
	        $from_date = $_POST['from_date'];
	        $to_date  = $_POST['to_date'];
	       
	        if(!empty($_POST['users'])){
	            $users = $_POST['users'];
	        }else{
	            $data['error']['users'] = 'Empty user data';
	        }
	        
	        if(!empty($_POST['countries'])){
	            $countries = $_POST['countries'];
	        }else{
	            $data['error']['countries'] = 'Empty country data';
	        }
	        
	        $data['data'] =  $this->model->GetDateFromSendLog($from_date, $to_date, $countries, $users);
	       
	    }else{
	        if(empty($_POST['from_date'])){
	           $data['error']['from_date'] = 'empty From Date - required';
	        }
	        
	        if(empty($_POST['to_date'])){
	            $data['error']['to_date'] = 'empty To Date - required';
	        }
	        
	       }
	       
	       echo json_encode($data);
	       die();
	}
}