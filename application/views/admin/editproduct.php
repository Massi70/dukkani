    <div class="main">
	<div class="container">

        <div class="row">
            <div class="col-md-12 center-block">
			<h2 class="title">Edit Product</h2>
             <?php if(isset($msg)) echo $msg; ?>
<form class="storeAdmin" method="post" action="<?php echo base_url();?>admin/Products/updateProduct/<?php echo $ProductDetails['id']; ?>" enctype="multipart/form-data">
<div class="col-md-8 col-xs-12">
<div class="col-md-6 col-xs-12">
  <?php //echo '<pre>';print_r($ProductDetails); ?>
    <label for="select-name">Select Store</label>
    <select id="store" class="form-control" name="store" id="store" required>
    <?php 
       if(is_array($stores) && count($stores)>0){
        //echo '<pre>';print_r($stores['store_name']);exit();
            foreach ($stores as $store ) {
              //echo '<pre>';print_r($store);
              $select = $ProductDetails['store_id'] == $store['id']?'selected':'';
   ?>
     <option value="<?php echo $store['id'];?>" <?php echo $select;?> ><?php echo ucfirst($store['store_name']);?></option>
    
  <?php 
        }
    }
   ?>
    </select>
</div>
<div class="clearfix"></div>
<div class="col-md-6 col-xs-12">
<label for="product-name">Product Name</label>
<input type="text" id="name" class="form-control" name="name" value="<?php echo $ProductDetails['english_name']; ?>">
</div>

<div class="col-md-6 col-xs-12">
<label for="select-name">Category</label>
<select id="category" class="form-control" name="category" required>
    <?php 
       if(is_array($categories) && count($categories)>0){
            foreach ($categories as $category ) {
                //echo '<pre>';print_r($category);
              $selectCat = $ProductDetails['category_id'] == $category['id']?'selected':'';
             // echo '<pre>';print_r($selectCat);exit;
        ?>
          <option value="<?php echo $category['id'];?>" <?php echo $selectCat;?> ><?php echo ucfirst($category['english_name']);?></option>
  <?php 
        }
    }
   ?>
    </select>
</div>



<div class="col-md-12 col-xs-12">
<label for="pro-des">Products Description</label>
 <textarea class="form-control" rows="5" id="desc" name="desc" ><?php echo $ProductDetails['description']; ?></textarea>
</div>

<!-- <div class="col-md-5 col-xs-12">
<label for="contact-name"></label>
 <button type="button" class=" btn btn-lg button buttonMd buttondark">Add New Filter</button>
</div> -->

<div class="col-md-7 col-xs-12">
<ul>
<li><label for="size">Size</label>
<input type="text" id="size" name="size" class="form-control" value="<?php echo $ProductDetails['size_id']; ?>"></li>
<li> <label for="size">Color</label>
<input type="text" id="color" name="color" class="form-control" value="<?php echo $ProductDetails['color']; ?>">
</li>
<li> <label for="size">Other</label>
<input type="text" id="other" name="other" class="form-control" value="<?php echo $ProductDetails['flavor_id']; ?>"></li>
</ul>

<div class="pricefilter">
<label for="size">Price</label>
<input type="text" id="price" name="price" class="form-control" value="<?php echo $ProductDetails['price']; ?>">
</div>


</div>
<div class="col-md-12 col-xs-12">
<input type="submit" value="Update Product" class="btn button buttonMd" >
</div>
</div>
<div class="col-md-4 col-xs-12">
 <div class="image-sec-pro">
      <label for="logo">Product</label>
      <img src="<?php echo $ProductDetails['image']; ?>" alt="<?php echo $ProductDetails['english_name']; ?>">
      <div class="imgsecpro-btn">
          
         <!--  <button type="button" class="btn button buttonMd buttondark">ADD Image</button> -->
          <input class="btn button buttonMd buttondark" type="file" name="image" id="image" value="ADD NEW Product">
          
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
        price: "required",
			
				
			},
			messages: {
				name: "Please enter your Product name",
				store: "Please select your store",
				category: "Please select any Category",
				desc: "Please enter Description",
        price: "PLease enter Price",
			}
		});

</script>


</body>

</html>