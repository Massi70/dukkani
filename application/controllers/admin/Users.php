<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin==false){
			redirect(base_url()."admin/Users");
			exit();
		}
		$this->load->model('Adminmodel');
		$this->load->model('Usersmodel');
		$this->load->model('Ordersmodel');
		//$this->load->helper('my_helper');
	}

	public function index(){
		//echo 'hello Sub-admins';exit;
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin==false){
			redirect(base_url()."admin/Index/login");
			exit();
		}

		$subAdmins = $this->Adminmodel->getAllSubAdmins();
		//print_r($subAdmins);
		$assignData = array('pageName'=>'sub-admins','subAdmins'=>$subAdmins);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/sub-admins',$assignData);
		$this->load->view('admin/footer');
			
	}

	public function addSubAdmin(){
		$assignData = array('pageName'=>'sub-admins');
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/add-subadmin',$assignData);
		$this->load->view('admin/footer');
	}

	public function addNewSubAdmin(){
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$phone = $this->input->post('phone');
		$date = date('Y-m-d H:i:s');
		$msg='';
		if($email==false ||  $phone==false){
			
		}else{
			$checkAdmin = $this->Adminmodel->checkSubAdmins($email);
			//echo "<pre>";print_r(($checkAdmin));exit;
			$data = array('admin_group_id'=>'2','name'=>$name,'email'=>$email,'password'=>base64_encode($password),
				'phone_number'=>$phone,'is_active'=>'1','create_date'=>$date);
			if(($checkAdmin) > 0){
				$msg = 'Email Already Exists';
				$assignData = array('pageName'=>'sub-admins','msg'=>$msg);
				$this->load->view('admin/header',$assignData);
				$this->load->view('admin/add-subadmin',$assignData);
				$this->load->view('admin/footer');
			}else{
				$msg = 'Success';
				$this->Adminmodel->addSubAdmin($data);
				redirect(base_url()."admin/Users/index");
				exit;
			}
		}

	}

	public function deleteSubAdmin($id){
		$this->Adminmodel->deleteSubAdmin($id);
		redirect(base_url()."admin/Users/index/");
		exit();
	}

	public function profile($id){
		$profile = $this->Adminmodel->getAllSubAdminsData($id);
		//echo '<pre>';print_r($profile);exit;
		$assignData = array('pageName'=>'profile','profile'=>$profile);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/profile',$assignData);
		$this->load->view('admin/footer');
	}

	public function editProfile($id){
		$profile = $this->Adminmodel->editProfile($id);
		$assignData = array('pageName'=>'profile','profile'=>$profile);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/profile-update',$assignData);
		$this->load->view('admin/footer');
	}

	public function updateProfile($id){
		
		//echo 'Id : '.$id;
		$name=$this->input->post('name');
		$phone=$this->input->post('phone');
		$msg='';

		$data = array('name'=>$name,'phone_number'=>$phone);

		$profile = $this->Adminmodel->updateProfile($id,$data);

		if(count($profile)>0){
			$msg='Profile updated successfully';
			redirect(base_url()."admin/Users/profile/".$id);
			exit();
		}else{
			$msg = 'Profile can not be updated';
		}
	}
	
	public function checkUsers($user_email){
		//echo $user_email;
		$checkUser = $this->adminModel->checkUserEmail($user_email);
		echo $checkUser;
	}

	public function viewUsers(){
		$viewUsers = $this->Usersmodel->viewUsers();
		$assignData = array('pageName'=>'users','viewUsers'=>$viewUsers);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/onlineusers',$assignData);
		$this->load->view('admin/footer');

	}

	public function getUserDetails($user_id){
		$userDetails = $this->Usersmodel->getUserDetails($user_id);
		$viewUsers = $this->Usersmodel->viewUser($user_id);
		$assignData = array('pageName'=>'users','userDetails'=>$userDetails,'viewUsers'=>$viewUsers);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/userdetails',$assignData);
		$this->load->view('admin/footer');
	}

    public function settings($user_id){
    	$assignData = array('pageName'=>'settings','user_id'=>$user_id);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/settings',$assignData);
		$this->load->view('admin/footer');

    }

     public function updatePassword($user_id){
     	$password=$this->input->post('password');
    	$msg='';
		$data = array('password'=>base64_encode($password));
		$update = $this->Usersmodel->updatePassword($user_id,$data);

    	if(count($update)>0){
			$msg='Password updated successfully';
			session_unset();
			session_destroy();
			redirect(base_url()."admin/Index/login");
			exit();
		}else{
			$msg = 'Profile can not be updated';
		}

    }

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */