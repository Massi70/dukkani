    <div class="main">
	<div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Add New sub-admin</h2>
            <center> <span style="color:red;font-weight:bold;margin: 0 auto;width: 400px;"> 
                        <?php if(isset($msg)) echo $msg;?>
                    </span></center><br>
<form action="<?php echo base_url(); ?>admin/Users/addNewSubAdmin" method="post" class="subAdmin" >
<div class="col-md-8 col-md-offset-2 col-xs-12">
<div class="col-md-6 col-xs-12">
<label for="select-name">Name</label>
<input type="text" id="name" name="name" class="form-control" placeholder="John Doe">
<i class=" icon"></i>
</div>

<div class="col-md-6 col-xs-12">
<label for="contact-name">Email</label>
<input type="email" id="email" name="email" class="form-control" placeholder="johndoe@gmail.us">
<i class=" icon"></i>
</div>

<div class="col-md-6 col-xs-12">
<label for="contact-name">Password</label>
<input type="password" id="password" name="password" class="form-control" placeholder="**********">
<i class=" icon"></i>
</div>

<div class="col-md-6 col-xs-12">
<label for="contact-name">Phone Number</label>
<input type="tel" id="phone" name="phone" class="form-control" placeholder="4489076345">
<i class=" icon"></i>
</div>

<div class="col-md-8 col-md-offset-2 col-xs-12">
<input type="submit" value="Add Now" class="btn text-uppercase btn-block button buttonLg" >
</div>
</div>

</form>               
			   

            </div>
        </div>
	</div>
        <!-- /container -->

        

<script type="text/javascript">
// validate login form on keyup and submit
		$(".subAdmin").validate({
			rules: {
				name: "required",
				phone: "required",

				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
					minlength: 5
				},
				
			},
			messages: {
				name: "Please enter your name",
				phone: "Please enter your number",
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				
				email: "Please enter a valid email address",
				
			}
		});

</script>