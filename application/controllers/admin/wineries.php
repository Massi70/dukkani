<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class wineries extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$userAdmin=$this->session->userdata(APP_NAME.'_admin');
		if($userAdmin==false){
			redirect(base_url()."admin/index/login");
			exit();
		}
		$this->load->model('userModel');
		$this->load->model('adminModel');
		$this->load->helper('my_helper');
	}

	public function index(){
		$ajax=$this->input->get('ajax');
		$page=$this->input->get('page');
		$key=$this->input->post('key');
		$appType = '';
		$limit='50';
		$page=($page==false) ? 1 : $page; 
		
		$offSet=($page>1) ? ($page-1)*$limit : 0;
		$this->load->helper('pagination_helper');
		$pagination=Pagination_helper::getInstance();
		if($key!=false){
			$AllWineries=$this->adminModel->countAllWineries($key);
			$data=$this->adminModel->wineList1($key,$offSet,$limit);
			//echo '<pre>';print_r($data);exit;
		}else{
			$appType = $this->input->get_post('type_id');
			$AllWineries=$this->adminModel->countAllWineries();
			$data=$this->adminModel->wineList($appType,$offSet,$limit);
		}
		$paging=$pagination->create($page ,base_url().'admin/wineries/?type_id='.$appType.'' , $AllWineries ,'main_div' ,base_url().'images/admin/spinner_small.gif','paging_spinner',$limit);
		$assignData=array('pageName'=>'wineries','data'=>$data,'appType'=>$appType,'AllWineries'=>$AllWineries,'paging'=>$paging['html'],'search'=>$key,'offSet'=>$offSet);
		if($ajax!=1){
			$this->load->view('admin/header',$assignData);
		}
			$this->load->view('admin/wineries',$assignData);
		if($ajax!=1){
			$this->load->view('admin/footer');
		}
	}
	
	public function addWine(){
		if(count($_POST)>0){
			$appType = $this->input->get_post('estate');
			$association = $this->input->get_post('association_id');
			$name=$this->input->get_post('name');
			$email=$this->input->get_post('user_email');
			$password=$this->input->get_post('password');
			$file=$this->input->get_post('file');
			$country =$this->input->get_post('country');
			$province =$this->input->get_post('province');
			$address =$this->input->get_post('address');
			$food_open = $this->input->get_post('food_open');
			$food_close = $this->input->get_post('food_close');
			$contact = $this->input->get_post('contact');
			$link = $this->input->get_post('link');
			$description = $this->input->get_post('description');
			$notes = $this->input->get_post('notes');
			$latlong = $this->input->get_post('txt_latlng');
			$current = time();
			$date = date("Y-m-d H:i:s", $current);

			 $imgName = time();
			 $imgPath = BASEPATH."../uploads/".$imgName;
			 $image = base_url().'uploads/'.$imgName;
			 move_uploaded_file($_FILES["file"]["tmp_name"],$imgPath.".jpg");
			 $this->load->library('imagethumb');
			 $this->imagethumb->image($imgPath.".jpg",50,150);
			 $imageNew =$imgName."_thumb.jpg";
			 
			 $array = array();
			 $latlong1 = explode(",", $latlong);
			 $latitude = $latlong1[0];
			 $longitude = $latlong1[1];
			
				$data = array(
					'user_type_id'=>'2',
					'app_type_id'=>$appType,
					'user_name'=>$name,
					'user_email'=>$email,
					'password'=>base64_encode($password),
					'image'=>$imageNew,
					'association_id'=>$association,
					'country'=>$country,
					'province'=>$province,
					'address'=>$address,
					'contact'=>$contact,
					'link'=>$link,
					'description'=>$description,
					'notes'=>$notes,
					'latitude'=>$latitude,
					'longitude'=>$longitude,
					'food_open_time'=>$food_open,
					'food_close_time'=>$food_close,
					'create_time'=>$date
				);
				$wineryId=$this->adminModel->addWine($data);
	
					$totalImages = count($_FILES["item_file"]['tmp_name']);
					$images1 = ($_FILES["item_file"]['tmp_name']);
					for($j=0; $j<$totalImages; $j++) { 
						if($images1[$j] != ''){
							$filen = time().'_'.$j.".jpg"; 
							$path = BASEPATH.'../uploads/events/'.$filen; 
							$image = base_url().'uploads/events/'.$filen;
							$images =$filen;
							move_uploaded_file($_FILES["item_file"]['tmp_name']["$j"],$path);
							$data1 = array(
								'winery_id'=>$wineryId,
								'image'=>$images
							);
							$this->adminModel->addWineryImages($data1);
						}else{
						}
					}
					$assignData=array('pageName'=>'wineries','data'=>$data,'data1'=>$data1);
					if($appType == 1){
						ob_start(); //Turn on output buffering ?>
						Thank You! You have Successfully created the Account....
				<?php
					$var = ob_get_clean();
					$this->load->library('email');
					$this->email->from('no-reply@britishwinery.com', 'British Columbia Winery');
					$this->email->to($email);
					$this->email->subject('Hey ! you have Got Mail from British Columbia Winery');
					$this->email->message($var);
					$this->email->send();
					$this->email->print_debugger();
					redirect(base_url().'admin/wineries/?type_id=1');
				}else{
					ob_start(); //Turn on output buffering ?>
					Thank You! You have Successfully created the Account....
				<?php
					$var = ob_get_clean();
					$this->load->library('email');
					$this->email->from('no-reply@ontariowinery.com', 'Ontario Winery');
					$this->email->to($email);
					$this->email->subject('Hey ! you have Got Mail from Ontario Columbia Winery');
					$this->email->message($var);
					$this->email->send();
					$this->email->print_debugger();
					redirect(base_url().'admin/wineries/?type_id=2');
				}
		}else{
				$page=$this->input->get('page');
				$limit='10';
				$offSet=($page>1) ? ($page-1)*$limit : 0;
				$association = $this->adminModel->getAssociation1();	
				$assignData = array('pageName'=>'wineries','association'=>$association);
				$this->load->view('admin/header',$assignData);
				$this->load->view('admin/addwine',$assignData);
				$this->load->view('admin/footer');
			}
	}
	
	public function view(){
			$id=$this->input->get_post('id');
			$data = $this->adminModel->getWineDetails($id);
			$data1 = $this->adminModel->getWineEventImages($id);
			$assignData=array('pageName'=>'wineries','data'=>$data,'data1'=>$data1);
			$this->load->view('admin/header',$assignData);
			$this->load->view('admin/wineriesview',$assignData);
			$this->load->view('admin/footer');
	}
	
	public function edit(){
			$id=$this->input->get_post('id');
			$data = $this->adminModel->getWineDetails($id);
			//$assignData=array('pageName'=>'wineries','data'=>$data);
			$page=$this->input->get('page');
			$limit='10';
			$offSet=($page>1) ? ($page-1)*$limit : 0;
			$association = $this->adminModel->getAssociation1($offSet,$limit);	
			$assignData = array('pageName'=>'wineries','data'=>$data,'association'=>$association);	
			$this->load->view('admin/header',$assignData);
			$this->load->view('admin/wineriesedit',$assignData);
			$this->load->view('admin/footer');
	}
		
	public function update(){
			$winery_id=$this->input->get_post('winery_id');
			$association = $this->input->get_post('association_id');
			$name = $this->input->get_post('name');
			$password = $this->input->get_post('password');
			$user_email = $this->input->get_post('user_email');
			$country = $this->input->post('country');
			$province = $this->input->post('province');
			$food_open_time = $this->input->post('food_open_time');
			$food_close_time = $this->input->post('food_close_time');
			$address = $this->input->post('address');
			$contact = $this->input->post('contact');
			$link = $this->input->post('link');
			$description = $this->input->post('description');
			$notes = $this->input->post('notes');
			$latlong = $this->input->get_post('txt_latlng');
			 
			 $array = array();
			 $lat_long = explode(",", $latlong);
			 $latitude = $lat_long[0];
			 $longitude = $lat_long[1];

        $data = array(
				  "id"=>$winery_id,
				  'association_id'=>$association,
                  "user_name" => $name,
				  "password" => base64_encode($password),
				  "user_email"=>$user_email,
                  "country" => $country,
                  "province" => $province,
				  "address" => $address,
				  "food_open_time" => $food_open_time,
				  "food_close_time"=>$food_close_time,
				  "contact" => $contact,
				  "link" => $link,
				  "description" => $description,
				  "notes" => $notes,
				  "longitude" => $longitude,
				  "latitude" => $latitude
                 );
			$data = $this->adminModel->updateWine($data,$winery_id);
			$assignData=array('pageName'=>'wineries','data'=>$data);
			$this->load->view('admin/header',$assignData);
			$this->load->view('admin/wineriesview',$assignData);
			$this->load->view('admin/footer');
			redirect(base_url().'admin/wineries/view/?id='.$winery_id);

    }
	
	public function delete(){	
		$id=$this->input->get_post('id');
		if($id > 0){
			  $this->adminModel->deleteWine($id);
			  $this->adminModel->deleteEventByWineryId($id);
			  $this->adminModel->deleteEventImagesByWineryId($id);
		}
			redirect(base_url().'admin/wineries/?type_id=all');
	}
	
	public function editImage(){
			$id=$this->input->get_post('id');
			$data = $this->adminModel->getWineDetails($id);
			$assignData=array('pageName'=>'wineries','data'=>$data);
			$this->load->view('admin/header',$assignData);
			$this->load->view('admin/wineriesimage',$assignData);
			$this->load->view('admin/footer');
	}
	
	public function editPicture(){
		  $id = $this->input->get_post('id');
		  $assignData=array('pageName'=>'wineriesview');
		  $imgName = time();
		  $imgPath = BASEPATH."../uploads/".$imgName;
		  $image = base_url().'uploads/'.$imgName;
				
		  if(move_uploaded_file($_FILES["file"]["tmp_name"],$imgPath.".jpg")){
			  $this->load->library('imagethumb');
			  $this->imagethumb->image($imgPath.".jpg",200,200);
			  $userData['image']=$imgName."_thumb.jpg";
			  $view =$imgName."_thumb.jpg";
						//'image_path'=>$image."_thumb.jpg",

			  $this->adminModel->updateWineriesImage($view,$id);
			  redirect(base_url().'admin/wineries/view/?id='.$id);

		  }
	}
	
	public function checkUsers($user_email){
		$checkUser = $this->adminModel->checkUserEmail($user_email);
		echo $checkUser;
	}
	
	/*public function editMultipleImages(){
			$id=$this->input->get_post('id');
			$data = $this->adminModel->getMultipleImages($id);
			$assignData=array('pageName'=>'wineries','data'=>$data);
			$this->load->view('admin/header',$assignData);
			$this->load->view('admin/wineriesmultiimage',$assignData);
			$this->load->view('admin/footer');
	}*/
	
	public function deleteEventMultiImages(){	
	 	$user_id = $this->input->get_post('user_id');
		$id = $this->input->get_post('id');
		if($id > 0){
			  $this->adminModel->deleteEventMultiImages($id);
		}
			redirect(base_url().'admin/wineries/view/?id='.$user_id);
	}
	
	/*public function updateMultiPicture(){
		  $id=$this->input->get_post('winery_image_id');
		  $winery_id=$this->input->get_post('winery_id');
		  $assignData=array('pageName'=>'wineriesview');
		  $imgName = time();
		  $imgPath = BASEPATH."../uploads/".$imgName;
		  $image = base_url().'uploads/'.$imgName;
		  $j=0;	
		  $images = ($_FILES["file"]['tmp_name']);
		  $filen = time().'_'.$j.".jpg"; 
		  $path = BASEPATH.'../uploads/events/'.$filen; 
		  $image = base_url().'uploads/events/'.$filen;
		  $images = $filen;
		  move_uploaded_file($_FILES["file"]['tmp_name'],$path);
		  $data1 = array(
				'image'=>$images
			);
			$res = $this->adminModel->updateWineriesMultiImage($data1,$id);
			redirect(base_url().'admin/wineries/view/?id='.$winery_id);
		}*/
		
	public function addMultiPleImages(){
		if(count($_POST)>0){
			$wineryId=$this->input->get_post('id');
			$new_id=$this->input->get_post('new_id');
			$datas = $this->adminModel->getWineDetails($wineryId);
			$assignData=array('pageName'=>'wineries','datas'=>$datas,'wineryId'=>$wineryId);
			$totalImages = count($_FILES["item_file"]['tmp_name']);
			$images1 = ($_FILES["item_file"]['tmp_name']);
			for($j=0; $j<$totalImages; $j++) { 
				if($images1[$j] != ''){
					$filen = time().'_'.$j.".jpg"; 
					$path = BASEPATH.'../uploads/events/'.$filen; 
					$image = base_url().'uploads/events/'.$filen;
					$images =$filen;
					move_uploaded_file($_FILES["item_file"]['tmp_name']["$j"],$path);
					$data1 = array(
								'winery_id'=>$new_id,
								'image'=>$images
							);
					$this->adminModel->addWineryImages($data1);
				}else{
				}
			}
				redirect(base_url().'admin/wineries/view/?id='.$new_id);
		}else{
			$wineryId=$this->input->get_post('id');
			$datas = $this->adminModel->getWineDetails($wineryId);
			$assignData=array('pageName'=>'wineries','datas'=>$datas,'wineryId'=>$wineryId);
			$this->load->view('admin/header',$assignData);
			$this->load->view('admin/addmultipleimages',$assignData);
			$this->load->view('admin/footer');
		}
		
	}
	
	public function changeTimeStatus($id,$status){
		$this->adminModel->changeTimeStatus($id,$status);
		$data = $this->adminModel->getWineDetails($id);
		$data1 = $this->adminModel->getWineEventImages($id);
	}

}


/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
?>