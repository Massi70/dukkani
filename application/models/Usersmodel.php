<?php

class Usersmodel extends CI_Model {

	private $table;

    public function __construct(){

        // Call the Model constructor
        parent::__construct();
		$this->load->library('Memcached_library');
    }

    public function viewUsers(){
		$this->db->select('u.id, count(distinct(order_number)) as TotalOrders, u.english_name,CONCAT(" '.base_url().'uploads/",u.image) as image,
			u.phone,u.email,u.street_address,u.villa_address,u.is_active,u.create_date');
		$this->db->join('orders o','u.id = o.user_id','left');
		$this->db->order_by('id','DESC');
		$this->db->group_by('u.id');
		$sql = $this->db->get_where('users u ',array('u.is_active'=>'1'));
		$data=$sql->result_array();    // fetches record from the products tables
	  	return 	$data;
    }

    public function getUserDetails($user_id){
    	$this->db->select('id, english_name,CONCAT(" '.base_url().'uploads/",image) as image,
			phone,email,street_address,villa_address,is_active,create_date');
		$sql = $this->db->get_where('users',array('is_active'=>'1','id'=>$user_id));
		$data=$sql->row_array();    // fetches record from the products tables
	  	return 	$data;

    }

     public function viewUser($user_id){
		$this->db->select('u.id, count(distinct(order_number)) as TotalOrders, u.english_name,CONCAT(" '.base_url().'uploads/",u.image) as image,
			u.phone,u.email,u.street_address,u.villa_address,u.is_active,u.create_date');
		$this->db->join('orders o','u.id = o.user_id','left');
		$this->db->order_by('id','DESC');
		$this->db->group_by('u.id');
		$sql = $this->db->get_where('users u ',array('u.is_active'=>'1','u.id'=>$user_id));
		$data=$sql->row_array();    // fetches record from the products tables
	  	return 	$data;
    }

    public function updatePassword($id,$data){
    	return $this->db->update('admins', $data, array('id' => $id));
    }

    
   
}

?>