<?php
class Adminmodel extends CI_Model{
	private $table;
	
    public function __construct(){
        // Call the Model constructor
        parent::__construct();
		$this->load->library('Memcached_library');
    }
	
 	 public function loginAdmin($userName,$password){
			$sql = "SELECT id,admin_group_id,name,email,password,phone_number,is_active,create_date from `admins` where email = '".$userName."' 
						and password = '".base64_encode($password)."' and is_active = '1' ";
			$query=$this->db->query($sql);
			$data=$query->row_array();
			return 	$data;
	}
	
	public function countAllUsers($search=''){
		if($search==''){
			$this->db->select('count(id) as total')->from('users');
		}else{
			$this->db->select('count(id) as total')->from('users')->like('arabic_name',trim($search),'english_name',trim($search),'email',trim($search));
		}
		$query= $this->db->get();
		$data=$query->row_array();
		return $data['total'];
	}

	public function getAllSubAdmins(){

		$this->db->select('id, admin_group_id, name, email, phone_number, is_active, create_date');
		$this->db->where(array('admin_group_id' => '2', 'is_active' => '1'));
		$this->db->order_by('id', 'DESC');
		$sql = $this->db->get('admins');
		$data=$sql->result_array();    // fetches record from the products tables
	  	return 	$data;
	}

	/*public function getAllSubAdminsData($id){

		$this->db->select('id, admin_group_id, name, email, phone_number, is_active, create_date');
		$this->db->where(array('admin_group_id' => '2', 'is_active' => '1', 'id'=>$id));
		$sql = $this->db->get('admins');
		$data=$sql->row_array();    // fetches record from the products tables
	  	return 	$data;
	}*/

	public function getAllSubAdminsData($id){

		$this->db->select('id, admin_group_id, name, email, phone_number, is_active, create_date');
		$this->db->where(array('is_active' => '1', 'id'=>$id));
		$sql = $this->db->get('admins');
		$data=$sql->row_array();    // fetches record from the products tables
	  	return 	$data;
	}

	/*public function editProfile($id){

		$this->db->select('id, admin_group_id, name, email, phone_number, is_active, create_date');
		$this->db->where(array('admin_group_id' => '2', 'is_active' => '1', 'id'=>$id));
		$sql = $this->db->get('admins');
		$data=$sql->row_array();    // fetches record from the products tables
	  	return 	$data;
	}*/

	public function editProfile($id){

		$this->db->select('id, admin_group_id, name, email, phone_number, is_active, create_date');
		$this->db->where(array('is_active' => '1', 'id'=>$id));
		$sql = $this->db->get('admins');
		$data=$sql->row_array();    // fetches record from the products tables
	  	return 	$data;
	}

	public function updateProfile($id,$data){
		return $this->db->update('admins', $data, array('id' => $id));
	}


	public function getUserData($id){
		$this->db->select('id, english_name, email, phone,address,CONCAT(" '.base_url().'uploads/users/",image) as image, latitude, longitude,
		other_info, is_active, create_date');
		$this->db->where(array('is_active' => '1'));
		$sql = $this->db->get('users');
		$data=$sql->row_array();    // fetches record from the products tables
	  	return 	$data;

	}	

	public function checkSubAdmins($email){
		//echo 'ths'.$email,$phone;exit;
	  	$sql = $this->db->get_where("admins",array("email"=>$email));
		$res = $sql->num_rows();
		return $res;

	}

	public function addSubAdmin($data){
		$this->db->insert('admins', $data);	
		return $id = $this->db->insert_id();	
	}

	public function deleteSubAdmin($id){
		$data = array('is_active'=>'0');
		$this->db->where('id', $id);
		$this->db->where('admin_group_id !=', '1');
		$this->db->update('admins', $data);
	}

}
?>