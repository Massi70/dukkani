<?php 
//defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->load->model('Usersmodel');
		header('Content-Type: text/html; charset=utf-8');
		//header('Content-Type: text/html; charset=utf-8');
		//header('Content-type: application/json');
   }
	
	private $_jsonData = array();
		
		/*************************** sign up code starts ***************************/
	
	public function register(){

		//echo 'controller calls Masroor';exit;
		$ar_name = $this->input->post_get('ar_name');
		$en_name = $this->input->post_get('en_name');
	try{
			if($ar_name == false || $ar_name == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="ar_name Missing";
			}else if($en_name == false || $en_name == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="en_name Missing";
			}else{
						$data = array(
								'ar_name'=>$ar_name,
								'en_name'=>$en_name,
							);
						$res = $this->Usersmodel->addUser($data);
						$data['id'] = $res;
						$this->_jsonData['status']=1;
						$this->_jsonData['message']="User Data Inserted Successfully";
						$this->_jsonData['data']=$data; 
		  }
		echo json_encode($this->_jsonData);
	}catch(Exception $e){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="Error Occured";
		}
		
	}

	
	public function signin(){
				$res = $this->Usersmodel->login();
				$this->_jsonData['status']=1;
				$this->_jsonData['message']="User Data got Successfully";
				$this->_jsonData['data']=$res; 
				echo json_encode($this->_jsonData);
	}

} // controller ends
