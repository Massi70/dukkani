<script>
 $(document).ready(function(){
    $('#form').submit(function(){
    var name = $('#name').val();
    var phone = $('#phone').val();
    var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
    $('.error').hide();
        //alert('hi');

        if(name==''){
            $('.error').html('Please enter Profile Name ');
            $('.error').show();
            return false;
        }
        
        if(phone==''){
            $('.error').html('Please enter Phone Number');
            $('.error').show();
            return false;
        }else if(!numericReg.test(phone)){
            $('.error').html('Only Numbers For Phone Number');
            $('.error').show();
            return false;
        }
    });
});

 </script>
<div class="main">
<div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Update Profile</h2>
             <?php   if(is_array($profile) && count($profile)>0){
               // echo '<pre>';print_r($profile);
                ?>
<center><span class="error" style="color:#F00"> </span></center>
<br>
<form action="<?php echo base_url()?>admin/Users/UpdateProfile/<?php echo $profile['id'];?>" method="post" class="form" id="form">
<div class="col-md-8  col-xs-12">
<div class="col-md-6 col-xs-12">
<label for="select-name">Name</label>
<input type="text" id="name" name="name" class="form-control" value="<?php echo $profile['name'];?>">
<i class="icon"></i>
</div>

<!-- <div class="col-md-6 col-xs-12">
<label for="contact-name">Email</label>
<input type="email" id="email" name="email" class="form-control" placeholder="johndoe@gmail.us">
<i class="icon"></i>
</div>

<div class="col-md-6 col-xs-12">
<label for="contact-name">&nbsp;</label>
<input type="password" id="password" name="password" class="form-control" placeholder="**********">
<i class="icon"></i>
</div>
 -->
<div class="col-md-6 col-xs-12">
<label for="contact-name">Phone Number</label>
<input type="tel" id="phone" name="phone" class="form-control" value="<?php echo $profile['phone_number'];?>">
<i class="icon"></i>
</div>

<!-- <div class="col-md-6 col-xs-12">
<label for="contact-name">Designation</label>
<input type="tel" id="tel" class="form-control" placeholder="**********">
<i class="icon"></i>
</div>
 --><div class="clearfix"></div>
<div class="col-md-6 col-xs-12">
<input type="submit" value="Update Information" class="btn text-uppercase btn-block button buttonLg" >
</div>
</div>

</form>               
			<?php }?>   

            </div>
        </div>
	</div>
        <!-- /container -->