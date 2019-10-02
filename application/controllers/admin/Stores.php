<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stores extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin==false){
			redirect(base_url()."admin/Stores/");
			exit();
		}
		$this->load->model('Adminmodel');
		$this->load->model('Storesmodel');
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

	public function addStore(){
		$assignData = array('pageName'=>'stores');
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/addstore',$assignData);
		$this->load->view('admin/footer');
	}

	public function addNewStore(){
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		$storename = $this->input->post('storename');
		$contactname = $this->input->post('contactname');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$desc = $this->input->post('desc');
		$image = $this->input->post('image');
		$mapLat = $this->input->post_get('mapLat');
		$mapLong = $this->input->post_get('mapLong');
		$date = date('Y-m-d H:i:s');

		$imgName = time();
		$imgPath = BASEPATH."../uploads/stores/".$imgName;
		$image = base_url().'uploads/stores/'.$imgName;
		if(move_uploaded_file($_FILES["image"]["tmp_name"],$imgPath.".jpg")){
			 $this->load->library('Imagethumb');
			 $this->imagethumb->image($imgPath.".jpg",50,50);
			 $imageNew =$imgName."_thumb.jpg";
		}

		if($mapLat =='' && $mapLong ==''){
	        // Get lat long from google
	        $latlong    =   $this->get_lat_long($address); // create a function with the name "get_lat_long" given as below
	        $map        =   explode(',' ,$latlong);
	        $mapLat     =   $map[0];
	        $mapLong    =   $map[1];    
		}


		 $data = array(
					'admin_id'=>$userAdmin,
					'store_name'=>$storename,
					'contact_name'=>$contactname,
					'address'=>$address,
					'image'=>$imageNew,
					/*'image'=>'default.jpg',*/
					'phone_number'=>$phone,
					'description'=>$desc,
					'latitude'=>$mapLat,
					'longitude'=>$mapLong,
					'create_date'=>$date
				);
				
		//echo '<pre>';print_r($data);exit;
		$this->Storesmodel->addStore($data);
		redirect(base_url().'admin/Stores/index');
	//	}

	}

	function get_lat_long($address){

	    $address = str_replace(" ", "+", $address);

	    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
	    $json = json_decode($json);

	    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
	    return $lat.','.$long;
	}

	public function deleteStoreById($store_id){
		$this->Storesmodel->deleteStoreById($store_id);
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

	public function storeDetailsById($store_id){
		$storeDetails = $this->Storesmodel->detailsByStoreId($store_id);
		//echo '<pre>';print_r($ProductDetails);exit;
		$assignData = array('pageName'=>'stores','storeDetails'=>$storeDetails);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/storedetails',$assignData);
		$this->load->view('admin/footer');
	}

	public function storeEdit($store_id){
		$storeDetails = $this->Storesmodel->detailsByStoreId($store_id);
		//echo '<pre>';print_r($storeDetails);exit;
		$assignData = array('pageName'=>'stores','storeDetails'=>$storeDetails,'store_id'=>$store_id);
		$this->load->view('admin/header',$assignData);
		$this->load->view('admin/editstore',$assignData);
		$this->load->view('admin/footer');
	}

	public function storeUpdate($store_id){
		$storename = $this->input->post('storename');
		$contactname = $this->input->post('contactname');
		$address = $this->input->post('address');
		$phone = $this->input->post('phone');
		$desc = $this->input->post('desc');
		//$image = $this->input->post('image');
		$mapLat = $this->input->post_get('mapLat');
		$mapLong = $this->input->post_get('mapLong');

		$data = array();

		/*$imgName = time();
		$imgPath = BASEPATH."../uploads/stores/".$imgName;
		$image = base_url().'uploads/stores/'.$imgName;
		if(move_uploaded_file($_FILES["image"]["tmp_name"],$imgPath.".jpg")){
			 $this->load->library('Imagethumb');
			 $this->imagethumb->image($imgPath.".jpg",50,50);
			 $imageNew =$imgName."_thumb.jpg";
			 $data['image'] = $imageNew;
		}*/

		if(isset($_FILES['image'])){
			 $imgName = time();
			 $imgPath = BASEPATH."../uploads/stores/".$imgName;
			 $image = base_url().'uploads/stores/'.$imgName;
			 move_uploaded_file($_FILES["image"]["tmp_name"],$imgPath.".jpg");
			 $this->load->library('Imagethumb');
			 $this->imagethumb->image($imgPath.".jpg",200,200);
			 $imageNew =$imgName."_thumb.jpg";
			 $data['image'] = $imageNew;
         }

		if($mapLat =='' && $mapLong ==''){
	        // Get lat long from google
	        $latlong    =   $this->get_lat_long($address); // create a function with the name "get_lat_long" given as below
	        $map        =   explode(',' ,$latlong);
	        $mapLat     =   $map[0];
	        $mapLong    =   $map[1];    
		}

		 $data['store_name'] = $storename;
		 $data['contact_name'] = $contactname;
		 $data['address'] = $address;
		 $data['phone_number'] = $phone;
		 $data['description'] = $desc;
		 //$data['image'] = $imageNew;
		 $data['latitude'] = $mapLat;
		 $data['longitude'] = $mapLong;
				
		//echo '<pre>';print_r($data);exit;
		$this->Storesmodel->updateStore($data,$store_id);
		redirect(base_url()."admin/Stores/storeDetailsById/".$store_id);

	}
	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */