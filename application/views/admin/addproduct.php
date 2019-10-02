    <div class="main">
	<div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Add New Product</h2>
             <?php if(isset($msg)) echo $msg; ?>
<form class="storeAdmin" method="post" action="<?php echo base_url();?>admin/Products/addNewProduct/" enctype="multipart/form-data">
<div class="col-md-8 col-xs-12">
<div class="col-md-6 col-xs-12">
    <label for="select-name">Select Store</label>
    <select id="store" class="form-control" name="store" required>
           <option value="">Select Store</option>
    <?php 
       if(is_array($stores) && count($stores)>0){
            foreach ($stores as $store ) {
               // echo '<pre>';print_r($store);
        ?>
           <option value="<?php echo $store['id'];?>"><?php echo ucfirst($store['store_name']);?></option>
    
  <?php 
        }
    }
   ?>
    </select>
</div>
<div class="clearfix"></div>
<div class="col-md-6 col-xs-12">
<label for="product-name">Product Name</label>
<input type="text" id="name" class="form-control" name="name" placeholder="Product Name">
</div>

<div class="col-md-6 col-xs-12">
<label for="select-name">Category</label>
<select id="category" class="form-control" name="category" required>
        <option value="">Select Category</option>
    <?php 
       if(is_array($categories) && count($categories)>0){
            foreach ($categories as $category ) {
               // echo '<pre>';print_r($store);
        ?>
           <option value="<?php echo $category['id'];?>"><?php echo ucfirst($category['english_name']);?></option>
  <?php 
        }
    }
   ?>
    </select>
</div>



<div class="col-md-12 col-xs-12">
<label for="pro-des">Products Description</label>
 <textarea class="form-control" rows="5" id="desc" name="desc" placeholder="Description"></textarea>
</div>

<!-- <div class="col-md-5 col-xs-12">
<label for="contact-name"></label>
 <button type="button" class=" btn btn-lg button buttonMd buttondark">Add New Filter</button>
</div> -->

<div class="col-md-7 col-xs-12">
<!-- <ul>
<li><label for="size">Weight</label>
<input type="text" id="size" name="size" class="form-control" placeholder=""></li>
<li> <label for="size">Color</label>
<input type="text" id="color" name="color" class="form-control" placeholder="Red">
</li>

<li> <label for="size">Flavor</label>
<input type="text" id="other" name="other" class="form-control" placeholder=""></li>
</ul>-->

<div class="pricefilter">
<label for="size">Price</label>
<input type="text" id="price" name="price" class="form-control" placeholder="9.00">
</div>


</div>
<div class="col-md-12 col-xs-12">
<input type="submit" value="Add Product" class="btn button buttonMd" >
</div>
</div>
<div class="col-md-4 col-xs-12">
 <div class="image-sec-pro">
                       <!--  <label for="logo">Photos</label>
                        <img src="<?php //echo base_url();?>assets/img/pro-1.png" alt="product1">
                        <span class="label milabel">1</span>
                        <i class="fa fa-close miClose"></i> -->
                        <div class="imgsecpro-btn">
                            
                           <!--  <button type="button" class="btn button buttonMd buttondark">ADD Image</button> -->
                            <input class="btn button buttonMd buttondark" type="file" name="image" id="image" value="ADD NEW LOGO">
                            
                        </div>
                        
                       <!--  <ul class="subpro">
                        <li><img src="<?php //echo base_url();?>assets/img/subpro-1.png" alt="sub product" />
                        
                        </li>
                        <li><img src="<?php //echo base_url();?>assets/img/subpro-1.png" alt="sub product" />
                        
                        </li>
                        <li><img src="<?php //echo base_url();?>assets/img/subpro-1.png" alt="sub product" />
                        
                        </li>
                        </ul> -->
                        
    </div>
</div>
</form>               
			   

            </div>
        </div>
	</div>
        <!-- /container -->
<script type="text/javascript">
// validate login form on keyup and submit

		$(".storeAdmin").validate({
			rules: {
				name: "required",
				store: "required",
        category: "required",
        desc: "required",
        image: "required",
        price: "required",
			
				
			},
			messages: {
				name: "Please enter your Product name",
				store: "Please select your store",
				category: "Please select any Category",
				desc: "Please enter Description",
        image: "Please select image",
        price: "PLease enter Price",
			}
		});

</script>


</body>

</html>