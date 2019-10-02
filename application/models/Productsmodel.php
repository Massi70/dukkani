<?php
class Productsmodel extends CI_Model{
	private $table;
	
    public function __construct(){
        // Call the Model constructor
        parent::__construct();
		$this->load->library('Memcached_library');
    }
	
	
	public function getProductsByStore($store_id){
		$this->db->select('id,admin_id,store_id,english_name,CONCAT("'.base_url().'uploads/products/",image) as image,
			price,description,size_id,flavor_id,color,is_active,create_date');
		$this->db->order_by('id','DESC');
		$query= $this->db->get_where('products',array('is_active'=>'1','store_id'=>$store_id));
		$data=$query->result_array();
		return $data;
	}

	public function deleteProductsByStore($product_id){
		$data = array('is_active'=>'0');
		$this->db->where('id', $product_id);
		$this->db->update('products', $data);
	}

	public function deleteAllProductsByStore($store_id){
		$data = array('is_active'=>'0');
		$this->db->where('store_id', $store_id);
		$this->db->update('products', $data);
	}
	
	function addStore($data){	
		$result = $this->db->insert('stores', $data);	// insert data into `users` table	
		//return $this->db->insert_id();
	}

	function getAllCategories(){	
		$result = $this->db->get_where('categories', array('is_active'=>'1'));	// insert data into `users` table	
		$data = $result->result_array();
		return $data;
	}

	function addProduct($data){	
		$result = $this->db->insert('products', $data);	// insert data into `users` table	
		//return $this->db->insert_id();
	}

	function productDetailsByStore($product_id){
		$this->db->select('products.id,products.admin_id,products.store_id,products.category_id,products.english_name,CONCAT("'.base_url().'uploads/products/",products.image) as image,
			products.price,products.description,products.size_id,products.flavor_id,products.color,products.is_active,products.create_date,stores.store_name');
		$this->db->join('stores','stores.id = products.store_id','left');
		$this->db->order_by('products.id','DESC');
		$query= $this->db->get_where('products',array('products.is_active'=>'1','products.id'=>$product_id));
		$data=$query->row_array();
		return $data;
	}
	
	public function updateProduct($data,$product_id){
		//echo $store_id;exit;
		//print_r($data);exit();
		$this->db->where('id', $product_id);
		$this->db->update('products', $data);
	}

	public function addFlavors($data){
		$result = $this->db->insert('flavors', $data);
	}

	public function addWeights($data){
		$result = $this->db->insert('sizes', $data);
	}

	public function getSizesById($product_id){
		$this->db->select('id,size');
		$sql = $this->db->get_where('sizes',array('product_id'=>$product_id));
		$data=$sql->result_array();    // fetches record from the stores tables
	  	return 	$data;

	}

	public function getFlavorsById($product_id){
		$this->db->select('id,flavor');
		$sql = $this->db->get_where('flavors',array('product_id'=>$product_id));
		$data=$sql->result_array();    // fetches record from the stores tables
	  	return 	$data;

	}
}
?>