    <div class="main">
    <div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
            <h2 class="title">User Profile</h2>
            <center><span style="color:red;font-weight:bold;margin: 0 auto;width: 400px;"> 
                <?php if(isset($msg)) echo $msg;?>
            </span></center><br>

             <?php   if(is_array($profile) && count($profile)>0){
                ?>
           <!--  <div class="user-detail">
               
            <figure>
            <img src="<?php //echo base_url();?>assets/img/pic-detail-1.png" alt="user pic" class="img-responsive"/>
            </figure>
            <h5>Abdullah Bengali</h5>
            </div> -->
<div class="col-md-5 col-md-offset-3 col-xs-12">
<div class="col-md-12 col-xs-12">
<div>

  <!-- Nav tabs -->

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="user-details">
    <ul>
    
    <li>
    <h5>Name:</h5>
    <p><?php echo $profile['name'];?></p>
    </li>

    <li>
    <h5>Email:</h5>
    <p><?php echo $profile['email'];?></p>
    </li>


    <li>
    <h5>Phone:</h5>
     <p><?php echo $profile['phone_number'];?></p>
    </li>
    </ul>
    <a href="<?php echo base_url(); ?>/admin/Users/editProfile/<?php echo $profile['id'];?>" class="btn btn-lg btn-primary btn-block button buttonLg">Edit Profile</a>
    </div>
    
  </div>

</div>
</div>


</div>
<?php 
}
?>
              
               

            </div>
        </div>
    </div>