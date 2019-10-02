<script>
 $(document).ready(function(){
    $('#form').submit(function(){
    var password = $('#password').val();
    $('.error').hide();
        //alert('hi');

        if(password==''){
            $('.error').html('Please enter Password ');
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
			<h2 class="title">Settings</h2>
            <?php if(isset($msg)) echo $msg; ?>
<span class="error" style="color:#F00"> </span>
<br><br>

<form action="<?php echo base_url()?>admin/Users/UpdatePassword/<?php echo $user_id;?>" method="post" class="form" id="form">
<div class="col-md-8  col-xs-12">
<div class="col-md-6 col-xs-12">
<label for="select-name">Change Password</label>
<input type="password" id="password" name="password" class="form-control" placeholder="Change Password">
<i class="icon"></i>
</div>

<div class="clearfix"></div>
<div class="col-md-6 col-xs-12">
<input type="submit" value="Update Password" class="btn text-uppercase btn-block button buttonLg" >
</div>
</div>

</form>               

            </div>
        </div>
	</div>
        <!-- /container -->