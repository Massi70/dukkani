  <script>
function goBack() {
    window.history.back();
}
</script>
    <div class="main">
	<div class="container">
<?php 
  //echo '<pre>';print_r($userDetails);exit();
   if(is_array($userDetails) && count($userDetails) > 0){
    //echo '<pre>';print_r($viewUsers);
   ?>
        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Online Users</h2>
            <div class="user-detail">
            <figure>
            <img src="<?php echo $userDetails['image']; ?>" alt="<?php echo $userDetails['english_name']; ?>" class="img-responsive"/>
            </figure>
            <h5><?php echo $userDetails['english_name'];?></h5>
            </div>
<div class="col-md-5 col-md-offset-3 col-xs-12">
<div class="col-md-12 col-xs-12">
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs user-tab" role="tablist">
    <li role="presentation" class="active"><a href="#user-details" aria-controls="user-details" role="tab" data-toggle="tab">User Details</a></li>
    <li role="presentation"><a href="#user-orders" aria-controls="user-orders" role="tab" data-toggle="tab">User Orders</a></li>
    
 
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="user-details">
    <ul>
    <li>
    <h5>Location:</h5>
    <?php if($userDetails['street_address'] == "" && $userDetails['villa_address'] == ""){ ?>
            <p> <?php echo 'No Address found';?></p>
    <?php }else{ ?>
        <p> <?php echo $viewUsers['street_address']." ".$viewUsers['villa_address'];?></p>
    <?php }?>
    </li>
    <li>
    <h5>Phone:</h5>
    <p><?php echo $userDetails['phone'];?></p>
    </li>
     <li>
    <h5>Email:</h5>
    <p><?php echo $userDetails['email'];?></p>
    </li>
    </ul>
    <a href="javascript:void" onClick="goBack();" class="btn btn-lg btn-primary btn-block button buttonLg">Back to User List</a>
    </div>
    <?php }?>
   
     <?php 
  //echo '<pre>';print_r($viewUsers);exit();
   if(is_array($viewUsers) && count($viewUsers) > 0){
    //echo '<pre>';print_r($viewUsers);
   ?>
    <div role="tabpanel" class="tab-pane" id="user-orders">
     <ul>
    <li>
    <h5>Total Orders:</h5>
    <p><?php echo $viewUsers['TotalOrders'];?></p>
    </li>
    <li>
    <h5>Location:</h5>
    <?php if($viewUsers['street_address'] == "" && $viewUsers['villa_address'] == ""){ ?>
            <p> <?php echo 'No Address found';?></p>
    <?php }else{ ?>
        <p> <?php echo $viewUsers['street_address']." ".$viewUsers['villa_address'];?></p>
    <?php }?>
    </li>
    <li>
    <h5>Phone:</h5>
    <p><?php echo $viewUsers['phone'];?></p>
    </li>
    </ul>
    <a href="javascript:void" onClick="goBack();" class="btn btn-lg btn-primary btn-block button buttonLg">Back to User List</a>
    </div>
    <?php } ?>
  </div>

</div>
</div>


</div>

              
			   

            </div>
        </div>
	</div>
        <!-- /container -->