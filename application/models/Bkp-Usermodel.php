<?php

class Usermodel extends CI_Model {

	private $table;

    public function __construct(){

        // Call the Model constructor
        parent::__construct();
		$this->load->library('Memcached_library');
    }


    public function getUserData($uId,$refresh=0){

		$key=APP_NAME.'user-'.$uId;

		$data = $this->emcached_library->get($key);

		if($refresh==1){
			$data =false;
		}
		if($data==false){
			$this->db->select('user_id,user_name,user_email,user_status')->from('user')->where('user_id',$uId);
			$query= $this->db->get();
			$data=$query->row_array();
			$this->memcached_library->set($key,$data);
		}
		return $data;
	}

	public function createUser($data){
		if($this->db->insert('user', $data)){
			 $userId=$this->db->insert_id() ;
			 $this->getUserData($userId,1);
		 	 return  $userId;
		}else{
			return false;
		}
    }
	
	function addUser($data){	
		$this->db->insert('users', $data);	// insert data into `users` table
		return $id = $this->db->insert_id();	

	}

	function addFbUser($data){	
		$this->db->insert('users', $data);	// insert data into `users` table
		return $id = $this->db->insert_id();	

	}

	function addGoogleUser($data){	
		$this->db->insert('users', $data);	// insert data into `users` table
		return $id = $this->db->insert_id();	

	}

	
	function checkUserEmail($user_email)
	{
		 $sql = $this->db->get_where("users",array("email"=>$user_email));
		 $res = $sql->num_rows();
		 return $res;
    }

   
   function checklogin($user_email,$password){
		$sql = $this->db->get_where("users",array("email"=>$user_email,"password"=>$password,"is_active"=>'1'));
		$res = $sql->num_rows();
		return $res;
   }
   
   function login($user_email,$password){
		//$sql = $this->db->query('select * from user where user_email="'.$user_email.'"  and password ="'.$password.'"');
		$sql = $this->db->get_where('users',array("email"=>$user_email,"password"=>$password,"is_active"=>'1'));
		$res = $sql->row_array();
		return $res;
   }


   function fbLogin($fb_id){
		//$sql = $this->db->query('select * from user where fb_id="'.$fb_id.'"');
		$sql = $this->db->get_where('users',array("fb_id"=>$fb_id,"is_active"=>'1'));
		$res = $sql->row_array();
		return $res;
   } 

   function gmailLogin($gmail_id){
		//$sql = $this->db->query('select * from user where twitter_id="'.$twitter_id.'"');
		$sql = $this->db->get_where('users',array("gmail_id"=>$gmail_id,"is_active"=>'1'));
		$this->db->where('is_active', '1');
		$res = $sql->row_array();
		return $res;
   }

   function getCategories($language){
   		if($language == 'arabic'){
			$this->db->select('id, arabic_name, is_active, create_date');
   		}else{
   			$this->db->select('id, english_name, is_active, create_date');
   		}
		$this->db->where('is_active', '1');
		$sql = $this->db->get('categories');
		$data=$sql->result_array();    // fetches record from the categories tables
	  	return 	$data;

	}  

   function saveAddress($params){
			$insert = array(
						"address"=>$params['address'],
						"other_info"=>$params['other_info'],
						"latitude"=>$params['latitude'],
						"longitude"=>$params['longitude']
					);

			$this->db->where('id', $params['id']);
			$sql = $this->db->update('users', $insert);
	  		return 	$sql;

	} 


	function getAllProducts(){
		$this->db->select('id, store_id, category_id, arabic_name, english_name,CONCAT(" '.base_url().'uploads/products/",image) as image,
		 description, price, color, is_active, create_date');
		$this->db->where('is_active', '1');
		$sql = $this->db->get('products');
		$data=$sql->result_array();    // fetches record from the products tables
	  	return 	$data;

	}

	function getAllStores(){
		
		$this->db->select('id,admin_id,store_name,contact_name,address,CONCAT("'.base_url().'uploads/stores/",image) as image,
			phone_number,description,latitude,longitude,create_date');
		//$this->db->where('is_active', '1');
		$sql = $this->db->get('stores');
		$data=$sql->result_array();    // fetches record from the stores tables
	  	return 	$data;

	}

	function getProductsByCategory($category_id,$language){
		/*if($language == 'arabic'){
			$this->db->select('id,store_id,category_id,arabic_name,CONCAT("'.base_url().'uploads/products/",image) as image,
				description,price,size,color,flavor,is_active,create_date');
		}else{
			$this->db->select('id,store_id,category_id,english_name,CONCAT("'.base_url().'uploads/products/",image) as image,
				description,price,size,color,flavor,is_active,create_date');
		}
		$this->db->where(array('is_active'=>'1', 'category_id'=>$category_id));
		$sql = $this->db->get('products');
		$data=$sql->result_array();    // fetches record from the stores tables
	  	return 	$data;*/

	  	if($language == 'arabic'){
			$this->db->select('p.id,p.store_id,p.category_id,p.arabic_name,CONCAT("'.base_url().'uploads/products/",p.image) as image,
				p.description,p.price,s.size,p.color,f.flavor,p.is_active,p.create_date');
		}else{
			$this->db->select('p.id,p.store_id,p.category_id,p.english_name,CONCAT("'.base_url().'uploads/products/",p.image) as image,
				p.description,p.price,s.size,p.color,f.flavor,p.is_active,p.create_date');
		}
		$this->db->join('sizes s', 's.id = p.size_id','left');
		$this->db->join('flavors f', 'f.id = p.flavor_id','left');
		$this->db->where(array('p.is_active'=>'1', 'p.category_id'=>$category_id));
		$sql = $this->db->get('products p');
		$data=$sql->result_array();    // fetches record from the stores tables
	  	return 	$data;

	}

	function ProductDetailsById($product_id,$language){
		if($language == 'arabic'){
			$this->db->select('p.id,p.store_id,p.category_id,p.arabic_name,CONCAT("'.base_url().'uploads/products/",p.image) as image,
				p.description,p.price,s.size,p.color,f.flavor,p.is_active,p.create_date');
		}else{
			$this->db->select('p.id,p.store_id,p.category_id,p.english_name,CONCAT("'.base_url().'uploads/products/",p.image) as image,
				p.description,p.price,s.size,p.color,f.flavor,p.is_active,p.create_date');
		}
		$this->db->join('sizes s', 's.id = p.size_id','left');
		$this->db->join('flavors f', 'f.id = p.flavor_id','left');
		$this->db->where(array('p.is_active'=>'1', 'p.id'=>$product_id));
		$sql = $this->db->get('products p');
		$data=$sql->row_array();    // fetches record from the stores tables
	  	return 	$data;

	}

	public function getProductPrice($product_id){
		$this->db->select('id,price');
		$this->db->where('is_active', '1');
		$this->db->where('id',$product_id);
		$sql = $this->db->get('products');
		$data=$sql->row_array();    // fetches record from the stores tables
	  	return 	$data;

	}

	public function placeOrder($data){	
		$this->db->insert('orders', $data);	// insert data into `users` table
		return $id = $this->db->insert_id();	

	}

	public function getSizesById(){
		$this->db->select('id,size');
		$sql = $this->db->get('sizes');
		$data=$sql->result_array();    // fetches record from the stores tables
	  	return 	$data;

	}

	public function getFlavorsById(){
		$this->db->select('id,flavor');
		$sql = $this->db->get('flavors');
		$data=$sql->result_array();    // fetches record from the stores tables
	  	return 	$data;

	}

	function search($search=''){
		if($search != ''){
			$this->db->select('id, store_id, category_id, arabic_name, english_name,CONCAT(" '.base_url().'uploads/products/",image) as image,
			 description, price, color, is_active, create_date');
			$this->db->like('english_name', $search);
			$this->db->or_like('arabic_name', $search);
			$this->db->where('is_active', '1');
			$sql = $this->db->get('products');
			$data=$sql->result_array();    // fetches record from the products tables
		  	return 	$data;
		}else{
			$this->db->select('id, store_id, category_id, arabic_name, english_name,CONCAT(" '.base_url().'uploads/products/",image) as image,
			 description, price, color, is_active, create_date');
			$this->db->where('is_active', '1');
			$sql = $this->db->get('products');
			$data=$sql->result_array();    // fetches record from the products tables
		  	return 	$data;
		}

	}

	function myOrders($user_id,$language){
		if($language == 'arabic'){
			$this->db->select('o.id as orderId,o.order_number,o.user_id,o.product_id,o.quantity,o.product_price,o.price_per_quantity,
				p.arabic_name as productName,CONCAT("'.base_url().'uploads/products/",p.image) as image,
				p.description,p.price,s.size,p.color,f.flavor,order_status,p.is_active,DATE(o.create_date) AS OrderDate');
		}else{
			$this->db->select('o.id as orderId,o.order_number,o.user_id,o.product_id,o.quantity,o.product_price,o.price_per_quantity,
				p.english_name as productName,CONCAT("'.base_url().'uploads/products/",p.image) as image,
				p.description,p.price,s.size,p.color,order_status,f.flavor,p.is_active,DATE(o.create_date) AS OrderDate');
		}
		$this->db->join('products p', 'p.id = o.product_id','left');
		$this->db->join('sizes s', 's.id = p.size_id','left');
		$this->db->join('flavors f', 'f.id = p.flavor_id','left');
		//$this->db->where(array('p.is_active'=>'1', 'o.user_id'=>$user_id));
		$where = "p.is_active='1' AND o.user_id='".$user_id."' AND o.order_status !='cancelled'";
		$this->db->where($where);
		$this->db->order_by('orderId', 'DESC');
		$this->db->group_by('o.order_number');
		$sql = $this->db->get('orders o');
		$data=$sql->result_array();    // fetches record from the stores tables
	  	return 	$data;

	}

	function updateOrder($orderId,$data){
		return $this->db->update('orders', $data, array('id' => $orderId));
	}

	function editProfile($user_id,$language,$data){
		if($language == 'arabic'){
			return $this->db->update('users', $data, array('id' => $user_id));
		}else{
			return $this->db->update('users', $data, array('id' => $user_id));
		}
	}

	function changeLocation($user_id,$data){
		return $this->db->update('users', $data, array('id' => $user_id));
	}

	function getOrderById($orderId){
		$sql = $this->db->get_where('orders',array('id'=>$orderId));
		$data=$sql->row_array();    // fetches record from the stores tables
	  	return 	$data;

	}

	function orderDetails($order_number){
		$this->db->select('o.id,o.order_number,o.user_id,o.product_id,p.arabic_name,p.english_name,o.quantity,o.product_price,
			CONCAT("'.base_url().'uploads/products/",p.image) as image,
			o.price_per_quantity,o.size,o.flavor,o.order_status,DATE(o.create_date) as OrderDate');
		$this->db->join('products p', 'p.id = o.product_id','left');
		$this->db->where('o.order_number',$order_number);
		$sql = $this->db->get('orders o');
		$data=$sql->result_array();    // fetches record from the stores tables
	  	return 	$data;

	}

	function checkUser($user_email){
		 $sql = $this->db->get_where("users",array("email"=>$user_email));
		 $res = $sql->row_array();
		 return $res;
   }

   function changePassword($user_id,$data){
		return $this->db->update('users', $data, array('id' => $user_id));
	}




   
}

?>