<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		
	}
	
	public function index()
	{
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin==false){
			redirect(base_url()."admin/Index/login");
			exit();
		}
		
		$this->load->model('Adminmodel');
		//echo 'ID: '.$group_id;
		//$totalAppUsers=$this->Adminmodel->countAllUsers();
		//if($group_id == '1'){
			$assignData=array('pageName'=>'sub-admins');
			$this->load->view('admin/header',$assignData);
			$this->load->view('admin/sub-admins');
			$this->load->view('admin/footer');
		
	}
	
	public function login()
	{
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin!=false){
			redirect(base_url()."admin/Index/login");
			exit();
		}
		$this->load->model('Adminmodel');
		
		$loginDo=$this->input->post('loginDo');
		$userName=$this->input->post('email');
		$password=$this->input->post('password');
		$msg='';
		$group_id='';
		if($userName==false ||  $password==false){
			
		}else{
			$login=$this->Adminmodel->loginAdmin($userName,$password);
			//echo "<pre>";print_r($login);exit;
			if($login==false){
				$msg='Invalid user name or password'; 
			}else{
				$group_id = $login['admin_group_id'];
				$id = $login['id'];
				$this->session->set_userdata(APP_NAME.'_admin',$group_id);
				if($group_id == '2'){
					//echo $id;exit;
					redirect(base_url().'admin/Users/profile/'.$id);
					exit();
				}else{
					redirect(base_url().'admin/Users/index');
					exit();
				}
			}
		}
		
		$assignData=array('pageName'=>'index','msg'=>$msg,'group_id'=>$group_id);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/login');
		$this->load->view('admin/footer');
		
		
	}

	
	public function logout(){
		$this->session->unset_userdata(APP_NAME.'_admin');
		$this->session->sess_destroy();
		redirect(base_url().'index.php/admin/index');
		exit();	
			
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */