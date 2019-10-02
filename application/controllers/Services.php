<?php 
//defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Services extends CI_Controller {

	public $_uId;
	public $_userData;
	public $_assignData;
	public $_checkUser;
	
	public function __construct(){
        parent::__construct();
		$this->load->model('Usermodel');
		header('Content-Type: text/html; charset=utf-8');
		//header('Content-Type: text/html; charset=utf-8');
		//header('Content-type: application/json');
   }
	
	private $_headerData = array();
	private $_navData = array();
	private $_footerData = array();
	private $_jsonData = array();
	private $_finalData = array();
		
		/*************************** sign up code starts ***************************/



	public function englishToArabic($number_en) {
	$number_ar = "";
	$_en = array('0','1', '2', '3', '4', '5', '6', '7', '8', '9','.','-',' ',':');
	//$_arabic = array('&#x0660','&#x0661', '&#x0662', '&#x0663', '&#x0664', '&#x0665', '&#x0666', '&#x0667', '&#x0668', '&#x0669','.');
	$_arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩','.','-',' ',':');
	for($i = 0, $maxI = strlen($number_en); $i< $maxI; $i++) {
	$v = substr($number_en, $i, 1);
	$idx = array_search($v, $_en);
		if($idx !== FALSE) {
			$number_ar .= $_arabic[$idx];
			}
		}
		return $number_ar;
	}


	
	public function register_en(){
		//echo 'controller calls Masroor';exit;
		//$fbId = $this->_uId;
		$fbId = $this->input->post_get('fb_id');
		$gmail_id = $this->input->post_get('gmail_id');
		//$twitterId = 219262506;
		$user_name = $this->input->post_get('user_name');
		$user_email = $this->input->post_get('user_email');
		$password = $this->input->post_get('password');
		$cpassword = $this->input->post_get('cpassword');
		$phone = $this->input->post_get('phone');
		$date = date("Y-m-d H:i:s");
	try{
		if($fbId != "" || $gmail_id != ""){
				
					if($fbId != "" ){
						$checkFbId = $this->Usermodel->checkFbId($fbId);
						if($checkFbId == 0){
							$data = array(
									'fb_id'=>$fbId,
									'gmail_id'=>0,
									'email'=>$user_email,
									'english_name'=>$user_name,
									'password'=>base64_encode($password),
									'phone'=>$phone,
									'create_date'=>$date
								);
							$res = $this->Usermodel->addFbUser($data);
							$data['id'] = $res;
				            $this->_jsonData['status']=1;
				            $this->_jsonData['message']="User data inserted Successfully";
				            $this->_jsonData['Appmessage']="App Fair usage 2 AED.";
				            $this->_jsonData['data']=$data; 
			            }else{
							$this->_jsonData['status']=0;
			           		$this->_jsonData['message']="User Already exists";
						}       
					}else{
						if($gmail_id != "" ){
							$checkGmailId = $this->Usermodel->checkGmailId($gmail_id);
							if($checkGmailId == 0){
								$data = array(
									'fb_id'=>0,
									'gmail_id'=>$gmail_id,
									'email'=>$user_email,
									'english_name'=>$user_name,
									'password'=>base64_encode($password),
									'phone'=>$phone,
									'create_date'=>$date
								);
								$res = $this->Usermodel->addGoogleUser($data);
								$data['id'] = $res;
					            $this->_jsonData['status']=1;
					            $this->_jsonData['message']="User data inserted Successfully";
					            $this->_jsonData['Appmessage']="2";
					            $this->_jsonData['data']=$data;
				            }else{
								$this->_jsonData['status']=0;
				           		$this->_jsonData['message']="User Already exists";
							}         
						}
					}

			}else{

				if($user_name == false || $user_name == ""){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="User Name Missing";
				}else if($user_email == false || $user_email == ""){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="User Email Missing";
				}else if($password == false || $password == ""){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="Password Missing";
				}else if($cpassword == false || $cpassword == ""){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="Confirm Password Missing";
				}else if($password != $cpassword ){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="Password do not Match";
				}else if($phone == false || $phone == "" ){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="phone number missing";
				}else{
						$checkUserEmail = $this->Usermodel->checkUserEmail($user_email);
						if($checkUserEmail == 0){
							$data = array(
									'fb_id'=>$fbId,
									'gmail_id'=>$gmail_id,
									'email'=>$user_email,
									'english_name'=>$user_name,
									'password'=>base64_encode($password),
									'phone'=>$phone,
									'create_date'=>$date
								);
							$res = $this->Usermodel->addUser($data);
							$data['id'] = $res;
							$this->_jsonData['status']=1;
							$this->_jsonData['message']="User Data Inserted Successfully";
							$this->_jsonData['Appmessage']="2";
							$this->_jsonData['data']=$data; 
						}else{
							$this->_jsonData['status']=0;
							$this->_jsonData['message']="User Email Already Exists";
						}
			  }
		}
		echo json_encode($this->_jsonData,JSON_UNESCAPED_UNICODE);
	}catch(Exception $e){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="Error Occured";
		}
		
	}

	public function register_ar(){
		//echo 'controller calls Masroor';exit;
		//$fbId = $this->_uId;
		$fbId = $this->input->post_get('fb_id');
		$gmail_id = $this->input->post_get('gmail_id');
		//$twitterId = 219262506;
		$user_name = $this->input->post_get('user_name');
		$user_email = $this->input->post_get('user_email');
		$password = $this->input->post_get('password');
		$cpassword = $this->input->post_get('cpassword');
		$phone = $this->input->post_get('phone');
		$date = date("Y-m-d H:i:s");
	try{
		if($fbId != "" || $gmail_id != ""){
				
					if($fbId != "" ){
						$checkFbId = $this->Usermodel->checkFbId($fbId);
						if($checkFbId == 0){
							$data = array(
									'fb_id'=>$fbId,
									'gmail_id'=>0,
									'email'=>$user_email,
									'english_name'=>$user_name,
									'password'=>base64_encode($password),
									'phone'=>$phone,
									'create_date'=>$date
								);
							$res = $this->Usermodel->addFbUser($data);
							$data['id'] = $res;
				            $this->_jsonData['status']=1;
				            $this->_jsonData['message']="User data inserted Successfully";
				            $this->_jsonData['Appmessage']="App Fair usage 2 AED.";
				            $this->_jsonData['data']=$data; 
			            }else{
							$this->_jsonData['status']=0;
			           		$this->_jsonData['message']="User Already exists";
						}       
					}else{
						if($gmail_id != "" ){
							$checkGmailId = $this->Usermodel->checkGmailId($gmail_id);
							if($checkGmailId == 0){
								$data = array(
									'fb_id'=>0,
									'gmail_id'=>$gmail_id,
									'email'=>$user_email,
									'english_name'=>$user_name,
									'password'=>base64_encode($password),
									'phone'=>$phone,
									'create_date'=>$date
								);
								$res = $this->Usermodel->addGoogleUser($data);
								$data['id'] = $res;
					            $this->_jsonData['status']=1;
					            $this->_jsonData['message']="User data inserted Successfully";
					            $this->_jsonData['Appmessage']="2";
					            $this->_jsonData['data']=$data;
				            }else{
								$this->_jsonData['status']=0;
				           		$this->_jsonData['message']="User Already exists";
							}         
						}
					}

			}else{

				if($user_name == false || $user_name == ""){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="User Name Missing";
				}else if($user_email == false || $user_email == ""){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="User Email Missing";
				}else if($password == false || $password == ""){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="Password Missing";
				}else if($cpassword == false || $cpassword == ""){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="Confirm Password Missing";
				}else if($password != $cpassword ){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="Password do not Match";
				}else if($phone == false || $phone == "" ){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="phone number missing";
				}else{
						$checkUserEmail = $this->Usermodel->checkUserEmail($user_email);
						if($checkUserEmail == 0){
							$data = array(
									'fb_id'=>$fbId,
									'gmail_id'=>$gmail_id,
									'email'=>$user_email,
									'english_name'=>$user_name,
									'password'=>base64_encode($password),
									'phone'=>$phone,
									'create_date'=>$date
								);
							$res = $this->Usermodel->addUser($data);
							$data['id'] = $res;
							$this->_jsonData['status']=1;
							$this->_jsonData['message']="User Data Inserted Successfully";
							$this->_jsonData['Appmessage']="2";
							$this->_jsonData['data']=$data; 
						}else{
							$this->_jsonData['status']=0;
							$this->_jsonData['message']="User Email Already Exists";
						}
			  }
		}
		echo json_encode($this->_jsonData,JSON_UNESCAPED_UNICODE);
	}catch(Exception $e){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="Error Occured";
		}
		
	}

	
	public function signin(){
		$user_email = $this->input->post_get('user_email');
		$password = $this->input->post_get('password');
		$fb_id = $this->input->post_get('fb_id');
		$gmail_id = $this->input->post_get('gmail_id');
		
		try{
	            
		        if($fb_id != "" || $gmail_id != ""){
				
					if($fb_id != "" ){
						$fbLogin = $this->Usermodel->fbLogin($fb_id);
						if(empty($fbLogin)){
			                 $this->_jsonData['status']=2;
			                 $this->_jsonData['message']="User not found";
			            }else{
			                 $this->_jsonData['status']=1;
			                 $this->_jsonData['message']="User Logged In Successfully";
			                 $this->_jsonData['Appmessage']="2";
			                 $this->_jsonData['data']=$fbLogin;
			            }
			                
					}
					
					if( $gmail_id != "" ){
						$gmailLogin = $this->Usermodel->gmailLogin($gmail_id);
						
						if(empty($gmailLogin)){
			                $this->_jsonData['status']=2;
			                $this->_jsonData['message']="User not found";
			            } else {
			                $this->_jsonData['status']=1;
			                $this->_jsonData['message']="User Logged In Successfully";
			                $this->_jsonData['Appmessage']="2";
			                $this->_jsonData['data']=$gmailLogin;
			            }
					}
		        }else if($user_email == false || $user_email == ""){
		                    $this->_jsonData['status']=0;
		                    $this->_jsonData['message']="User Email Missing";
					}else if($password == false || $password == ""){
		                    $this->_jsonData['status']=0;
		                	$this->_jsonData['message']="Password Missing";
					}else{
		                    $checkUser = $this->Usermodel->checklogin($user_email,base64_encode($password));
		                    if($checkUser != ""){
		                            $login = $this->Usermodel->login($user_email,base64_encode($password));
		                            $this->_jsonData['status']=1;
		                            $this->_jsonData['message']="User Logged In Successfully";
		                            $this->_jsonData['Appmessage']="2";
		                            $this->_jsonData['data']=$login; 
							}else{
		                            $this->_jsonData['status']=0;
		                            $this->_jsonData['message']="User Email or Password donot match";
							}
					}
				echo json_encode($this->_jsonData,JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="Error Occured";
					$this->_jsonData['data']='';
		}
		
	}


	public function getCategories(){
		$lang = $this->input->post_get('language');
		try{
			if($lang == false || $lang == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="language is Missing";
			}else{
				$data = $this->Usermodel->getCategories($lang);
				$this->_jsonData['status']=1;
				$this->_jsonData['message']="Categories List got Successfully";
				$this->_jsonData['data']=$data; 
			}

			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}
	}


	public function SaveAddress(){
		$user_id = $this->input->post_get('user_id');
		$sAddress = $this->input->post_get('street_address');
		$vAddress = $this->input->post_get('villa_address');
		$extrainfo = $this->input->post_get('extra_info');
        $lat = $this->input->post_get('latitude');
		$long = $this->input->post_get('longitude');
		try{
			if($user_id == false || $user_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="user_id is Missing";
			}else if($sAddress == false || $sAddress == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="Street Address is Missing";
			}else if($vAddress == false || $vAddress == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="Villa Address is Missing";
			}else if($extrainfo == false || $extrainfo == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="Extra Info is Missing";
			}else if($lat == false || $lat == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="latitude is Missing";
			}else if($long == false || $long == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="longitude is Missing";
			}else{
				$insert = array(
								"id"=>$user_id,
								"street_address"=>$sAddress,
								"villa_address"=>$vAddress,
								"other_info"=>$extrainfo,
                                "latitude"=>$lat,
								"longitude"=>$long
							);
				$data = $this->Usermodel->saveAddress($insert);
				$this->_jsonData['status']=1;
				$this->_jsonData['message']="Address Added Successfully";
				$this->_jsonData['data']=$insert; 
			}

			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}
	}

	public function getAllProducts(){
		$store_id = $this->input->post_get('store_id');
		try{
			if($store_id == false || $store_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="store_id is Missing";
			}else{
				$data = $this->Usermodel->getAllProducts($store_id);
				if(count($data) > 0){
					$this->_jsonData['status']=1;
					$this->_jsonData['message']="Products viewed Successfully";
					$this->_jsonData['data']=$data; 
				}else{
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="No Products Found";
				}
			}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}


	}


	public function getAllStores(){
		try{
				$data = $this->Usermodel->getAllStores();
				if(count($data) > 0){
					$this->_jsonData['status']=1;
					$this->_jsonData['message']="Stores viewed Successfully";
					$this->_jsonData['data']=$data; 
				}else{
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="No Stores Found";
				}
			echo json_encode($this->_jsonData);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}


	}

	public function getAllStoresDistance(){
		$lat = $this->input->post_get('lat');
		$long = $this->input->post_get('long');
		$distance = 7;
		$data_latlon = array();
		$data_latlon1 = array();
		try{
			$data = $this->Usermodel->getAllStores();
			//if(count($data) > 0){
			$i=0;
			foreach($data as $l){ 
				$get_distance = $this->distance($lat,$long,$l['latitude'],$l['longitude']);
				//echo '<pre>';print_r($get_distance);exit();
				if($get_distance<=$distance){
					//echo '<pre>';print_r($data_latlon[$i]);exit();
					$data_latlon[$i] = $data[$i];
					
				}
				$i++;
			}
			
			$p=0;
			foreach($data_latlon as $d){
					//echo '<pre>';print_r($data_latlon);exit();
				$data_latlon1[$p++] = $d;
			}

			//if(($data_latlon1) > 0){
				$this->_jsonData['status']=1;
				$this->_jsonData['message']="Stores viewed Successfully";
				$this->_jsonData['data']=$data_latlon1; 
			/*}else{
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="No Stores Found";
			}*/
			echo json_encode($this->_jsonData);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}


	}


	function distance($lat1, $lng1, $lat2, $lng2 , $miles = true){
		$pi80 = M_PI / 180;
		$lat1 *= $pi80;
		$lng1 *= $pi80;
		$lat2 *= $pi80;
		$lng2 *= $pi80;
		
		$r = 6372.797; // mean radius of Earth in km
		$dlat = $lat2 - $lat1;
		$dlng = $lng2 - $lng1;
		$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$km = $r * $c;
		
		return ($miles ? ($km * 0.621371192) : $km);
	}

	
	public function getProductByCategory(){
		$lang = $this->input->post_get('language');
		$cat_id = $this->input->post_get('cat_id');
		$store_id = $this->input->post_get('store_id');
		try{
			 if($lang == false || $lang == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="language is Missing";
			}else if($cat_id == false || $cat_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="cat_id is Missing";
			}else if($store_id == false || $store_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="store_id is Missing";
			}else{
				$data = $this->Usermodel->getProductsByCategory($cat_id,$lang,$store_id);
				if(count($data) > 0){
					$this->_jsonData['status']=1;
					$this->_jsonData['message']="Products viewed by Category Successfully";
					$this->_jsonData['data']=$data; 
				}else{
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="No Products Found";
				}
			}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}


	}

	public function ProductDetailsById(){
		$lang = $this->input->post_get('language');
		$product_id = $this->input->post_get('product_id');
		try{
			 if($lang == false || $lang == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="language is Missing";
			}else if($product_id == false || $product_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="product_id is Missing";
			}else{
				$data = $this->Usermodel->ProductDetailsById($product_id,$lang);
				$data['Size'] = $this->Usermodel->getSizesById($product_id);
				$data['Flavor'] = $this->Usermodel->getFlavorsById($product_id);
				if(count($data) > 0){
					$this->_jsonData['status']=1;
					$this->_jsonData['message']="Product details viewed Successfully";
					$this->_jsonData['data']=$data; 
				}else{
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="No Products Found";
				}
			}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}


	}

	public function placeOrder(){
		$user_id = $this->input->post_get('user_id');
		$product_id = $this->input->post_get('product_id');
		$quantity = $this->input->post_get('product_qty');
		$size = $this->input->post_get('size');
		$sAddress = $this->input->post_get('street_address');
		$vAddress = $this->input->post_get('villa_address');
		$flavor = $this->input->post_get('flavor');
		$orderNumber = rand(1111111111,9999999999);
		$date = date('Y-m-d H:i:s');
		try{
			if($user_id == false || $user_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="user_id is Missing";
			}else if($product_id == false || $product_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="product_id is Missing";
			}else if($quantity == false || $quantity == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="quantity is Missing";
			}else if($size == false || $size == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="size is Missing";
			}else if($sAddress == false || $sAddress == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="street address is Missing";
			}else if($vAddress == false || $vAddress == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="villa address is Missing";
			}else if($flavor == false || $flavor == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="flavor is Missing";
			}else{
				$product_ids = explode(",", $product_id);
				$quantities = explode(",",$quantity);
				$sizes = explode(",",$size);
				$flavors = explode(",",$flavor);
				$i=0;
				$price=0;
				$total=0;
					foreach($product_ids as $p_ids){
						//get the product_id of the products
						$pId = $p_ids;
						//get quantity of product
						$qty = $quantities[$i]; 
						// get product size
						$prodSize = $sizes[$i];
						// get product flavors
						$prodFlvr = $flavors[$i];
						//loads model and gets the product price per item
						$getProductPrice = $this->Usermodel->getProductPrice($pId);
						//echo '<pre>';print_r($getProductPrice);exit();
						//gets the price for the product
						$unitPrice = $getProductPrice['price'];
						//echo '<pre>';print_r($unitPrice);exit();
						//gets the price of the product by quantity
						$pricePerQty = ($unitPrice * $qty);
						//echo '<pre>';print_r($pricePerQty);exit();
						//adds the total for the products
						$price += ($unitPrice * $qty);
						//echo '<pre>';print_r($price);exit();
						//sum the total price of the products
						$total = $price + 2;
						//echo '<pre>';print_r($total);exit();
						$i++;
						//place order array
						$addOrder = array(
											'user_id'=>$user_id,
											'admin_id'=>'0',
											'order_number'=>$orderNumber,
											'product_id'=>$pId,
											'quantity'=>$qty,
											'product_price'=>$unitPrice,
											'price_per_quantity'=>$pricePerQty,
											'size'=>$prodSize,
											'street_address'=>$sAddress,
											'villa_address'=>$vAddress,
											'flavor'=>$prodFlvr,
											'order_status'=>'pending',
											'create_date'=>$date
										);
						$res = $this->Usermodel->placeOrder($addOrder);
						$addOrder['id'] = $res;
						$addOrder['Total'] = $total;

						$this->_jsonData['status']=1;
						$this->_jsonData['message']="Order Added Successfully";
						$this->_jsonData['data']=$addOrder; 
					}
				}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}

	}

	public function updateOrder(){
		$order_id = $this->input->post_get('order_id');
		$user_id = $this->input->post_get('user_id');
		$product_id = $this->input->post_get('product_id');
		$quantity = $this->input->post_get('product_qty');
		$size = $this->input->post_get('size');
		$flavor = $this->input->post_get('flavor');
		$data = array();
		try{
			if($order_id == false || $order_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="order_id is Missing";
			}else if($user_id == false || $user_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="user_id is Missing";
			}else if($product_id == false || $product_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="product_id is Missing";
			}else if($quantity == false || $quantity == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="quantity is Missing";
			}else if($size == false || $size == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="size is Missing";
			}else if($flavor == false || $flavor == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="flavor is Missing";
			}else{
					$price=0;
					$total=0;
					$data['user_id'] = $user_id;
					$data['product_id'] = $product_id;
					$data['quantity'] = $quantity;
					//loads model and gets the product price per item
					$getProductPrice = $this->Usermodel->getProductPrice($product_id);
					//gets the price for the product
					$data['product_price'] = $getProductPrice['price'];

					$unitPrice = $data['product_price'];
					
					//gets the price of the product by quantity
					$data['price_per_quantity'] = ($unitPrice * $data['quantity']);

					//adds the total for the products
					$price += ($unitPrice * $quantity);
					//sum the total price of the products
					$total = $price + 2;

					$data['size'] = $size;
					$data['flavor'] = $flavor;

					$this->Usermodel->updateOrder($order_id,$data);
					$addOrder['Total'] = $total;

					$this->_jsonData['status']=1;
					$this->_jsonData['message']="Order updated Successfully";
					$this->_jsonData['data']=$data; 
			}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}

	}

	public function search(){
		$search = $this->input->post_get('search');
		try{
			$data = $this->Usermodel->search($search);
			if(count($data) > 0){
				$this->_jsonData['status']=1;
				$this->_jsonData['message']="Products searched Successfully";
				$this->_jsonData['data']=$data; 
			}else{
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="No Products Found";
			}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}


	}

	public function myOrders(){
		$user_id = $this->input->post_get('user_id');
		$language = $this->input->post_get('language');		
		try{
			if($user_id == false || $user_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="user_id is Missing";
			}else if($language == false || $language == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="language is Missing";
			}else{
				$data = $this->Usermodel->myOrders($user_id,$language);
				if(count($data) > 0){
					//$data['create_date'] = date('Y-m-d');
					$this->_jsonData['status']=1;
					$this->_jsonData['message']="Orders viewed Successfully";
					$this->_jsonData['data']=$data; 
				}else{
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="No Orders Found";
				}
			}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}


	}

	public function editProfile(){
		$language = $this->input->post_get('language');	
		$user_id = $this->input->post_get('user_id');
		$user_name = $this->input->post_get('user_name');
		$phone = $this->input->post_get('phone');
		$data = array();	
		try{
			if($language == false || $language == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="language is Missing";
			}else if($user_id == false || $user_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="user_id is Missing";
			}else if($user_name == false || $user_name == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="user_name is Missing";
			}else if($phone == false || $phone == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="phone is Missing";
			}else{
				if($language == 'arabic'){
					$data['arabic_name'] = $user_name;
					$data['phone'] = $phone;
				}else{
					$data['english_name'] = $user_name;
					$data['phone'] = $phone;
				}
				$res = $this->Usermodel->editProfile($user_id,$language,$data);
				if(count($res) > 0){
					$this->_jsonData['status']=1;
					$this->_jsonData['message']="Profile updated Successfully";
					$this->_jsonData['data']=$data; 
				}else{
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="No Profile updated";
				}
			}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}


	}

	public function changeLocation(){
		$user_id = $this->input->post_get('user_id');
		$sAddress = $this->input->post_get('street_address');
		$vAddress = $this->input->post_get('villa_address');
		$extrainfo = $this->input->post_get('extra_info');
        $lat = $this->input->post_get('latitude');
		$long = $this->input->post_get('longitude');
		$data = array();	
		try{
			if($user_id == false || $user_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="user_id is Missing";
			}else{
					$data['street_address'] = $sAddress;
					$data['villa_address'] = $vAddress;
					$data['other_info'] = $extrainfo;
					$data['latitude'] = $lat;
					$data['longitude'] = $long;
				$res = $this->Usermodel->changeLocation($user_id,$data);
				if(count($res) > 0){
					$this->_jsonData['status']=1;
					$this->_jsonData['message']="Location updated Successfully";
					$this->_jsonData['data']=$data; 
				}else{
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="No Location updated";
				}
			}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}


	}


	public function reOrder(){
		//$user_id = $this->input->post_get('user_id');
		$order_id = $this->input->post_get('order_id');
		$orderNumber = rand(1111111111,9999999999);
		$date = date('Y-m-d H:i:s');
		try{
			/*if($user_id == false || $user_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="user_id is Missing";
			}else */if($order_id == false || $order_id == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="order_id is Missing";
			}else{
				$reOrder = $this->Usermodel->getOrderById($order_id);

					$price=0;
					$total=0;
					$user_id = $reOrder['user_id'];
					$product_id = $reOrder['product_id'];
					$quantity = $reOrder['quantity'];
					//loads model and gets the product price per item
					$getProductPrice = $this->Usermodel->getProductPrice($product_id);
					//gets the price for the product
					$product_price = $getProductPrice['price'];

					$unitPrice = $product_price;
					
					//gets the price of the product by quantity
					$price_per_quantity = ($unitPrice * $quantity);

					//adds the total for the products
					$price += ($unitPrice * $quantity);
					//sum the total price of the products
					$total = $price;
					//place order array
					$addOrder = array(
									'user_id'=>$reOrder['user_id'],
									'admin_id'=>'0',
									'order_number'=>$orderNumber,
									'product_id'=>$reOrder['product_id'],
									'quantity'=>$reOrder['quantity'],
									'product_price'=>$reOrder['product_price'],
									'price_per_quantity'=>$reOrder['price_per_quantity'],
									'size'=>$reOrder['size'],
									'flavor'=>$reOrder['flavor'],
									'order_status'=>'pending',
									'create_date'=>$date
								);
					$res = $this->Usermodel->placeOrder($addOrder);
					$addOrder['id'] = $res;
					$addOrder['Total'] = $total;

					$this->_jsonData['status']=1;
					$this->_jsonData['message']="Re-Ordered Successfully";
					$this->_jsonData['data']=$addOrder; 
				}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}

	}

	public function orderDetails(){
		$order_number = $this->input->post_get('order_number');
		try{
			if($order_number == false || $order_number == ""){
				$this->_jsonData['status']=0;
				$this->_jsonData['message']="order_number is Missing";
			}else{
				$data = $this->Usermodel->orderDetails($order_number);
				if(count($data) > 0){
					//$data['create_date'] = date('Y-m-d');
					$this->_jsonData['status']=1;
					$this->_jsonData['message']="Orders viewed Successfully";
					$this->_jsonData['data']=$data; 
				}else{
					$this->_jsonData['status']=0;
					$this->_jsonData['message']="No Orders Found";
				}
			}
			echo json_encode($this->_jsonData, JSON_UNESCAPED_UNICODE);
		}catch(Exception $e){
			$this->_jsonData['status']=0;
			$this->_jsonData['message']="Error Occured";
			$this->_jsonData['data']='';
		}


	}


	public function forgetPassword(){
		$user_email = $this->input->get_post('email');

	try{
			if($user_email == false || $user_email == ""){
				$this->_jsonData['status']="FAILURE";
				$this->_jsonData['message']="User Email Missing";
			}else{
					$checkUser = $this->Usermodel->checkUser($user_email);
					if(count($checkUser)>0){
						$this->_jsonData['status']="SUCCESS";
						$this->_jsonData['message']="Password Sent Successfully...";
						$data['message'] = "Hey there, you've got mail!";
						ob_start(); //Turn on output buffering ?>
                       		Hey ! you have Got Mail from Dukkani 
                        <?php
							echo "Your Forgotten Password Is : ".base64_decode($checkUser['password']);
						 $var = ob_get_clean();

						//$htmlMessage =  $this->load->view('email/basic', $data,true);
						$this->load->library('email');
						$this->email->from('no-reply@dukkani.com', 'Dukkani');
						$this->email->to($user_email);
						$this->email->subject('Forget Password');
						$this->email->message($var);
						$this->email->send();
						$this->email->print_debugger(); 
					}else{
						$this->_jsonData['status']="FAILURE";
						$this->_jsonData['message']="No Email Exists";
					}
			}
		echo json_encode($this->_jsonData);
	}catch(Exception $e){
				$this->_jsonData['status']="FAILURE";
				$this->_jsonData['message']="Error Occured";
				$this->_jsonData['data']='';
		}
		
	}

	public function changePassword(){
		$user_id = $this->input->get_post('user_id');
		$password = $this->input->get_post('password');
		$cpassword = $this->input->get_post('cpassword');
		$data = array();

	try{
			if($password == false || $password == ""){
				$this->_jsonData['status']="FAILURE";
				$this->_jsonData['message']="User password Missing";
			}else if($cpassword == false || $cpassword == ""){
				$this->_jsonData['status']="FAILURE";
				$this->_jsonData['message']="User confirm password Missing";
			}else if($password != $cpassword){
				$this->_jsonData['status']="FAILURE";
				$this->_jsonData['message']="Password doesn't Match";
			}else{
					$data['password'] = base64_encode($password);
					$changePassword = $this->Usermodel->changePassword($user_id,$data);
					if(count($changePassword)>0){
						$this->_jsonData['status']="SUCCESS";
						$this->_jsonData['message']="Password changed Successfully...";
					}else{
						$this->_jsonData['status']="FAILURE";
						$this->_jsonData['message']="No Password Changed";
					}
			}
		echo json_encode($this->_jsonData);
	}catch(Exception $e){
				$this->_jsonData['status']="FAILURE";
				$this->_jsonData['message']="Error Occured";
				$this->_jsonData['data']='';
		}
		
	}


	public function viewNumber(){
	try{
		$changeNumber = $this->Usermodel->viewNumber();
		$this->_jsonData['status']="SUCCESS";
		$this->_jsonData['message']="Number viewed Successfully...";
		$this->_jsonData['data']=$changeNumber;
		echo json_encode($this->_jsonData);
	}catch(Exception $e){
				$this->_jsonData['status']="FAILURE";
				$this->_jsonData['message']="Error Occured";
				$this->_jsonData['data']='';
		}
		
	}

	public function feedback(){
		$user_id = $this->input->get_post('user_id');
		$feedback = $this->input->get_post('feedback');
	try{
		if($user_id == false || $user_id == ""){
			$this->_jsonData['status']="FAILURE";
			$this->_jsonData['message']="user_id Missing";
		}else if($feedback == false || $feedback == ""){
			$this->_jsonData['status']="FAILURE";
			$this->_jsonData['message']="feedback Missing";
		}else{
			$data = array('user_id'=>$user_id,'feedback'=>$feedback);
			$feedback = $this->Usermodel->feedback($data);
			$userDetails = $this->Usermodel->userDetails($user_id);
			$this->_jsonData['status']="SUCCESS";
			$this->_jsonData['message']="Thank you for your feedback, will get back to you.";
			//$data['message'] = "Hey there, you've got mail from ".$userDetails['english_name'];
				ob_start(); //Turn on output buffering ?>
				<?php
					echo " ".$data['feedback'];
					$var = ob_get_clean();

				//$htmlMessage =  $this->load->view('email/basic', $data,true);
				$this->load->library('email');
				$this->email->from($userDetails['email'], $userDetails['english_name']);
				$this->email->to('masroortunio@hotmail.com');
				$this->email->subject('Feedback');
				$this->email->message($var);
				$this->email->send();
				$this->email->print_debugger(); 
				$this->_jsonData['data']=$data;
		}
		echo json_encode($this->_jsonData);
	}catch(Exception $e){
				$this->_jsonData['status']="FAILURE";
				$this->_jsonData['message']="Error Occured";
				$this->_jsonData['data']='';
		}
		
	}


	

} // controller ends
