<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin==false){
			redirect(base_url()."admin/Products/");
			exit();
		}
		$this->load->model('Adminmodel');
		$this->load->model('Storesmodel');
		$this->load->model('Productsmodel');
		//$this->load->helper('my_helper');
	}

	public function index(){
		//echo 'hello Sub-admins';exit;
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin==false){
			redirect(base_url()."admin/Index/login");
			exit();
		}

		$allStores = $this->Storesmodel->getAllStores();
		//echo '<pre>';print_r($allStores);exit;
		$assignData = array('pageName'=>'stores','stores'=>$allStores);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/stores',$assignData);
		$this->load->view('admin/footer');
			
	}

	public function getProductsByStore($store_id){
		$getProductsByStore = $this->Productsmodel->getProductsByStore($store_id);
		//echo '<pre>';print_r($allStores);exit;
		$assignData = array('pageName'=>'stores','storeproducts'=>$getProductsByStore);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/storeproducts',$assignData);
		$this->load->view('admin/footer');

	}

	public function deleteProductsByStore($product_id,$store_id){
		$this->Productsmodel->deleteProductsByStore($product_id);
		redirect(base_url()."admin/Products/getProductsByStore/".$store_id);
		exit();
	}
	

	public function deleteAllProductsByStore($store_id){
		$this->Productsmodel->deleteAllProductsByStore($store_id);
		redirect(base_url()."admin/Stores/index/");
		exit();
	}

	
	public function delete(){	
		$id=$this->input->get_post('id');
		if($id > 0){
			  $this->adminModel->deleteUser($id);
		}
			redirect(base_url().'index.php/admin/users/');
	}


	public function addProduct(){
		$allStores = $this->Storesmodel->getAllStores();
		$allCategories = $this->Productsmodel->getAllCategories();
		//echo '<pre>';print_r($allCategories);exit;
		$assignData = array('pageName'=>'stores','stores'=>$allStores,'categories'=>$allCategories);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/addproduct',$assignData);
		$this->load->view('admin/footer');
	}

	public function addNewProduct(){
		//echo 'Add Product';exit();
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		$store = $this->input->post('store');
		$category = $this->input->post('category');
		$name = $this->input->post('name');
		$desc = $this->input->post('desc');
		$image = $this->input->post('image');
		//$size = $this->input->post_get('size');
		//$color = $this->input->post_get('color');
		//$other = $this->input->post_get('other');
		$price = $this->input->post_get('price');
		$date = date('Y-m-d H:i:s');

		$imgName = time();
		$imgPath = BASEPATH."../uploads/products/".$imgName;
		$image = base_url().'uploads/products/'.$imgName;
		if(move_uploaded_file($_FILES["image"]["tmp_name"],$imgPath.".jpg")){
			 $this->load->library('Imagethumb');
			 $this->imagethumb->image($imgPath.".jpg",50,50);
			 $imageNew =$imgName."_thumb.jpg";
		}

		 $data = array(
					'admin_id'=>$userAdmin,
					'store_id'=>$store,
					'category_id'=>$category,
					'arabic_name'=>'0',
					'english_name'=>$name,
					'image'=>$imageNew,
					/*'image'=>'default.jpg',*/
					'description'=>$desc,
					'price'=>$price,
					'size_id'=>'0',
					'color'=>'0',
					'flavor_id'=>'0',
					'is_Active'=>'1',
					'create_date'=>$date
				);
				
		$this->Productsmodel->addProduct($data);
		redirect(base_url().'admin/Products/getProductsByStore/'.$store);

	}

	public function productDetailsByStore($product_id){
		$ProductDetails = $this->Productsmodel->productDetailsByStore($product_id);
		$ProductDetails['Size'] = $this->Productsmodel->getSizesById($product_id);
		$ProductDetails['Flavor'] = $this->Productsmodel->getFlavorsById($product_id);
		//echo '<pre>';print_r($ProductDetails);exit;
		$assignData = array('pageName'=>'stores','ProductDetails'=>$ProductDetails);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/productdetails',$assignData);
		$this->load->view('admin/footer');
	}

	public function editProduct($product_id){
		$allStores = $this->Storesmodel->getAllStores();
		$allCategories = $this->Productsmodel->getAllCategories();
		$ProductDetails = $this->Productsmodel->productDetailsByStore($product_id);
		//echo '<pre>';print_r($ProductDetails);exit;
		$assignData = array('pageName'=>'stores','ProductDetails'=>$ProductDetails,'stores'=>$allStores,'categories'=>$allCategories);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/editproduct',$assignData);
		$this->load->view('admin/footer');
	}

	public function updateProduct($product_id){
		//echo 'Add Product';exit();
		$store = $this->input->post('store');
		$name = $this->input->post('name');
		$category = $this->input->post('category');
		$desc = $this->input->post('desc');
		//$image = $this->input->post('image');
		$size = $this->input->post_get('size');
		$color = $this->input->post_get('color');
		$other = $this->input->post_get('other');
		$price = $this->input->post_get('price');
		$data = array();

		/*$imgName = time();
		$imgPath = BASEPATH."../uploads/products/".$imgName;
		$image = base_url().'uploads/products/'.$imgName;
		if(move_uploaded_file($_FILES["image"]["tmp_name"],$imgPath.".jpg")){
			 $this->load->library('Imagethumb');
			 $this->imagethumb->image($imgPath.".jpg",50,50);
			 $imageNew =$imgName."_thumb.jpg";
		}*/

		if(isset($_FILES['image'])){
			 $imgName = time();
			 $imgPath = BASEPATH."../uploads/products/".$imgName;
			 $image = base_url().'uploads/products/'.$imgName;
			 move_uploaded_file($_FILES["image"]["tmp_name"],$imgPath.".jpg");
			 $this->load->library('Imagethumb');
			 $this->imagethumb->image($imgPath.".jpg",200,200);
			 $imageNew =$imgName."_thumb.jpg";
			 $data['image'] = $imageNew;
         }


		$data['store_id'] = $store;
		$data['category_id'] = $category;
		$data['arabic_name'] = '0';
		$data['english_name'] = $name;
		//$data['image'] = $imageNew;
		/*'image'=>'default.jpg',*/
		$data['description'] = $desc;
		$data['price'] = $price;
		$data['size_id'] = $size;
		$data['color'] = $color;
		$data['flavor_id'] = $other;
				
		//echo '<pre>';print_r($data);exit;
		$this->Productsmodel->updateProduct($data,$product_id);
		redirect(base_url().'admin/Products/productDetailsByStore/'.$product_id);

	}

	public function flavors($product_id){
		$ProductDetails = $this->Productsmodel->productDetailsByStore($product_id);
		$assignData = array('pageName'=>'stores','product_id'=>$product_id,'stores'=>$ProductDetails);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/addflavors',$assignData);
		$this->load->view('admin/footer');
	}

	public function addFlavor(){
		//echo 'Add Product';exit();
		$product_id = $this->input->post('product_id');
		$store_id = $this->input->post('store_id');
		$flavor = $this->input->post('flavor');
		$date = date('Y-m-d H:i:s');

		$flavors = explode(",",$flavor);

		foreach($flavors as $flavor_id){

			$flavorName = $flavor_id;
			//echo '<pre>';print_r($flavorName);exit;
			 $data = array(
						'product_id'=>$product_id,
						'flavor'=>$flavorName,
						'create_date'=>$date
					);
					
			//echo '<pre>';print_r($data);
			$this->Productsmodel->addFlavors($data);
		}
		redirect(base_url().'admin/Products/getProductsByStore/'.$store_id);

	}

	public function weight($product_id){
		$ProductDetails = $this->Productsmodel->productDetailsByStore($product_id);
		$assignData = array('pageName'=>'stores','product_id'=>$product_id,'stores'=>$ProductDetails);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/addweights',$assignData);
		$this->load->view('admin/footer');
	}

	public function addWeight(){
		//echo 'Add Product';exit();
		$product_id = $this->input->post('product_id');
		$store_id = $this->input->post('store_id');
		$size = $this->input->post('weight');
		$date = date('Y-m-d H:i:s');

		$sizes = explode(",",$size);

		foreach($sizes as $size_id){

			$sizeName = $size_id;
			//echo '<pre>';print_r($flavorName);exit;
			 $data = array(
						'product_id'=>$product_id,
						'size'=>$sizeName,
						'create_date'=>$date
					);
					
			//echo '<pre>';print_r($data);
			$this->Productsmodel->addWeights($data);
		}
		redirect(base_url().'admin/Products/getProductsByStore/'.$store_id);
	//	}

	}


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */