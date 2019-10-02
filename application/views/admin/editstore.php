<div class="main">
<div class="container">
  <div class="row">
    <div class="col-md-12 center-block">
      <h2 class="title">Edit Store</h2>
      <form class="storeAdmin" method="post" action="<?php echo base_url();?>admin/Stores/storeUpdate/<?php echo $store_id;?>" enctype="multipart/form-data">
        <?php 
    //echo '<pre>';print_r($storeDetails);exit;
   if(is_array($storeDetails) && count($storeDetails)>0){
      //  $i=1;
       // foreach($ProductDetails as $data){ 
        //echo '<pre>';print_r($ProductDetails);
   ?>
        <div class="col-md-8 col-xs-12">
            <div class="col-md-6 col-xs-12">
                  <label for="select-name">Select Name</label>
                  <input type="text" id="storename" class="form-control" name="storename" value="<?php echo $storeDetails['store_name']; ?>">
              </div>

              <div class="col-md-6 col-xs-12">
                  <label for="contact-name">Contact Name</label>
                  <input type="text" id="contactname" class="form-control" name="contactname" value="<?php echo $storeDetails['contact_name']; ?>">
              </div>

              <div class="col-md-6 col-xs-12">
                  <label for="contact-address">Store Address</label>
                  <input type="hidden" name="mapLat">
                  <input type="hidden" name="mapLong">
                  <input type="text" id="address" class="form-control" name="address" value="<?php echo $storeDetails['address']; ?>">
              </div>

              <div class="col-md-6 col-xs-12">
                  <label for="contact-tel">Phone Number</label>
                  <input type="tel" id="phone" class="form-control" name="phone" value="<?php echo $storeDetails['phone_number']; ?>">
              </div>

              <div class="col-md-12 col-xs-12">
                  <label for="store-des">Store Description</label>
                  <textarea class="form-control" rows="5" id="desc" name="desc"><?php echo $storeDetails['description']; ?></textarea>
              </div>

            <div class="col-md-12 col-xs-12">
            <input type="submit" value="Update Now" class="btn button buttonMd" >
            </div>
            </div>

        <div class="col-md-4 col-xs-12">
          <div class="image-sec-pro">
            <label for="logo">Logo</label>
            <img name="image" src="<?php echo $storeDetails['image']; ?>" alt="Store Image"> <i class="fa fa-close miClose"></i>
            <div class="imgsecpro-btn">
              <input class="btn button buttonMd buttondark" type="file" name="image" id="image" value="ADD NEW LOGO">
            </div>
          </div>
        </div>
      </form>
      <?php } ?>
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
        /* image: "required",*/
        desc: "required"
        
        
      },
      messages: {
        storename: "Please enter your select name",
        contactname: "Please enter your contact name",
        address: "Please enter your address",
        phone: "Please enter your number",
        /*image: "Please select image",*/
        desc: "Please insert Descripton",
        
        email: "Please enter a valid email address",
        
      }
    });

</script>