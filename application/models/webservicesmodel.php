<?php
	class WebservicesModel extends CI_Model
	{
		private $table;
		public function __construct(){
		parent :: __construct();
	}

	function getAllUsers(){
		$query = $this->db->get('users');
		return $query->result_array();
	}
	
	function getUserDetails($data){
		$sql="select user_id,user_name,user_email,password,user_status from users where user_id='".$data['user_id']."'  and user_email='".$data['user_email']."'";
		$query=$this->db->query($sql);
		$data=$query->row_array();    // fetches record from the user tables
	  	return 	$data;
   }
   
   	function addUser($data){	
		$this->db->insert('user', $data);	// insert data into `books` table
		return $this->db->insert_id();	
	}
	
	function checkUserName($user_name){
		 $sql = $this->db->get_where("user",array("user_name"=>$user_name));
		 $res = $sql->num_rows();
		 return $res;
    }
	
	function checkUserEmail($user_email){
		 $sql = $this->db->get_where("user",array("user_email"=>$user_email));
		 $res = $sql->num_rows();
		 return $res;
    }

   function checklogin($user_email,$password){
		$sql = $this->db->get_where("user",array("user_email"=>$user_email,"password"=>$password));
		$res = $sql->num_rows();
		return $res;
   }
   
   function login($user_email,$password){
		$sql = $this->db->query('select * from user where user_email="'.$user_email.'"  and password ="'.$password.'"');
		$res = $sql->row_array();
		return $res;
   }
   
   function fbLogin($fb_id){
		$sql = $this->db->query('select * from user where fb_id="'.$fb_id.'"');
		$res = $sql->row_array();
		return $res;
   } 

   function twitterLogin($twitter_id){
		$sql = $this->db->query('select * from user where twitter_id="'.$twitter_id.'"');
		$res = $sql->row_array();
		return $res;
   } 
   
   
   function addAssociation($data){	
		$result = $this->db->insert('associations', $data);	// insert data into `users` table	
		return $result;
	} 
	
	function getAllAssociation($appType){
		$sql="SELECT association_id,CONCAT('".base_url()."uploads/associations/',image) as image ,
				association_name,association_type,color from associations 
				where status = '1' and association_type = '".$appType."' order by association_id desc";
		//$sql = "SELECT association_id,CONCAT('".base_url()."uploads/associations/',image) as image ,
		//association_name from associations where status = '1' order by association_id desc";
		$query=$this->db->query($sql);
		$data=$query->result_array();    // fetches record from the user tables
	  	return 	$data;
	}
	
	function getAllAssociation_new(){
		$sql="SELECT association_id,CONCAT('".base_url()."uploads/associations/',image) as image ,
				association_name,association_type,color from associations 
				where status = '1' order by association_id desc";
		//$sql = "SELECT association_id,CONCAT('".base_url()."uploads/associations/',image) as image ,
		//association_name from associations where status = '1' order by association_id desc";
		$query=$this->db->query($sql);
		$data=$query->result_array();    // fetches record from the user tables
	  	return 	$data;
	}

	function getWineList(){
		$sql="SELECT user_name from `user` WHERE user_type_id = '2' and user_status = '1' order by user_name asc";
		$query=$this->db->query($sql);
		$data=$query->result_array();    // fetches record from the user tables
	  	return 	$data;
	}
	
	function getWineLatLong($app_id){
	/*	$sql="select user_type_id,user_name,association_id,latitude,longitude from `user` 
			WHERE user_type_id = '2' and user_status = '1' and latitude !='' and longitude !='' 
			OR latitude !='0' and longitude != '0' and user_type_id !='1' and user_type_id !='4'";
	*/
		//echo  $app_id;
	
		$sql = "select u.id,a.association_name,
				u.user_type_id,u.user_name,u.association_id,u.latitude,u.longitude,
				a.color 
				from `user` as u, associations as a WHERE u.association_id = a.association_id 
				and u.user_status = '1' 
				and u.latitude !='' and u.longitude !='' 
				and u.user_type_id !='1' and u.user_type_id !='4' AND u.app_type_id = '".$app_id."'
				ORDER BY u.association_id ASC " ;
		$query=$this->db->query($sql);
		$data=$query->result_array();    // fetches record from the user tables
	  	return 	$data;
	}
	
	function getWineLatLong_new($app_id,$association_id){
	/*	$sql="select user_type_id,user_name,association_id,latitude,longitude from `user` 
			WHERE user_type_id = '2' and user_status = '1' and latitude !='' and longitude !='' 
			OR latitude !='0' and longitude != '0' and user_type_id !='1' and user_type_id !='4'";
	*/
		//echo  $app_id;
	
		$sql = "select id,user_type_id,app_type_id,fb_id,twitter_id,user_email,user_name,
				CONCAT('".base_url()."uploads/',image) as image,
				user_status,city,association_id,country,province,address,contact,
				link,description,notes,latitude,longitude,food_open_time,food_close_time,food_status,create_time
				from `user` 
				where user_status = '1' 
				and latitude !='' and longitude !='' 
				and user_type_id !='1' and user_type_id !='4' AND app_type_id = '".$app_id."'
				AND association_id = '".$association_id."'
				ORDER BY user_name ASC " ;
		$query=$this->db->query($sql);
		$data=$query->result_array();    // fetches record from the user tables
	  	return 	$data;
	}

	function getWineryDetails($winery_id){
		$sql="SELECT id,association_id,user_name,CONCAT('".base_url()."uploads/',image) as image,country,province,address,
				contact,link,description,notes,longitude,latitude,food_status,
						  IF(food_status ='1',food_open_time,'') open_time,
						  IF(food_status ='1',food_close_time,'') close_time
				from `user` where id = '".$winery_id."' and user_type_id = '2' and user_status = '1'";
		$query=$this->db->query($sql);
		$data=$query->row_array();    // fetches record from the user tables
	  	
		$sql="SELECT CONCAT('".base_url()."uploads/events/',image) as image from event_images where winery_id = '".$winery_id."'";
		$query=$this->db->query($sql);
		$data2=$query->result_array();    // fetches record from the user tables
		$data['images'] = $data2;
		return 	$data;
	}
	
	function getWineryDetailsByAssociation($association_id,$appType,$user_id){
		if($association_id != "" || $association_id !=0){
			/*$sql="SELECT id,association_id,user_name,CONCAT('".base_url()."uploads/',image) as image,country,province,
					address,contact,link,description,notes,
					longitude,latitude,food_open_time,food_close_time from user where 
					association_id = '".$association_id."' and app_type_id = '".$appType."' 
					and user_status='1' AND user_type_id = '2' ORDER BY user_name ASC";*/
					
			  $sql = "SELECT
						  u.id,
						  u.association_id,
						  u.user_name,
						  CONCAT('".base_url()."uploads/',u.image) as image,
						  u.country,
						  u.province,
						  u.address,
						  u.contact,
						  u.link,
						  u.description,
						  u.notes,
						  u.longitude,
						  u.latitude,
	 				      u.food_status,
						  IF(u.food_status ='1',u.food_open_time,'') open_time,
						  IF(u.food_status ='1',u.food_close_time,'') close_time,
						  s.color
						FROM `user` AS u
						LEFT JOIN associations AS s ON s.association_id = u.association_id
						WHERE u.association_id = '".$association_id."' and
							u.app_type_id = '".$appType."'
							AND u.user_status = '1'
							AND u.user_type_id = '2'
						ORDER BY u.user_name ASC";
				
			$query=$this->db->query($sql);
			$data=$query->result_array();    // fetches record from the user tables
			
			$j = 0;
			foreach($data as $da):
				$sql = "select id,user_id,winery_id,rate from wineryrating 
					where winery_id = '".$da['id']."' and user_id = '".$user_id."'";
				$query = $this->db->query($sql);
				$data3 = $query->result_array();
				$data[$j]['wineries'] = $data3;
				$j++;
			endforeach;
			
			
			$i= 0;
			foreach($data as $d):
			//echo $d['winery_id']."</br>";
			$sql="SELECT CONCAT('".base_url()."uploads/events/',image) as image from event_images where winery_id = '".$d['id']."'";
				$query=$this->db->query($sql);
				$data2=$query->result_array();    // fetches record from the user tables
				$data[$i]['images'] = $data2;
				$i++;
				endforeach;
				return 	$data;
		}else{
			/*$sql="SELECT id,association_id,user_name,CONCAT('".base_url()."uploads/',image) as image,country,province,
					address,contact,link,description,notes,
					longitude,latitude,food_open_time,food_close_time from user
					where app_type_id = '".$appType."' and user_status='1' AND user_type_id = '2' ORDER BY user_name ASC";*/
					
			  $sql = "SELECT
						  u.id,
						  u.association_id,
						  u.user_name,
						  CONCAT('".base_url()."uploads/',u.image) as image,
						  u.country,
						  u.province,
						  u.address,
						  u.contact,
						  u.link,
						  u.description,
						  u.notes,
						  u.longitude,
						  u.latitude,
						u.food_status,
						  IF(u.food_status ='1',u.food_open_time,'') open_time,
						  IF(u.food_status ='1',u.food_close_time,'') close_time, 
						  s.color
						FROM `user` AS u
						LEFT JOIN associations AS s ON s.association_id = u.association_id
						WHERE u.app_type_id = '".$appType."'
							AND u.user_status = '1'
							AND u.user_type_id = '2'
						ORDER BY u.user_name ASC";
			$query=$this->db->query($sql);
			$data=$query->result_array();    // fetches record from the user tables
			
			$j = 0;
			foreach($data as $da):
				$sql = "select id,user_id,winery_id,rate from wineryrating 
					where winery_id = '".$da['id']."' and user_id = '".$user_id."'";
				$query = $this->db->query($sql);
				$data3 = $query->result_array();
				$data[$j]['wineries'] = $data3;
				$j++;
			endforeach;
			
			
			$i= 0;
			foreach($data as $d):
			//echo $d['winery_id']."</br>";
			$sql="SELECT CONCAT('".base_url()."uploads/events/',image) as image from event_images where winery_id = '".$d['id']."'";
				$query=$this->db->query($sql);
				$data2=$query->result_array();    // fetches record from the user tables
				$data[$i]['images'] = $data2;
				$i++;
				endforeach;
				return 	$data;
			
		}
	}
	
	function getWineryDetailsByAssociationByWineryId($user_id,$appType){
		$sql="SELECT id,association_id,user_name,CONCAT('".base_url()."uploads/',image) 
			 as image,country,province,	address,contact,link,description,notes,longitude,latitude,
			 food_open_time,food_close_time
			 from user where id = '".$user_id."' and app_type_id = '".$appType."'
			 and user_status = '1'";
		$query=$this->db->query($sql);
		$data=$query->result_array();    // fetches record from the user tables
		$j = 0;
		foreach($data as $da):
		$sql = "select id,user_id,winery_id,rate from wineryrating 
				where winery_id = '".$da['id']."' ";
			$query = $this->db->query($sql);
			$data3 = $query->result_array();
			$data[$j]['wineries'] = $data3;
			$j++;
		endforeach;
		
		
		$i= 0;
	  	foreach($data as $d):
		//echo $d['winery_id']."</br>";
		$sql="SELECT CONCAT('".base_url()."uploads/events/',image) as image from event_images where winery_id = '".$d['id']."'";
			$query=$this->db->query($sql);
			$data2=$query->result_array();    // fetches record from the user tables
			$data[$i]['images'] = $data2;
			$i++;
			endforeach;
			return 	$data;
	}
	
	function getEvents($user_id,$app_type){
		$sql = "SELECT event_id,winery_id,app_type,event_name,status,CONCAT('".base_url()."uploads/',image) as image,
			description,venue,timedate,DAY(timedate) AS days, MONTH(timedate) as Months,YEAR(timedate) as Years,
			flavour,entry_fee,contact,link,email,phone,latitude,longitude 
			from events where status = '1' and app_type = '".$app_type."' order by timedate ASC";
		$query = $this->db->query($sql);
		$data = $query->result_array();
                $i=0;
                $is_going = 0;
                $is_not_going = 0;
                $flag = 2;
		foreach($data as $d):
		$sql2 = "SELECT user_id,is_going from event_going where event_id = '".$d['event_id']."' ";
		$query2 = $this->db->query($sql2);
                $count = $query2->result_array();
                foreach ($count as $c):
                 if($c['is_going']==1){
                    $is_going++;
                }
                else{
                    $is_not_going ++;
                }
                if($user_id==$c['user_id']){
                     $flag = $c['is_going'];
                }
                endforeach;
                $data[$i]['going_count'] = $is_going;
                $data[$i]['not_going_count'] = $is_not_going;
                $data[$i]['is_going'] = $flag;
                $i++;
                $is_going = 0;
                $is_not_going = 0;
                $flag = 2;
		endforeach;
		return $data;	
	}
	
	function getEventById($eventId){
		$sql = "SELECT event_id,winery_id,event_name,status,CONCAT('".base_url()."uploads/',image) as image,
		description,venue,timedate,flavour,entry_fee,contact,link,email,phone,latitude,longitude 
		from events where event_id= '".$eventId."' and status = '1' ";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;	
	}
	
	function getEventByWineryId($wineryId,$user_id){
        $sql = "SELECT event_id,winery_id,event_name,status,CONCAT('".base_url()."uploads/',image) as image,
			description,venue,timedate,MONTH(timedate) as Months,YEAR(timedate) as Years,
			flavour,entry_fee,contact,link,email,phone,latitude,longitude 
			from events where winery_id ='".$wineryId."' and status = '1' order by timedate desc";
		$query = $this->db->query($sql);
		$data = $query->result_array();
                $i=0;
                $is_going = 0;
                $is_not_going = 0;
                $flag = 2;
 		foreach($data as $d):
		$sql2 = "SELECT user_id,is_going from event_going where event_id = '".$d['event_id']."' ";
		$query2 = $this->db->query($sql2);
        $count = $query2->result_array();
              
                foreach ($count as $c):
                 if($c['is_going']==1){
                    $is_going++;
                }
                else{
                    $is_not_going ++;
                }
                if($user_id==$c['user_id']){
                     $flag = $c['is_going'];
                }
                else{
                    $flag=2;
                }
                endforeach;
                $data[$i]['going_count'] = $is_going;
                $data[$i]['not_going_count'] = $is_not_going;
                $data[$i]['is_going'] = $flag;
                $i++;
                $is_going = 0;
                $is_not_going = 0;
                $flag = 2;
		endforeach;
		return $data;	
	}
	
	function addEventGoingOrNot($data){
         $sql = "SELECT count(id) as id from event_going where user_id = '{$data['user_id']}' AND event_id = '{$data['event_id']}'";
         $query = $this->db->query($sql);
         $query_data = $query->result_array();
         if($query_data[0]['id']>0){
             $sql = "UPDATE event_going set user_id = '{$data['user_id']}', event_id = '{$data['event_id']}', 
                 is_going = '{$data['is_going']}' WHERE user_id = '{$data['user_id']}' AND event_id = '{$data['event_id']}'";
                  $query = $this->db->query($sql);
                 
         }else{
              $this->db->insert('event_going', $data);
         }
	}
	
	function checkUserGoingOrNotGoing($user_id,$eventId){
		$sql = "SELECT count(id) as Total from event_going where user_id = '".$user_id."' AND event_id= '".$eventId."'";
		$query = $this->db->query($sql);
		$data = $query->num_rows();
		return $data;	
	}
	
	function updateUserGoingOrNotGoing($user_id,$event_id,$is_going,$id){
		$sql="update event_going set user_id='".$user_id."',
                        event_id='".$event_id."',
                        is_going='".$is_going."'
                        where
                        id='".$id."' AND user_id= '{$user_id}'";
		$query=$this->db->query($sql);
		if($this->db->affected_rows())
		{
			return true;
		}else{
			return false;
		}
	}


	function countTotalGoingOrNotGoing(){
		$sql = "SELECT count(*) as total from event_going where is_going = '1'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;	
	}
	
	function createTour($data){
		$this->db->insert('tour', $data);
		return $this->db->insert_id();
	}
	
	function createTourLocation($data1){
		$this->db->insert('tour_location', $data1);
	}

	function createCeller($data){
		$this->db->insert('celler', $data);
	}

	function updateCeller($id,$data){
            $this->db->where('id', $id);
            $this->db->update('celler', $data); 
            $res = $this->db->affected_rows();
            if($res>0){
                return $res;
            }
            else{
                return $res;
            }
	}
	
	function getCellerById($id){
		$sql = "SELECT id,tour_id,variety,winery,flavour,aroma,year,food,price,phone,
		rateit,CONCAT('".base_url()."uploads/',image) as image, latitude,longitude
		 from celler where id='".$id."' and status = '1' ";
		$query = $this->db->query($sql);
		$data = $query->row_array();
		return $data;	
	}
	
	function getAllTours($user_id){
		$sql = "SELECT * from tour where is_active = '1'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;	
	}
	
	function getInActiveTour($user_id,$app_id){
		$sql = "SELECT * from tour where is_active = '0' AND user_id = '{$user_id}' and app_id = '".$app_id."'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
                $i=0;
                 foreach ($data as $k=>$d):
                   $data[$i++]['latlon']= $this->getTourLatLonString('latlong',$d['id']);
				   $data[$k]['winery_id']= $this->getTourLatLonString('winery_id',$d['id']);
				   $data[$k]['username']= $this->getTourLatLonString('username',$d['id']);
                 endforeach;
		return $data;	
	}

	function getActiveTour($user_id,$app_id){
		$sql = "SELECT * from tour where is_active = '1' AND user_id = '{$user_id}' and app_id = '".$app_id."'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
                $i=0;
                foreach ($data as $k=>$d):
                   $data[$k]['latlon']= $this->getTourLatLonString('latlong',$d['id']);
				   $data[$k]['winery_id']= $this->getTourLatLonString('winery_id',$d['id']);
				   $data[$k]['username']= $this->getTourLatLonString('username',$d['id']);
				  // echo '<pre>';print_r($d);
                endforeach;
		return $data;	
	}

	
	function getTourLatLonString($type="latlong",$tour_id){
      // $sql = "Select latitude ,longitude, winery_id from tour_location where tour_id = '$tour_id'";
	   $sql = "SELECT tl.latitude ,tl.longitude,tl.winery_id,
	   			u.user_name,u.latitude as lat,u.longitude as lng
				FROM tour_location AS tl
				LEFT JOIN `user` AS u ON u.id = tl.winery_id
				 WHERE tl.tour_id = '$tour_id'";
       $query = $this->db->query($sql);
       $res = $query->result_array();
	   if($type=="latlong")
	   {
	   $string = "";
       foreach ($res as $r):
           $string.= $r['latitude'];
           $string.= ",".$r['longitude']."|";
		   endforeach;
		   return substr($string, 0, -1);
	   }
	   else if($type=="winery_id"){
		    $string = "";
       foreach ($res as $r):
           $string.= $r['winery_id'].",";
		  
		   endforeach;
		   return rtrim($string,",");
	   }
	   else if($type=="username"){
		    $string = "";
       foreach ($res as $r):
           $string.= $r['user_name']."|";
		   endforeach;
		   return rtrim($string,"|");
	   }
	
   }
   
    function getCellarByTourId($id){
		$sql = "SELECT id,tour_id,variety,winery,flavour,aroma,year,food,price,phone,
		rateit,CONCAT('".base_url()."uploads/',image) as image, latitude,longitude
		 from celler where tour_id = '{$id}' and status = '1'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;	
	}
	
  /*  function getAllCellars(){
		$sql = "SELECT id,tour_id,variety,winery,flavour,aroma,year,food,price,phone,
		rateit,CONCAT('".base_url()."uploads/',image) as image, latitude,longitude
		 from celler where status = '1' order by id desc";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;	
	}*/
	  function getAllCellars($userId,$app_id){
		$sql = "SELECT 
				  celler.id,
				  celler.app_id,
				  tour_id,
				  variety,
				  winery,
				  flavour,
				  aroma,
				  `year`,
				  food,
				  price,
				  phone,
				  rateit,
				  CONCAT('".base_url()."uploads/',image) AS image,
				   latitude,
				  longitude 
				FROM
				  celler,tour WHERE tour.id=celler.tour_id AND tour.user_id= '".$userId."' 
				 AND `status` = '1' AND celler.app_id = '".$app_id."' group by celler.id
				ORDER BY id DESC ";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;	
	}
	
	/*function selectOperators($appType)
	{
		if($appType == 1){
			$sql="SELECT user_name,CONCAT('".base_url()."uploads/',image) as image,user_status,country,province,address,contact,link 
			from `user` 
			where user_type_id = '3' and user_status = '1' and app_type_id = 1";
			$query=$this->db->query($sql);
			$data=$query->result_array();    // fetches record from the user tables
			return 	$data;
		}
		else
		{
			$sql="SELECT user_name,CONCAT('".base_url()."uploads/',image) as image,user_status,country,province,address,contact,link 
					from `user` 
					where user_type_id = '3' and user_status = '1' and app_type_id = 2";
			$query=$this->db->query($sql);
			$data=$query->result_array();    // fetches record from the user tables
			return 	$data;
		}
	}*/
	
	##########Farhana Changed Start############
	function selectOperators($appType){
		$sql="SELECT user_name,CONCAT('".base_url()."uploads/',image) as image,user_status,country,province,address,contact,link 
			from `user` 
			where user_type_id = '3' and user_status = '1' and app_type_id ='".$appType."' ORDER BY user_name asc";
			$query=$this->db->query($sql);
			$data=$query->result_array();    // fetches record from the user tables
			return 	$data;
	}
	##########Farhana Changed End############
	
	
	
	/*function changeTour($tour_id){
		$sql="update tour set is_active='0' where id='".$tour_id."'";
		$query=$this->db->query($sql);
		if($this->db->affected_rows())
		{
			return true;
		}else{
			return false;
		}
	}*/
	
	function changeTour($tour_id){
		$sql="update tour set is_active='0' where id='".$tour_id."'";
		$query=$this->db->query($sql);
	}
	
	function getEventDetails($id){
		$sql = "SELECT event_id,winery_id,event_name,status,
		CONCAT('".base_url()."uploads/',image) as image,description,venue,
		timedate,flavour,entry_fee,contact,link,email,phone,latitude,longitude 
		from events where event_id = '".$id."' and status = '1' order by timedate desc";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;	
	}
	
	function getAllLatLong($city,$app_type_id){
		if($city!=""){
			//$sql = "SELECT latitude,longitude,city from user where city = '".$city."' and latitude !='' and longitude != ''";
			$sql = "select u.id,u.user_type_id,u.user_name,u.association_id,u.latitude,u.longitude,
			u.city,a.color from `user` as u, associations as a WHERE u.association_id = a.association_id
			 and u.city = '".$city."' and u.latitude !='' and u.longitude !='' and u.user_status = '1'
			  and u.app_type_id = '".$app_type_id."' ";
		}
		else{
			//$sql = "SELECT latitude,longitude from user where latitude !='' and longitude !=''";
			$sql = "select u.id,u.user_type_id,u.user_name,u.association_id,u.latitude,u.longitude,
			u.city,a.color from `user` as u, associations as a WHERE u.association_id = a.association_id
			 and u.latitude !='' and u.longitude !='' and u.user_status = '1' and u.app_type_id = '".$app_type_id."' ";

		}
		
		$query = $this->db->query($sql);	
		$data = $query->result_array();
		return $data;
		
	}
	
	function insertWineryRating($data){
		$this->db->insert('wineryrating', $data);
	}
	
	function checkRating($user_id,$winery_id){
		$sql = "SELECT * from wineryrating where user_id = '".$user_id."' and winery_id = '".$winery_id."'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;	
	}
	
	function updateRating($user_id,$winery_id,$rate){
		$sql="update wineryrating set user_id='".$user_id."',winery_id='".$winery_id."',
		rate='".$rate."' where user_id = '".$user_id."' and winery_id='".$winery_id."' ";
		$query=$this->db->query($sql);
		if($this->db->affected_rows())
		{
			return true;
		}else{
			return false;
		}
	}
	
	function insertTourGallery($data){
		$this->db->insert('tour_gallery', $data);
	}
	
	function deleteAllTourGallery($tour_id){
		$sql = "delete from tour_gallery where tour_id = '".$tour_id."'";
		$query = $this->db->query($sql);
	}
	
	function deleteAllTourLocation($tour_id){
		$sql = "delete from tour_location where tour_id = '".$tour_id."'";
		$query = $this->db->query($sql);
	}
	
	
	function getTourGalleryData($tour_id){
		$sql = "select id,tour_id,data,path,is_image,video_thumb from tour_gallery where tour_id = '".$tour_id."' order by id desc";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	
	function insertTourNotes($data){	
		$this->db->insert('tour_notes', $data);	// insert data into `books` table
	}
	
	function getTourNoteById($tour_id){
		$sql = "select note_id,tour_id,notes,datetime from tour_notes where tour_id = '".$tour_id."' and status = '1'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	
	function getTourByUserId($user_id){
		$sql = "select id,user_id,name,description,is_active,start_date,end_date 
		 	from tour where user_id = '".$user_id."'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	
	function deleteTourNotes($note_id){
		$sql = "update tour_notes set status = '0' where note_id = '".$note_id."'";
		$this->db->query($sql);
	}
	
	function deleteAllTourNotes($tour_id){
		$sql = "delete from tour_notes where tour_id = '".$tour_id."'";
		$this->db->query($sql);
	}
	
	function deleteCeller($celler_id){
		$sql = "update celler set status = '0' where id = '".$celler_id."'";
		$this->db->query($sql);
	}
	
	
	function updateTourNotes($id,$data){
           $sql = "update tour_notes set notes = '".$data['notes']."' where note_id = '".$id."'"; 
		   $this->db->query($sql);
		/*$this->db->update('tour_notes', $data, array('note_id' => $id));
		$sql = "SELECT note_id,tour_id,notes,status,datetime from tour_notes 
		where celler_id ='".$celler_id."'";
		$query = $this->db->query($sql);
		$data = $query->row_array();
		return $data;*/

	}
	
	function deleteTour($tour_id){
		$sql = "delete from tour where id = '".$tour_id."'";
		$this->db->query($sql);
	}
	
	
	function contactUsEmail(){
		$sql = "select email from contactusemails where status = '1'";	
		$query = $this->db->query($sql);
		$data = $query->row_array();
		return $data;
		
	}
	
	function contactUsEmailAdmin(){
		$sql = "select id,email,status from contactusemails where status = '1'";	
		$query = $this->db->query($sql);
		$data = $query->row_array();
		return $data;
		
	}

	function deleteEmail($id){
		$sql = "update contactusemails set status = '0' where id = '".$id."'";
		$this->db->query($sql);
	}
	
	function addNewEmail($data){
		//print_r($data);
		$this->db->insert('contactusemails',$data);
	}

	function getAllWineriesByType($app_type){
		$sql = "SELECT id,association_id,user_name,CONCAT('".base_url()."uploads/',image) 
				as image,country,province,address,contact,link,description,notes,longitude,latitude
			  	FROM `user` WHERE app_type_id = '".$app_type."' AND user_status = '1' AND user_type_id = '2'";	
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
		
	}
	
	
	//****************************rehan work Start *********************************//
	public function loginWeb($user_email,$password){
	   
	   $sql='select * from user where user_email="'.$user_email.'"  and password ="'.base64_encode($password).'"  AND (user_type_id= 2 OR user_type_id= 3) ';
		$query = $this->db->query($sql);
		$data=$query->row_array();
		if($query->num_rows() >0 )
			return $data;
		 else
			return FALSE;
   } 
   
	public function userIsExist($email){
		  
		 	 $sql="SELECT id FROM user WHERE user_email='".$email."'";
 				//restaurant_email='".$userName."' and restaurant_password='".base64_encode( $password )."'";
			$query=$this->db->query($sql);
			
			if($query->num_rows() >0 )
				return $query->row_array();
			 else
				return FALSE;
  			
	}
	
	public function registerUser($data){
        if($this->db->insert('user', $data)){
			 $userId=$this->db->insert_id() ;
			 return  $userId;
		}else{
			return false;
		}
    }
	
	function getWineryEvents($wineryId){
		
        $sql = "SELECT event_id,winery_id,event_name,status,CONCAT('".base_url()."uploads/',image) as image,
		description,venue,timedate,flavour,entry_fee,contact,link,email,phone,latitude,longitude 
		from events where winery_id ='".$wineryId."' and status = '1' order by timedate desc";
		$query = $this->db->query($sql);
		$data = $query->result_array();
              
		return $data;	
	}
	
	public function updateUserProfile($data,$id){
		
        $this->db->update('user', $data, array('id' => $id));
		$sql = "SELECT *from user where id ='".$id."'";
		$query = $this->db->query($sql);
		$data = $query->row_array();
		return $data;	
    }
	
   	

}

?>