<?php
class Ordersmodel extends CI_Model{
	private $table;
	
    public function __construct(){
        // Call the Model constructor
        parent::__construct();
		$this->load->library('Memcached_library');
    }
	
	
	public function getUserOrders($user_id){
		$this->db->select('count(id) as Total');
		$query= $this->db->get_where('orders',array('user_id'=>$user_id));
		$data=$query->row_array();
		return $data;
	}

	public function getAllOrders(){
		$this->db->select('o.user_id,o.order_number,u.english_name,DATE_FORMAT(o.create_date, "%Y-m-%d")  as OrderDate,
			count(distinct(order_number)) as TotalOrders,CONCAT(" '.base_url().'uploads/",u.image) as Userimage,
			o.product_id,p.store_id,s.store_name, CONCAT(" '.base_url().'uploads/stores/",s.image) as Storeimage');
		$this->db->join('users u','u.id = o.user_id','left');
		$this->db->join('products p','p.id = o.product_id','left');
		$this->db->join('stores s','s.id = p.store_id','left');
		$where = "DATE(o.create_date) = DATE(NOW())";
		$this->db->where($where);
		$this->db->order_by('o.create_date','DESC');
		$this->db->group_by('u.id');
		$result = $this->db->get('orders o');	
		$data = $result->result_array();
		return $data;
	}


	public function getAllOrdersDelivered(){
		$this->db->select('o.user_id,o.order_number,u.english_name,DATE_FORMAT(o.create_date, "%Y-m-%d")  as OrderDate,
			count(distinct(order_number)) as TotalOrders,CONCAT(" '.base_url().'uploads/",u.image) as Userimage,
			o.product_id,p.store_id,s.store_name, CONCAT(" '.base_url().'uploads/stores/",s.image) as Storeimage');
		$this->db->join('users u','u.id = o.user_id','left');
		$this->db->join('products p','p.id = o.product_id','left');
		$this->db->join('stores s','s.id = p.store_id','left');
		$this->db->order_by('o.create_date','DESC');
		//$this->db->group_by('u.id');
		$this->db->group_by('o.order_number');
		$result = $this->db->get_where('orders o',array('o.order_status'=>'delivered'));	
		$data = $result->result_array();
		return $data;
	}

	public function getAllOrdersCancelled(){
		$this->db->select('o.user_id,o.order_number,u.english_name,DATE_FORMAT(o.create_date, "%Y-m-%d")  as OrderDate,
			count(distinct(order_number)) as TotalOrders,CONCAT(" '.base_url().'uploads/",u.image) as Userimage,
			o.product_id,p.store_id,s.store_name, CONCAT(" '.base_url().'uploads/stores/",s.image) as Storeimage');
		$this->db->join('users u','u.id = o.user_id','left');
		$this->db->join('products p','p.id = o.product_id','left');
		$this->db->join('stores s','s.id = p.store_id','left');
		$this->db->order_by('o.create_date','DESC');
		//$this->db->group_by('u.id');
		$this->db->group_by('o.order_number');
		$result = $this->db->get_where('orders o',array('o.order_status'=>'cancelled'));	
		$data = $result->result_array();
		return $data;
	}

	public function getAllOrdersPending(){
		$this->db->select('o.user_id,o.order_number,u.english_name,DATE_FORMAT(o.create_date, "%Y-m-%d")  as OrderDate,
			count(distinct(order_number)) as TotalOrders,CONCAT("'.base_url().'uploads/",u.image) as Userimage,
			o.product_id,p.store_id,s.store_name, CONCAT(" '.base_url().'uploads/stores/",s.image) as Storeimage');
		$this->db->join('users u','u.id = o.user_id','left');
		$this->db->join('products p','p.id = o.product_id','left');
		$this->db->join('stores s','s.id = p.store_id','left');
		$this->db->order_by('o.create_date','DESC');
		//$this->db->group_by('u.id');
		$this->db->group_by('o.order_number');
		$result = $this->db->get_where('orders o',array('o.order_status'=>'pending'));	
		$data = $result->result_array();
		return $data;
	}

	public function getOrderUserDetails($order_number){
		$this->db->select('u.id,u.english_name as UserName,CONCAT("'.base_url().'uploads/",u.image) as Userimage,u.street_address,
			u.villa_address,o.order_number');
		$this->db->join('users u','u.id = o.user_id','left');
		$this->db->group_by('u.id');
		$result = $this->db->get_where('orders o',array('o.order_number'=>$order_number));	
		$data = $result->result_array();
		return $data;
	}

	public function getOrderDetails($order_number){
		$this->db->select('p.english_name,o.order_number,o.product_id,o.quantity,o.product_price,o.price_per_quantity,o.admin_id');
		$this->db->join('products p','p.id = o.product_id','left');
		$result = $this->db->get_where('orders o',array('o.order_number'=>$order_number));	
		$data = $result->result_array();
		return $data;
	}

	public function getOrderDetailsExport($order_number){
		$this->db->select('u.english_name as UserName,u.street_address,u.villa_address,u.phone,p.english_name,o.order_number,o.product_id,o.quantity,o.product_price,o.price_per_quantity');
		$this->db->join('products p','p.id = o.product_id','left');
		$this->db->join('users u','u.id = o.user_id','left');
		$result = $this->db->get_where('orders o',array('o.order_number'=>$order_number));	
		$data = $result->result_array();
		return $data;
	}

	function updateStatus($order_number,$status,$admin_id){
   		$data = array('order_status'=>$status,'admin_id'=>$admin_id);
   		//echo $id . " and ". $status;exit;
		return $this->db->update('orders', $data, array('order_number' => $order_number));
	}


}
?>