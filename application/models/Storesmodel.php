<?php
class Storesmodel extends CI_Model{
	private $table;
	
    public function __construct(){
        // Call the Model constructor
        parent::__construct();
		$this->load->library('Memcached_library');
    }
	
 	 public function loginAdmin($userName,$password){
			$sql = "SELECT id,admin_group_id,name,email,password,phone_number,is_active,create_date from `admins` where email = '".$userName."' 
						and password = '".$password."'";
			$query=$this->db->query($sql);
			$data=$query->row_array();
			return 	$data;
	}
	
	public function getAllStores(){
		$this->db->select('id,admin_id,store_name,contact_name,address,CONCAT("'.base_url().'uploads/stores/",image) as image,
			phone_number,description,latitude,longitude,create_date');
		$this->db->where('is_active', '1');
		$this->db->order_by('id','DESC');
		$query= $this->db->get('stores');
		$data=$query->result_array();
		return $data;
	}

	public function deleteStoreById($store_id){
		$data = array('is_active'=>'0');
		$this->db->where('id', $store_id);
		$this->db->update('stores', $data);
	}
	
	public function addStore($data){	
		$result = $this->db->insert('stores', $data);	// insert data into `users` table	
		//return $this->db->insert_id();
	}

	
	public function detailsByStoreId($store_id){
		$this->db->select('id,admin_id,store_name,contact_name,address,CONCAT("'.base_url().'uploads/stores/",image) as image,
			phone_number,description,latitude,longitude,create_date');
		$this->db->order_by('id','DESC');
		$query= $this->db->get_where('stores',array('is_active'=>'1','id'=>$store_id));
		$data=$query->row_array();
		return $data;

	}

	public function updateStore($data,$store_id){
		//echo $store_id;exit;
		//print_r($data);exit();
		$this->db->where('id', $store_id);
		$this->db->update('stores', $data);
	}
	
}
?>