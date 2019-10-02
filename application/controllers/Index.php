<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Adminmodel');
		
	}
	
	/*/*public function index()
	{
		//echo 'hello';exit;
		/*$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		//print_r( $userAdmin);exit;
		if($userAdmin==false){
			redirect(base_url()."index.php/admin/index");
			exit();
		}*/
		
		/*$this->load->model('adminModel');
		$totalAppUsers=$this->adminModel->countAllUsers();
		
		$assignData=array('pageName'=>'index','totalAppUsers'=>$totalAppUsers);
		*/
		//$this->load->view('admin/header',$assignData);
		//$this->load->view('admin/login');
		//$this->load->view('admin/footer');
	//}
	
	/*public function login()
	{
		
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin!=false){
			redirect(base_url()."index.php/admin/");
			exit();
		}
		$this->load->model('adminModel');
		
		 $loginDo=$this->input->post('loginDo');
		 $userName=$this->input->post('user_name');
		 $password=$this->input->post('password');
		 $msg='';
		
		if($userName==false ||  $password==false){
			//$msg = 'false Credentials';
			
		}else{
			$login=$this->adminModel->loginAdmin($userName,$password);
			
			if($login==false){
				$msg='Invalid user name or password';
			}else{
				$this->session->set_userdata(APP_NAME.'_admin',1);
				print_r($this->session->userdata());
				//redirect(base_url().'admin/');
				//exit();
			}
		}
		
		
		$assignData=array('pageName'=>'index','msg'=>$msg);
		//$this->load->view('admin/header',$assignData);
		$this->load->view('admin/sub-admins');
		//$this->load->view('admin/footer');
	}*/

	public function index(){
		//echo 'This is main function';
		//print_r($this->session->userdata());
		$this->load->view('admin/login');

	}

	public function login(){
		 //echo 'Main login function works';

		/*$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin!=false){
			redirect(base_url()."index.php/admin/index");
			exit();
		}*/

		 $loginDo=$this->input->post('loginDo');
		 $userName=$this->input->post('email');
		 $password=$this->input->post('password');
		 $msg='';

		 if($userName==false ||  $password==false){
			//$msg = 'false Credentials';
			
		}else{
			$login=$this->Adminmodel->loginAdmin($userName,$password);
			//print_r($login);
			if($login==false){
				//$login = 0;
				$msg='Invalid user name or password';
			}else{
					//echo 'Login Success';
					$this->session->set_userdata(APP_NAME.'_admin',$login['admin_group_id']);
					//print_r($this->session->userdata());
					//redirect(base_url().'admin/');
					//exit();					
			}
		}

		$assignData=array('pageName'=>'index','msg'=>$msg,'group_id'=>$login['admin_group_id']);
		$this->load->view('admin/header',$assignData);
		//$this->load->view('admin/login');
		$this->load->view('admin/footer');


	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'index.php/admin/index');
		exit();	
			
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */