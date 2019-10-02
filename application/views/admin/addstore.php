<div class="main">
    <div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			   <h2 class="title">Add New Store</h2>
                <form class="storeAdmin" method="post" action="<?php echo base_url();?>admin/Stores/addNewStore/" enctype="multipart/form-data" >
                    <div class="col-md-8 col-xs-12">
                        
                        <div class="col-md-6 col-xs-12">
                            <label for="select-name">Select Name</label>
                            <input type="text" id="storename" class="form-control" name="storename" placeholder="Store Name">
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <label for="contact-name">Contact Name</label>
                            <input type="text" id="contactname" class="form-control" name="contactname" placeholder="Contact Name">
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <label for="contact-address">Store Address</label>
                            <input type="hidden" name="mapLat">
                            <input type="hidden" name="mapLong">
                            <input type="text" id="address" class="form-control" name="address" placeholder="Address">
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <label for="contact-tel">Phone Number</label>
                            <input type="tel" id="phone" class="form-control" name="phone" placeholder="Phone Number">
                        </div>

                        <div class="col-md-12 col-xs-12">
                            <label for="store-des">Store Description</label>
                            <textarea class="form-control" rows="5" id="desc" name="desc" placeholder="Descripton"></textarea>
                        </div>
                        
                        <div class="col-md-12 col-xs-12">
                            <input type="submit" value="Add Store" class="btn button buttonMd" >
                        </div>

                    </div>

                        <div class="col-md-4 col-xs-12">
                            <div class="image-sec-pro">
                                    <!-- <label for="logo">Logo</label>
                                    <img src="<?php //echo base_url();?>assets/img/logo-1.png" alt="product1">
                                    <i class="fa fa-close miClose"></i> -->
                                    <div class="imgsecpro-btn">
                                        
                                       <!--  <button type="button" class="btn button buttonMd buttondark">ADD NEW LOGO</button> -->
                                       <input class="btn button buttonMd buttondark" type="file" name="image" id="image" value="ADD NEW LOGO">

                                    </div>
                                                
                            </div>
                        </div>
                    </div>
                </form>               
            </div>
        </div>

	</div>
</div>
        <!-- /container -->
<script type="text/javascript">
// validate login form on keyup and submit
		$(".storeAdmin").validate({
			rules: {
				storename: "required",
				contactname: "required",
				address: "required",
				phone: "required",
                image: "required",
                desc: "required"
				
				
			},
			messages: {
				storename: "Please enter your select name",
				contactname: "Please enter your contact name",
				address: "Please enter your address",
				phone: "Please enter your number",
                image: "Please select image",
                desc: "Please insert Descripton",
				
				email: "Please enter a valid email address",
				
			}
		});

</script>